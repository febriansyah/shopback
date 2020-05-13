<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

use App\Models\Master\UserMenu;
use App\Models\Master\UserGroup;

class UserMenuController extends Controller
{
     /**
     * Prefix routing.
     *
     * @var string
     */
    protected $prefix_routes = 'users_menu.';
    /**
     * Prefix Api routing.
     *
     * @var string
     */
    protected $prefix_api_routes ='users_menu';

     /**
     * Prefix routing.
     *
     * @var string
     */
    protected $destination_path = 'users_menu/';

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
        'parent_id' => 'required|numeric',
        'menu'      => 'required|min:3',
        'file'      => 'required',
        'position'  => 'required|numeric|min:1',

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
        $this->model      = new UserMenu;
        $this->user_group = new UserGroup;

        $this->auth_user  = Auth::guard(backend_guard())->user();

        $this->prefix_routes = 'master.'. $this->prefix_routes;

        $this->parse['data_url']   = route($this->prefix_routes. 'index');
        $this->parse['add_url']    = route($this->prefix_routes. 'create');
        $this->parse['delete_url'] = route($this->prefix_routes. 'delete');
        $this->parse['url_data']       = route($this->prefix_routes. 'list_data');
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
        return view('master.users_menu.users_menu', $this->parse);
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
            $param['start']         = $post['start'];
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
                $return['data'][$row]['menu']        = $record['menu'];
                $return['data'][$row]['file']       = $record['file'];
                $return['data'][$row]['parent_name'] = ($record['parent_id'] == 0 || $record['parent_id'] == '') ? 'ROOT' : $record['parent']['menu'];

                $return['data'][$row]['create_at']   = date('d-m-Y H:i', strtotime($record['created_at']));
            }

            return response()->json($return);
        }
        return redirect()->route($this->prefix_routes. 'index');
    }
   /**
     * Create page.
     *
     * @param  Request $request
     *
     * @return
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $post = $request->all();

            $validator = Validator::make($post, $this->validation_rules);

            if ($validator->fails()) {
                return redirect($this->parse['add_url'])->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }

            $data = $this->model->create($post);

            // for development only. otherwise, disable this method
            if (app()->environment() == 'local' && is_superadmin()) {
                // insert authentication
                $insert_auth = [
                    [
                        'user_group_id' => auth_user()->user_group_id,
                    ]
                ];
                $data->user_groups()->attach($insert_auth);
            }

            // \FatLib::createLog('user_menu_create', 'SUCCESS Create User Menu ID: '. $data['id']);
              //event log
            //   $users = Auth::guard(backend_guard())->user();
            //   $log = new LogDashboard();
            //   $log = array(
            //                   'user_group_id' => $users->user_group_id,
            //                   'user_id'       => $users->id,
            //                   'action'        => 'user_menu_create',
            //                   'description'   => 'SUCCESS  Create  User Menu ID: ' . $data['id'],
            //                   'path'          => $reques->fullUrl(),
            //                   'ip_address'    => $reques->ip(),
            //                   'raw_data'      => ($data != '') ? response()->json($data) : response()->json(request()->input()),
            //               );

            //   event(new Log($log));

            return redirect($this->parse['data_url'])->with('flash_message', [
                    'message' => 'Success',
                    'status'  => 'success',
                ]);
        }
        $this->parse['page_title'] = '[Add]';
        $this->parse['parents'] = $this->model->getAllRecords()->threaded('parent_id');
        $this->parse['form_action'] = $this->parse['add_url'];
        $this->parse['max_position'] = UserMenu::max('position');

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
     * Update page.
     *
     * @param  Request $request
     * @param  integer $id
     *
     * @return
     */
    public function update(Request $request, $id = 0)
    {
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

            $validator = Validator::make($post, $this->validation_rules);

            if ($validator->fails()) {
                return redirect($this->parse['form_action'])->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }

            $data->fill($post)->save();

            // \FatLib::createLog('user_menu_update', 'SUCCESS Update User Menu ID: '. $data['id']);
            //event log
            // $users = Auth::guard(backend_guard())->user();
            // $log = new LogDashboard();
            // $log = array(
            //                 'user_group_id' => $users->user_group_id,
            //                 'user_id'       => $users->id,
            //                 'action'        => 'user_menu_update',
            //                 'description'   => 'SUCCESS  Update  User Menu ID: ' . $data['id'],
            //                 'path'          => $reques->fullUrl(),
            //                 'ip_address'    => $reques->ip(),
            //                 'raw_data'      => ($data != '') ? response()->json($data) : response()->json(request()->input()),
            //             );

            // event(new Log($log));
            return redirect($this->parse['data_url'])->with('flash_message', [
                    'message' => 'Success',
                    'status'  => 'success',
                ]);
        }

        $parents = $this->model->getAllRecords();

        $this->parse['parents'] = $parents->threaded('parent_id');

        return view($this->prefix_routes. 'form', $this->parse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        if ($request->isMethod('delete') && $request->ajax()) {
            $id = $request->id;
            $data = $this->model->getModelById($id);
            if (! $id ||  ! $data) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to delete. Please try again.'
                ]);
            }

            // delete authorized menus
            if (is_array($id)) {
                foreach ($data as $key => $single) {
                    if ($single->has('user_groups')) {
                        $single->user_groups()->sync([]);
                    }
                }
            } else {
                if ($data->has('user_groups')) {
                    $data->user_groups()->sync([]);
                }
            }

            $this->model->deleteModelById($id);

            // \FatLib::createLog('user_menu_delete', 'SUCCESS Delete User Menu', $id);
            // $users = Auth::guard(backend_guard())->user();
            // $log = new LogDashboard();
            // $log = array(
            //                 'user_group_id' => $users->user_group_id,
            //                 'user_id'       => $users->id,
            //                 'action'        => 'user_menu_delete',
            //                 'description'   => 'SUCCESS  Delete  User Menu ID: ' . $data['id'],
            //                 'path'          => $reques->fullUrl(),
            //                 'ip_address'    => $reques->ip(),
            //                 'raw_data'      => ($data != '') ? response()->json($data) : response()->json(request()->input()),
            //             );

            // event(new Log($log));
            return response()->json([
                'status' => 'success',
                'message' => 'Data has been deleted.'
            ]);
        }
    }
}
