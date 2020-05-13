<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

use App\Models\Master\UserMenu;
use App\Models\Master\UserGroup;
use App\Models\Master\LogDashboard;
use App\Events\Master\Log;

class GroupController extends Controller
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
    protected $prefix_routes = 'groups.';
    /**
     * Prefix Api routing.
     *
     * @var string
     */
    protected $prefix_api_routes ='groups';

     /**
     * Prefix routing.
     *
     * @var string
     */
    protected $destination_path = 'groups/';

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
        $this->model     = new UserGroup;
        $this->user_menu = new UserMenu;
        $this->auth_user = Auth::guard(backend_guard())->user();

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
        return view('master.groups.groups', $this->parse);
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
                $return['data'][$row]['actions']     = '<a href="'. route($this->prefix_routes. 'update', $record['id']). '" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></a> &nbsp;
                                                        <a href="'. route($this->prefix_routes. 'permission', $record['id']). '" class="btn btn-warning btn-sm"><i class="fa fa-universal-access"></i></a>';
                $return['data'][$row]['name']        = $record['name'];
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

            if ( ! is_superadmin()) {
                $post['is_superadmin'] = 0;
            }

            $data = $this->model->create($post);

            // \FatLib::createLog('user_group_create', 'SUCCESS Create User Group ID: '. $data['id']);
             //event log
            //  $users = Auth::guard(backend_guard())->user();
            //  $log = new LogDashboard();
            //  $log = array(
            //                  'user_group_id' => $users->user_group_id,
            //                  'user_id'       => $users->id,
            //                  'action'        => 'user_group_create',
            //                  'description'   => 'SUCCESS Create User Group ID: ' . $data['id'],
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
        $this->parse['page_title'] = '[Add]';
        $this->parse['form_action'] = $this->parse['add_url'];

        return view($this->prefix_routes. 'form', $this->parse);
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
        if (! $id ||  ! $data ) {
            return redirect($this->parse['data_url'])->with('flash_message', [
                    'message' => 'Sorry. We couldn\'t find what your looking for.',
                    'status'  => 'warning',
                ]);
        }

        $this->parse['form_action'] = route($this->prefix_routes. 'update', $id);
        $this->parse['data'] = $data;

        if ($request->isMethod('post')) {
            $post = $request->all();

            // dd($post);

            $validator = Validator::make($post, $this->validation_rules);

            if ($validator->fails()) {
                return redirect($this->parse['form_action'])->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }

            if ( ! is_superadmin()) {
                $post['is_superadmin'] = 0;
            }

            $data->fill($post)->save();

            // \FatLib::createLog('user_group_update', 'SUCCESS Update User Group ID: '. $data['id']);
            //event log
            // $users = Auth::guard(backend_guard())->user();
            // $log = new LogDashboard();
            // $log = array(
            //                 'user_group_id' => $users->user_group_id,
            //                 'user_id'       => $users->id,
            //                 'action'        => 'user_group_update',
            //                 'description'   => 'SUCCESS Update User Group ID: ' . $data['id'],
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

        return view($this->prefix_routes. 'form', $this->parse);
    }

    /**
     * permission page.
     *
     * @param  Request $request
     * @param  integer $id
     *
     * @return
     */
    public function permission(Request $request, $id = 0)
    {
        $this->parse['page_title'] = '[Permission]';
        $data = $this->model->find($id);
        if (! $id ||  ! $data ) {
            return redirect($this->parse['data_url'])->with('flash_message', [
                    'message' => 'Sorry. We couldn\'t find what your looking for.',
                    'status'  => 'warning',
                ]);
        }

        $this->parse['form_action'] = route($this->prefix_routes. 'permission', $id);
        $this->parse['data'] = $data;

        $this->parse['permission_menus'] = $this->user_menu->getAuthMenuByGroup($id)->groupBy('id');
        $this->parse['user_menus'] = $this->user_menu->getAllRecords()->threaded('parent_id');

        if ($request->isMethod('post')) {
            $post = $request->all();

            $validator = Validator::make($post, [
                    'user_menus' => 'required|array|min:1'
                ]);

            if ($validator->fails()) {
                return redirect($this->parse['form_action'])->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }

            $data->user_menus()->sync($post['user_menus']);

            // \FatLib::createLog('user_group_authorize', 'SUCCESS Authorize User Group ID: '. $data['id'], $post);
            //event log
            // $users = Auth::guard(backend_guard())->user();
            // $log = new LogDashboard();
            // $log = array(
            //                 'user_group_id' => $users->user_group_id,
            //                 'user_id'       => $users->id,
            //                 'action'        => 'user_group_authorize',
            //                 'description'   => 'SUCCESS Authorize User Group ID: ' . $data['id'],
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

        return view($this->prefix_routes. 'permission', $this->parse);
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

            $own_group = false;

            if (is_array($id)) {
                foreach ($id as $key => $value) {
                    if (auth_user()->user_group_id == $value) {
                        $own_group = true;
                        break;
                    }
                }
            } else {
                if (auth_user()->user_group_id == $id) {
                    $own_group = true;
                }
            }
            if ($own_group == true) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'You can\'t delete your own group.'
                ]);
            }

            // delete authorized menus
            if (is_array($id)) {
                foreach ($data as $key => $single) {
                    if ($single->has('user_menus')) {
                        $single->user_menus()->sync([]);
                    }
                }
            } else {
                if ($data->has('user_menus')) {
                    $data->user_menus()->sync([]);
                }
            }
            $this->model->deleteModelById($id);

             //event log
            //  $users = Auth::guard(backend_guard())->user();
            //  $log = new LogDashboard();
            //  $log = array(
            //                  'user_group_id' => $users->user_group_id,
            //                  'user_id'       => $users->id,
            //                  'action'        => 'user_group_delete',
            //                  'description'   => 'SUCCESS Delete User Group ID: ' . $data['id'],
            //                  'path'          => $reques->fullUrl(),
            //                  'ip_address'    => $reques->ip(),
            //                  'raw_data'      => ($data != '') ? response()->json($data) : response()->json(request()->input()),
            //              );

            //  event(new Log($log));

            return response()->json([
                'status'  => 'success',
                'message' => 'Data has been deleted.'
            ]);
        }
    }
}
