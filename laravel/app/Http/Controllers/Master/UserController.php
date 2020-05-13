<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AuthUser;
use App\Models\Master\UserGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use App\Models\Master\LogDashboard;
use App\Events\Master\Log;

use Auth;
use Validator;
use Hash;
use Rule;

class UserController extends Controller
{
    /**
     * Set globally for this controller.
     *
     * @var array
     */
    protected $parse = [];
     /**
     * So we can call a model in every method.
     *
     * @var object|array
     */
    protected $model;
    /**
     *
     * Auth user.
     *
     * @var object|array
     */
    protected $auth_user;

     /**
     * Prefix routing.
     *
     * @var string
     */
    protected $prefix_routes = 'user.';
    /**
     * Prefix Api routing.
     *
     * @var string
     */
    protected $prefix_api_routes ='user';

     /**
     * Prefix routing.
     *
     * @var string
     */
    protected $destination_path = 'users/';

    /**
     * Filtered Post Data.
     *
     * @var array
     */
    protected $post_data;
    /**
     * Validation rules.
     *
     * @var array
     */
    protected $validation_rules = [
        'name'   => 'required|min:3',
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    /**
     * Error message/system.
     *
     * @var string
     */
    protected $error;

    /**
     * Class constructor.
     *
     */
    public function __construct()
    {
        $this->model      = new AuthUser;
        $this->user_group = new UserGroup;
        $this->auth_user  = Auth::guard('backend')->user();

        $this->prefix_routes = 'master.'. $this->prefix_routes;
        // $this->prefix_api_routes = 'api.'. $this->prefix_api_routes;

        $this->parse['upload_path'] = $this->destination_path;

        $this->parse['data_url']           = route($this->prefix_routes. 'index');
        $this->parse['add_url']            = route($this->prefix_routes. 'create');
        $this->parse['delete_url']         = route($this->prefix_routes. 'delete');
        $this->parse['delete_picture_url'] = route($this->prefix_routes. 'delete_picture');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->parse['add_url']        = route($this->prefix_routes. 'create');
        $this->parse['delete_url']     = route($this->prefix_routes. 'delete');
        $this->parse['url_data']       = route($this->prefix_routes. 'list_data');
        $this->parse['record_perpage'] = "10";
        return view('dashboard.user.user', $this->parse);
    }

    /**
     * Listing data from record.
     *
     * @return json $return
     */
    public function list_data(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {
            $param['search_value'] = $post['search']['value'];
            $param['search_field'] = $post['columns'];
            if (isset($post['order'])) {
                $param['order_field'] = $post['columns'][$post['order'][0]['column']]['data'];
                $param['order_sort']  = $post['order'][0]['dir'];
            }
            $param['row_from']         = $post['start'];
            $param['length']           = $post['length'];
            $count_all_records         = $this->model->countAllRecords();
            $count_filtered_records    = $this->model->countAllRecords($param);
            $records                   = $this->model->getAllRecords($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $return['data'][$row]['DT_RowId']    = $record['id'];
                $return['data'][$row]['actions']     = '<a href="'. route($this->prefix_routes. 'update', $record['id']). '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['name']        = $record['name'];
                $return['data'][$row]['email']       = $record['email'];
                $return['data'][$row]['create_at']   = date('d-m-Y H:i', strtotime($record['created_at']));
            }

            return response()->json($return);
        }
        return redirect()->route($this->prefix_routes. 'index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if ($request->isMethod('post')) {
            $post = $request->all();

            $this->validation_rules = array_merge(
                [
                    'email'    => 'required|email|unique:'. $this->model->getConnectionName(). '.'.$this->model->getTable(),
                    'username' => 'required|min:5|unique:'. $this->model->getConnectionName(). '.'.$this->model->getTable(),
                    'password' => 'required|confirmed|min:6',
                ],
                $this->validation_rules);

            $validator = Validator::make($post, $this->validation_rules);

            if ($validator->fails()) {
                return redirect($this->parse['add_url'])->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }


            $data = $this->model->create($post);

            if ($request->hasFile('photo')) {



                // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                    $file = $request->file('photo');
                    $filename = 'user_photo_'. $data['id']. '_'. date('YmdHi'). '.'. $file->getClientOriginalExtension();
                    $thumbnail_name = 'tmb_'. $filename;
                    $max_width = config('custom.images.medium.width');
                    $max_height =  config('custom.images.medium.height');

                    if ( ! is_dir(upload_path($this->destination_path))) {
                        Storage::makeDirectory($this->destination_path);
                    }
                    Storage::disk("local")->putFileAs($this->destination_path,  $file, $filename);

                     $source = storage_path(). '/app/public/uploads/'. $this->destination_path.$filename;

                     Image::make($source)->resize($max_width, $max_height, function($constraint) {
                        $constraint->aspectRatio();
                    })->save(upload_path($this->destination_path.$thumbnail_name));

                    // $file->move($source,$filename);
                    // insert to db
                    $data['photo'] = $filename;

                $data->save();
            }

            // \FatLib::createLog('user_create', 'SUCCESS Create User ID: '. $data['id'], $request->except('password'));
             //event log
            //  $users = Auth::guard(backend_guard())->user();
            //  $log = new LogDashboard();
            //  $log = array(
            //                  'user_group_id' => $users->user_group_id,
            //                  'user_id'       => $users->id,
            //                  'action'        => 'user_create',
            //                  'description'   => 'SUCCESS Create User  ID: ' . $data['id'],
            //                  'path'          => $reques->fullUrl(),
            //                  'ip_address'    => $reques->ip(),
            //                  'raw_data'      => ($data != '') ? response()->json($data) : response()->json(request()->input()),
            //              );

            //  event(new Log($log));

            return redirect($this->parse['data_url'])->with('flash_message', [
                    'message' => 'Success',
                    'status'  => 'success',
                ]);
        }
        $this->parse['groups']      = $this->user_group->getAllRecords(['order_field' => 'name']);
        $this->parse['page_title']  = '[Add]';
        $this->parse['form_action'] = $this->parse['add_url'];

        return view($this->prefix_routes. 'form', $this->parse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->parse['page_title'] = '[Edit]';
        $data = $this->model->find($id);
        if (! $id ||  ! $data || ($data['is_superadmin'] == 1 && ! auth_user()->is_superadmin)) {
            return redirect($this->parse['data_url'])->with('flash_message', [
                    'message' => 'Sorry. We couldn\'t find what your looking for.',
                    'status'  => 'warning',
                ]);
        }

        $this->parse['form_action'] = route($this->prefix_routes. 'update', $id);
        $this->parse['data'] = $data;

        if ($request->isMethod('post')) {
            $post = $request->all();

            $this->validation_rules = array_merge(
                [
                    'email'    => 'required|email|unique:'. $this->model->getConnectionName(). '.'.$this->model->getTable().',email,'.$id,
                    'username' => 'required|min:5|unique:'. $this->model->getConnectionName(). '.'.$this->model->getTable().',username,'.$id,

                ],
                $this->validation_rules);

            if ($post['password'] != '') {

                $this->validation_rules = array_merge(
                    [
                        'password' => 'required|confirmed|min:6',
                    ],
                    $this->validation_rules);
            } else {
                unset($post['password']);
            }

            $validator = Validator::make($post, $this->validation_rules);

            if ($validator->fails()) {
                return redirect($this->parse['form_action'])->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }

            $data->fill($post)->save();

            if ($request->hasFile('photo')) {
                if ($data['photo'] != '') {

                    if (Storage::disk("local")->exists(upload_path($this->destination_path. $data['photo']))) {
                        Storage::delete(upload_path($this->destination_path. $data['photo']));
                    }
                    if (Storage::disk("local")->exists(upload_path($this->destination_path.'tmb_'.$data['photo']))) {
                        Storage::delete(upload_path($this->destination_path.'tmb_'.$data['photo']));
                    }
                }
                $file = $request->file('photo');
                $filename = 'user_photo_'. $data['id']. '_'. date('YmdHi'). '.'. $file->getClientOriginalExtension();
                $thumbnail_name = 'tmb_'. $filename;
                $max_width = config('custom.images.medium.width');
                $max_height =  config('custom.images.medium.height');

                if ( ! is_dir(upload_path($this->destination_path))) {
                    Storage::makeDirectory($this->destination_path);
                }
                Storage::disk("local")->putFileAs($this->destination_path,  $file, $filename);

                 $source = storage_path(). '/app/public/uploads/'. $this->destination_path.$filename;

                 Image::make($source)->resize($max_width, $max_height, function($constraint) {
                    $constraint->aspectRatio();
                })->save(upload_path($this->destination_path.$thumbnail_name));

                // insert to db
                $data['photo'] = $filename;

                $data->save();
            }

            // \FatLib::createLog('user_update', 'SUCCESS Update User ID: '. $data['id'], $request->except('password'));
             //event log
            //  $users = Auth::guard(backend_guard())->user();
            //  $log = new LogDashboard();
            //  $log = array(
            //                  'user_group_id' => $users->user_group_id,
            //                  'user_id'       => $users->id,
            //                  'action'        => 'user_update',
            //                  'description'   => 'SUCCESS  Update User  ID: ' . $data['id'],
            //                  'path'          => $reques->fullUrl(),
            //                  'ip_address'    => $reques->ip(),
            //                  'raw_data'      => ($data != '') ? response()->json($data) : response()->json(request()->input()),
            //              );

            //  event(new Log($log));
            return redirect($this->parse['data_url'])->with('flash_message', [
                    'message' => 'Success',
                    'status'  => 'success',
                ]);
        }

        $this->parse['groups'] = $this->user_group->getAllRecords(['order_field' => 'name']);

        return view($this->prefix_routes. 'form', $this->parse);
    }

    /**
     * Delete record.
     *
     * @param  Request $request
     *
     * @return json|array return
     */
    public function delete(Request $request)
    {
        if ($request->isMethod('delete') && $request->ajax()) {
            $id = $request->id;
            $data = $this->model->getModelById($id);
            if (! $id ||  ! $data) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to delete. Please try again.'
                ]);
            }

            $own_account = false;

            if (is_array($id)) {
                foreach ($id as $key => $value) {
                    if (auth_user()->id == $value) {
                        $own_account = true;
                        break;
                    }
                }
            } else {
                if (auth_user()->user_group_id == $id) {
                    $own_account = true;
                }
            }
            if ($own_account == true) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'You can\'t delete your own account.'
                ]);
            }
            // delete image
            if (is_array($id)) {
                foreach ($data as $key => $image) {
                    if ($image['photo'] != '') {
                        if (Storage::disk("local")->exists(upload_path($this->destination_path. $image['photo']))) {
                            Storage::delete(upload_path($this->destination_path. $image['photo']));
                        }
                        if (Storage::disk("local")->exists(upload_path($this->destination_path.'tmb_'.$image['photo']))) {
                            Storage::delete(upload_path($this->destination_path.'tmb_'.$image['photo']));
                        }
                    }
                }
            } else {
                if ($data['photo'] != '') {
                    if (Storage::disk("local")->exists(upload_path($this->destination_path. $data['photo']))) {
                        Storage::delete(upload_path($this->destination_path. $data['photo']));
                    }
                    if (Storage::disk("local")->exists(upload_path($this->destination_path.'tmb_'.$data['photo']))) {
                        Storage::delete(upload_path($this->destination_path.'tmb_'.$data['photo']));
                    }
                }
            }
            $this->model->deleteModelById($id);

            // \FatLib::createLog('user_delete', 'SUCCESS Delete User', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been deleted.'
            ]);
        }
    }

    /**
     * Delete picture.
     *
     * @param  Request $request
     *
     * @return json|array return
     */
    public function deletePicture(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {
            $id = $request->id;
            $data = $this->model->getModelById($id);
            if (! $id ||  ! $data) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to delete. Please try again.'
                ]);
            }
            // check if the image is exists
            if ($data['photo'] != '') {
                if (Storage::disk("local")->exists(upload_path($this->destination_path. $data['photo']))) {
                    Storage::delete(upload_path($this->destination_path. $data['photo']));
                }
                if (Storage::disk("local")->exists(upload_path($this->destination_path.'tmb_'.$data['photo']))) {
                    Storage::delete(upload_path($this->destination_path.'tmb_'.$data['photo']));
                }
            }

            $data->photo = '';

            $data->save();

            // \FatLib::createLog('user_delete_picture', 'SUCCESS Delete User Picture ID: '. $data['id'], $id);
            //event log
            $users = Auth::guard(backend_guard())->user();
            $log = new LogDashboard();
            $log = array(
                            'user_group_id' => $users->user_group_id,
                            'user_id'       => $users->id,
                            'action'        => 'user_delete_picture',
                            'description'   => 'SUCCESS  Delete User Picture ID: ' . $data['id'],
                            'path'          => $reques->fullUrl(),
                            'ip_address'    => $reques->ip(),
                            'raw_data'      => ($data != '') ? response()->json($data) : response()->json(request()->input()),
                        );

            event(new Log($log));

            return response()->json([
                'status' => 'success',
                'message' => 'Image has been deleted.'
            ]);
        }
    }
}
