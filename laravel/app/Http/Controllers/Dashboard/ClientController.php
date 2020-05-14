<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\Client;
use Validator;

class ClientController extends Controller
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
        $this->model     = new Client;

       $this->prefix_routes = 'dashboard.'. $this->prefix_routes;

        $this->parse['add_url']            = route($this->prefix_routes. 'create');
        $this->parse['url_data']       = route($this->prefix_routes. 'list');
        $this->parse['delete_url']         = route($this->prefix_routes. 'delete');
        // $this->parse['delete_picture_url'] = route($this->prefix_routes. 'delete_picture');
        $this->parse['record_perpage'] = "10";
    }
     /**
     * Listing data from record.
     *
     * @return json $return
     */
    public function list_data(Request $request)
    {

            $return['data']    = $this->model->where('status', '1')->get();
            $return['status']  = "success";
            $return['message'] = "Success";

            return response()->json($return);
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
                 'unique'   => ':attribute anda sudah terdaftar.',
            ];
            $validator = Validator::make($request->all(), [
                'name'      => 'required|unique:' . $this->model->getConnectionName() . '.' . $this->model->getTable(),
            ],$messages);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'status' => 'danger',
                ]);
            }
            $data = $this->model->create($post);

            return response()->json([
                'message' => 'Success',
                'status'  => 'success',
                'data'    => $this->model->where('status', '1')->get(),
            ]);
        }
        $error_message = 'anda tidak punya akses';
        if ($request->ajax()) {
            return response()->json([
                'status' => 'failed',
                'message' => alert_box($error_message, 'danger')
            ]);
        }else{
            return Redirect::to('cms')->withErrors($error_message);
        }
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

        if ($request->isMethod('post')) {
            $data = $this->model->find($id);
            $post = $request->all();


            $messages = [
                'required' => 'Kolom :attribute ini wajib diisi.',
                 'unique'   => ':attribute anda sudah terdaftar.',
            ];
            if ($data->name != $post['name'] ) {
                $validator = Validator::make($request->all(), [
                    'name'      => 'required|unique:' . $this->model->getConnectionName() . '.' . $this->model->getTable(),
                ], $messages);
            } else {
                $validator = Validator::make($request->all(), [
                    'name'      => 'required',
                ], $messages);
            }

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'status' => 'danger',
                ]);
            }

            $data->fill($post)->save();


            return response()->json([
                    'message' => 'Success',
                    'status'  => 'success',
            ]);
        }
        $error_message = 'anda tidak punya akses';
        if ($request->ajax()) {
            return response()->json([
                'status' => 'failed',
                'message' => alert_box($error_message, 'danger')
            ]);
        }else{
            return Redirect::to('cms')->withErrors($error_message);
        }

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
            $this->model->deleteModelById($id);

            // \FatLib::createLog('user_delete', 'SUCCESS Delete User', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been deleted.'
            ]);
        }
        $error_message = 'anda tidak punya akses';
        if ($request->ajax()) {
            return response()->json([
                'status' => 'failed',
                'message' => alert_box($error_message, 'danger')
            ]);
        }else{
            return Redirect::to('cms')->withErrors($error_message);
        }
    }


}