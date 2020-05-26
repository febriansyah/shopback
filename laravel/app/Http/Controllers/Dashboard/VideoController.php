<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\Video;
use App\Models\Dashboard\Client;
use App\Models\Dashboard\ShopeBack;
use Illuminate\Support\Facades\Storage;
use App\Events\VideoEvent;
use Auth;
use Image;
use Validator;
use FFMpeg;
class VideoController extends Controller
{
    //
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
     * Auth user.
     *
     * @var object|array
     */
    protected $auth_user;

    /**
     * Auth user.
     *
     * @var object|array
     */
    protected $user_menu;

    /**
     * Prefix routing.
     *
     * @var string
     */
    protected $prefix_routes = 'video.';
    /**
     * Prefix Api routing.
     *
     * @var string
     */
    protected $prefix_api_routes ='video';

     /**
     * Prefix routing.
     *
     * @var string
     */
    protected $destination_path = 'video/';

    /**
     * Validation rules.
     *
     * @var array
     */
    protected $validation_rules = [
        'name'   => 'required|min:3',
    ];

    /**
     * Class constructor.
     *
     */
    public function __construct()
    {
        $this->model     = new Video;
        $this->model_shopeback = new ShopeBack;
        $this->model_client = new Client;

        $this->auth_user = Auth::guard(backend_guard())->user();

        $this->prefix_routes = 'dashboard.'. $this->prefix_routes;

        $this->parse['data_url']           = route($this->prefix_routes. 'index');
        $this->parse['add_url']            = route($this->prefix_routes. 'create');
        $this->parse['url_data']       = route($this->prefix_routes. 'list');
        $this->parse['delete_url']         = route($this->prefix_routes. 'delete');
        // $this->parse['delete_picture_url'] = route($this->prefix_routes. 'delete_picture');
        $this->parse['record_perpage'] = "10";
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
        $this->parse['url_data']       = route($this->prefix_routes. 'list');
        $this->parse['record_perpage'] = "10";
        return view('dashboard.video.video', $this->parse);
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
            $param['search'] = $post['search'];
            $param['sort'] = ($post['sort']=='new' || $post['sort']=='All')?'DESC':'ASC';

            $param['start']         = ($post['start']-1) * 10;
            $param['length']           = 10;
            $count_all_records         = $this->model->countAllRecords();
            $count_filtered_records    = $this->model->countAllRecords($param);
            $records                   = $this->model->getAllRecords($param);
            $return                    = [];
            $return['recordsTotal']    = ceil($count_all_records/10);
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $return['data'][$row]['id']    = $record['id'];
                $return['data'][$row]['actions']     = '<a href="'. route($this->prefix_routes. 'detail', $record['id']). '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['photo']        = '<img src="'.upload_url($this->destination_path.$record['photo']).'" style="width:150px;">';
                $return['data'][$row]['title'] = $record['title'];
                $return['data'][$row]['description'] = $record['description'];
                // $return['data'][$row]['status'] = ($record['status']==1)?'publish':'unpublish';
                $return['data'][$row]['uniq_visitor'] = $this->model_shopeback->where('video_id',$record['id'])->groupBy('order_id')->get()->count();
                $return['data'][$row]['target_view'] = $record['target_view'];
                $return['data'][$row]['client'] = $record['client']['name'];
                $return['data'][$row]['total_view'] = $this->model_shopeback->where('video_id',$record['id'])->get()->count();
                $return['data'][$row]['date']   = date('d-m-Y H:i', strtotime($record['created_at']));
                $return['data'][$row]['start_publish']   = date('d-m-Y', strtotime($record['start_publish']));
                $return['data'][$row]['end_publish']   = date('d-m-Y', strtotime($record['end_publish']));
                $return['data'][$row]['status']   = (strtotime($record['start_publish']) <= strtotime(date('Y-m-d')) && strtotime($record['end_publish']) >= strtotime(date('Y-m-d')))?'aktive':'tidak aktive';
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


            $messages = [
                'required' => 'Kolom :attribute ini wajib diisi.',
                'min'      => 'Input :attribute tidak kurang dari :min karakter.',
                'unique'   => ':attribute anda sudah terdaftar.',
                'confirmed' => ':attribute tidak sama dengn Verify Password',
                'dimensions' => ':attribute dimensions tidak sesuai',
                'mimes' => 'format :attribute salah'
            ];
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'client_id' => 'required',
                'target_view' => 'required',
                'start_publish' => 'required',
                'end_publish' => 'required',
                'video' => 'required|mimes:mp4,avi',
                'background' => 'required|dimensions:width=360,height=640|mimes:jpeg,jpg,png',
                'photo' => 'required|dimensions:width=360,height=178|mimes:jpeg,jpg,png'
            ],$messages);
            if ($validator->fails()) {
                return redirect()->route('dashboard.video.create')->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }
            $post['start_publish'] = date('Y-m-d',strtotime($post['start_publish']));
            $post['end_publish'] = date('Y-m-d',strtotime($post['end_publish']));
            $data = $this->model->create($post);

            if ($request->hasFile('photo')) {



                // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                    $file = $request->file('photo');
                    $filename = 'photo_'. $data['id']. '_'. date('YmdHi'). '.'. $file->getClientOriginalExtension();
                    $thumbnail_name = 'tmb_'. $filename;
                    $max_width = config('custom.images.medium.width');
                    $max_height =  config('custom.images.medium.height');

                    if ( ! is_dir(upload_path($this->destination_path))) {
                        Storage::makeDirectory('/public/uploads/'.$this->destination_path);
                    }
                    Storage::disk("local")->putFileAs('/public/uploads/'.$this->destination_path,  $file, $filename);
                    $source = storage_path(). '/app/public/uploads/'. $this->destination_path.$filename;

                    Image::make($source)->resize($max_width, $max_height, function($constraint) {
                        $constraint->aspectRatio();
                    })->save(upload_path($this->destination_path.$thumbnail_name));


                    // $file->move($source,$filename);
                    // insert to db
                    $data['photo'] = $filename;

                $data->save();
            }

            if ($request->hasFile('background')) {



                // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                    $file = $request->file('background');
                    $filename = 'background_'. $data['id']. '_'. date('YmdHi'). '.'. $file->getClientOriginalExtension();
                    $thumbnail_name = 'tmb_'. $filename;
                    $max_width = config('custom.images.medium.width');
                    $max_height =  config('custom.images.medium.height');

                    if ( ! is_dir(upload_path($this->destination_path.'background/'))) {
                        Storage::makeDirectory('/public/uploads/'.$this->destination_path.'background/');
                    }
                    Storage::disk("local")->putFileAs('/public/uploads/'.$this->destination_path.'background/',  $file, $filename);
                    $source = storage_path(). '/app/public/uploads/'. $this->destination_path.'background/'.$filename;

                    Image::make($source)->resize($max_width, $max_height, function($constraint) {
                        $constraint->aspectRatio();
                    })->save(upload_path($this->destination_path.$thumbnail_name));


                    // $file->move($source,$filename);
                    // insert to db
                    $data['background'] = $filename;

                $data->save();
            }

            if ($request->hasFile('video')) {



                // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                    $file = $request->file('video');
                    $nameFle= 'video_'. $data['id']. '_'. date('YmdHi');
                    $filename = $nameFle. '.'. $file->getClientOriginalExtension();
                    $thumbnail_name = 'tmb_'. $filename;
                    $max_width = config('custom.images.medium.width');
                    $max_height =  config('custom.images.medium.height');

                    if ( ! is_dir(upload_path($this->destination_path.'video/'))) {
                        Storage::makeDirectory('/public/uploads/'.$this->destination_path.'video/');
                    }
                    Storage::disk("local")->putFileAs('/public/uploads/'.$this->destination_path.'video/',  $file, $filename);
                    $source = storage_path(). '/app/public/uploads/'. $this->destination_path.'video/'.$filename;



                    // $file->move($source,$filename);
                    // insert to db
                    $data['video_name'] = $nameFle;
                    $data['video'] = $filename;
                    $data['path'] =upload_url($this->destination_path.'/video');
                    $data->save();
                    event(new VideoEvent($data));
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
        $this->parse['client'] = $this->model_client->get();
         $this->parse['page_title']  = '[Add]';
        $this->parse['form_action'] = $this->parse['add_url'];

        return view($this->prefix_routes. 'form', $this->parse);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        //
        if ($request->isMethod('post')) {
            $post = $request->all();


            $messages = [
                'required' => 'Kolom :attribute ini wajib diisi.',
                'min'      => 'Input :attribute tidak kurang dari :min karakter.',
                'unique'   => ':attribute anda sudah terdaftar.',
                'confirmed' => ':attribute tidak sama dengn Verify Password',
                'dimensions' => ':attribute dimensions tidak sesuai',
                'mimes' => 'format :attribute salah'
            ];
            $validator = Validator::make($request->all(), [
                'video' => 'required|mimes:mp4,avi',
            ], $messages);

            if ($request->hasFile('video')) {



                // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                    $file = $request->file('video');
                    $nameFle= 'video_'. $file->getClientOriginalName(). '_'. date('YmdHi');
                    $filename = $nameFle. '.'. $file->getClientOriginalExtension();
                    if ( ! is_dir(upload_path($this->destination_path.'video/'))) {
                        Storage::makeDirectory('/public/uploads/'.$this->destination_path.'video/');
                    }
                    Storage::disk("local")->putFileAs('/public/uploads/'.$this->destination_path.'video/',  $file, $filename);
                    // $file->move($source,$filename);
                    // insert to db
                    $paramvideo['video_name'] = $nameFle;
                    $paramvideo['video'] = $filename;
                    $paramvideo['status'] = '0';
                    $paramvideo['path'] =upload_url($this->destination_path.'/video');

                    $data = $this->model->create($paramvideo);

                    event(new VideoEvent($data));

            }

            $urlUpdate =  route($this->prefix_routes. 'detail', $data['id']);
            return redirect($urlUpdate);
        }
        return redirect()->route($this->prefix_routes. 'index');
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
         $this->parse['form_action'] = route($this->prefix_routes. 'detail', $id);
         $this->parse['client'] = $this->model_client->get();
        $this->parse['data'] = $data;
        $this->parse['upload_path'] = 'video/';
        if ($data) {
            if ($request->isMethod('post')) {

                $post = $request->all();


               $messages = [
                    'required' => 'Kolom :attribute ini wajib diisi.',
                    'min'      => 'Input :attribute tidak kurang dari :min karakter.',
                    'unique'   => ':attribute anda sudah terdaftar.',
                    'confirmed' => ':attribute tidak sama dengn Verify Password',
                    'mimes' => 'format :attribute salah',
                    'client_id.required' =>'Kolom Clinet ini wajib diisi.',
                    'photo.required' =>'Kolom Thumbnail Video ini wajib diisi.',
                    'photo.dimensions' =>'Thumbnail Video dimension tidak sesuai ( 360 X 178)',
                    'photo.mimes' =>'format Thumbnail Video salah (jpeg,jpg,png)',
                    'background.required' =>'Kolom Background ini wajib diisi.',
                    'background.dimensions' =>'Background dimension tidak sesuai ( 360 X 640)',
                    'background.mimes' =>'format Background salah (jpeg,jpg,png)',
                    'target_days.lt'=>'target views per hari harus lebih kecil dari target view',


                ];
                if ($data->photo =='' ||  $data->background =='') {
                    $validator = Validator::make($request->all(), [
                        'title' => 'required',
                        'description' => 'required',
                        'brand' => 'required',
                        'client_id' => 'required',
                        'target_view' => 'required',
                        'start_publish' => 'required',
                        'end_publish' => 'required',
                        'video' => 'mimes:mp4,avi',
                        'background' => 'required|dimensions:width=360,height=640|mimes:jpeg,jpg,png',
                        'photo' => 'required|dimensions:width=360,height=178|mimes:jpeg,jpg,png',
                        'target_days' => 'lt:target_view',
                    ],$messages);
                }else{
                    $validator = Validator::make($request->all(), [
                        'title' => 'required',
                        'description' => 'required',
                        'brand' => 'required',
                        'client_id' => 'required',
                        'target_view' => 'required',
                        'start_publish' => 'required',
                        'end_publish' => 'required',
                        'video' => 'mimes:mp4,avi',
                        'background' => 'dimensions:width=360,height=640|mimes:jpeg,jpg,png',
                        'photo' => 'dimensions:width=360,height=178|mimes:jpeg,jpg,png',
                        'target_days' => 'lt:target_view',
                    ],$messages);
                }


                if ($validator->fails()) {
                    return redirect()->route($this->prefix_routes. 'detail', $id)->with('form_message', [
                            'message' =>  array(
                                'title'         => $validator->errors()->first('title'),
                                'description'   => $validator->errors()->first('description'),
                                'brand'   => $validator->errors()->first('brand'),
                                'client_id'     => $validator->errors()->first('client_id'),
                                'target_view'   => $validator->errors()->first('target_view'),
                                'start_publish' => $validator->errors()->first('start_publish'),
                                'end_publish' => $validator->errors()->first('end_publish'),
                                'video'         => $validator->errors()->first('video'),
                                'background'    => $validator->errors()->first('background'),
                                'photo'         => $validator->errors()->first('photo'),
                                'target_days' => $validator->errors()->first('target_days'),
                            ),
                            'status' => 'danger',
                        ])->withInput();
                }
                $post['start_publish'] = date('Y-m-d',strtotime($post['start_publish']));
                $post['end_publish'] = date('Y-m-d',strtotime($post['end_publish']));
                $post['status'] ='1';
                $data->fill($post)->save();

                if ($request->hasFile('photo')) {



                    // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                        $file = $request->file('photo');
                        $filename = 'photo_'. $data['id']. '_'. date('YmdHi'). '.'. $file->getClientOriginalExtension();
                        $thumbnail_name = 'tmb_'. $filename;
                        $max_width = config('custom.images.medium.width');
                        $max_height =  config('custom.images.medium.height');

                        if ( ! is_dir(upload_path($this->destination_path))) {
                            Storage::makeDirectory('/public/uploads/'.$this->destination_path);
                        }
                        Storage::disk("local")->putFileAs('/public/uploads/'.$this->destination_path,  $file, $filename);
                        $source = storage_path(). '/app/public/uploads/'. $this->destination_path.$filename;

                        Image::make($source)->resize($max_width, $max_height, function($constraint) {
                            $constraint->aspectRatio();
                        })->save(upload_path($this->destination_path.$thumbnail_name));


                        // $file->move($source,$filename);
                        // insert to db
                        $data['photo'] = $filename;

                    $data->save();
                }

                if ($request->hasFile('background')) {



                    // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                        $file = $request->file('background');
                        $filename = 'background_'. $data['id']. '_'. date('YmdHi'). '.'. $file->getClientOriginalExtension();
                        $thumbnail_name = 'tmb_'. $filename;
                        $max_width = config('custom.images.medium.width');
                        $max_height =  config('custom.images.medium.height');

                        if ( ! is_dir(upload_path($this->destination_path.'background/'))) {
                            Storage::makeDirectory('/public/uploads/'.$this->destination_path.'background/');
                        }
                        Storage::disk("local")->putFileAs('/public/uploads/'.$this->destination_path.'background/',  $file, $filename);
                        $source = storage_path(). '/app/public/uploads/'. $this->destination_path.'background/'.$filename;

                        Image::make($source)->resize($max_width, $max_height, function($constraint) {
                            $constraint->aspectRatio();
                        })->save(upload_path($this->destination_path.$thumbnail_name));


                        // $file->move($source,$filename);
                        // insert to db
                        $data['background'] = $filename;

                    $data->save();
                }

                if ($request->hasFile('video')) {



                    // FatUploader::image($file, $this->destination_path, $filename, $resize = true);

                        $file = $request->file('video');
                        $nameFle= 'video_'. $data['id']. '_'. date('YmdHi');
                        $filename = $nameFle. '.'. $file->getClientOriginalExtension();
                        $thumbnail_name = 'tmb_'. $filename;
                        $max_width = config('custom.images.medium.width');
                        $max_height =  config('custom.images.medium.height');

                        if ( ! is_dir(upload_path($this->destination_path.'video/'))) {
                            Storage::makeDirectory('/public/uploads/'.$this->destination_path.'video/');
                        }
                        Storage::disk("local")->putFileAs('/public/uploads/'.$this->destination_path.'video/',  $file, $filename);
                        $source = storage_path(). '/app/public/uploads/'. $this->destination_path.'video/'.$filename;



                        // $file->move($source,$filename);
                        // insert to db
                        $data['video_name'] = $nameFle;
                        $data['video'] = $filename;
                        $data['status'] = '0';
                        $data['path'] =upload_url($this->destination_path.'/video');
                        $data->save();
                        event(new VideoEvent($data));
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


            return view($this->prefix_routes. 'form', $this->parse);
        }
        return redirect()->route($this->prefix_routes. 'index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function analitik(Request $request, $slug)
    {
        // $this->parse['page_title'] = '[Edit]';
        // $data = $this->model->where('slug',$slug)->first();

        //  $this->parse['form_action'] = route($this->prefix_routes. 'update', $id);
        // $this->parse['data'] = $data;



    }
    /**
     * Delete record.
     *
     * @param  Request $request
     *
     * @return json|array return
     */
    public function delete(Request $request,$id)
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
     * Delete record.
     *
     * @param  Request $request
     *
     * @return json|array return
     */
    public function cancles(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {
            $post = $request->all();
            $id = $post['id'];
            $data = $this->model->getModelById($id);

            if ($data['client_id']==null || $data['client_id']=='') {

                $this->model->deleteModelById($id);
            }



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


            return response()->json([
                'status' => 'success',
                'message' => 'Image has been deleted.'
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
    public function testVideo(Request $request)
    {
        // echo'ddddd';die;
    //     $start =  \FFMpeg\Coordinate\TimeCode::fromSeconds(1);

    //     $clipFilter = new \FFMpeg\Filters\Video\ClipFilter($start);
    //     FFMpeg::fromDisk('local')
    //     ->open('public/uploads/video//video/video_7_202005021943.mp4')
    //     ->addFilter(['-itsoffset', 1])
    //    ->export()->toDisk('local')
    //     ->inFormat(new FFMpeg\Format\Video\WMV())
    //     ->save('clip121.wmv');


        $start = \FFMpeg\Coordinate\TimeCode::fromSeconds(1);

        $duration =  \FFMpeg\Coordinate\TimeCode::fromSeconds(5);

        $clipFilter = new \FFMpeg\Filters\Video\ClipFilter($start,$duration);

        FFMpeg::fromDisk('local')
            ->open('public/uploads/video//video/video_7_202005021943.mp4')
            ->addFilter($clipFilter)
            ->export()
            ->toDisk('local')
            ->inFormat(new \FFMpeg\Format\Video\WMV)
            ->save('wew.wmv');
     }
}
