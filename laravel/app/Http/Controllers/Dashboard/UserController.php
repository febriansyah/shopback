<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\AuthUser;
use App\Models\Dashboard\UserGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use App\Models\Dashboard\LogDashboard;
use App\Events\Dashboard\Log;

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
    protected $prefix_routes = 'users.';
    /**
     * Prefix Api routing.
     *
     * @var string
     */
    protected $prefix_api_routes ='users';

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
     * Default guard.
     *
     * @var string
     */
    protected $guard;

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
        $this->guard = 'dashboard';
        $this->auth_user  = Auth::guard($this->guard)->user();

        $this->prefix_routes = 'dashboard.'. $this->prefix_routes;
        // $this->prefix_api_routes = 'api.'. $this->prefix_api_routes;

        $this->parse['upload_path'] = $this->destination_path;

        // $this->parse['data_url']           = route($this->prefix_routes. 'index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->parse['page_title'] = '[Edit]';
        $getUser  = Auth::guard($this->guard)->user();
        $data = $this->model->find($getUser->id);
        // dd($data);
        $this->parse['form_action'] = route($this->prefix_routes. 'profile');
        $this->parse['data'] = $data;
        if ($request->isMethod('post')) {
            $post = $request->all();

            $messages = [
                'email'    => 'Silakan masukkan format email yang benar.',
                'required' => 'Kolom :attribute ini wajib diisi.',
                'min'      => 'Input tidak kurang dari :min karakter.',
                'unique'   => 'email anda sudah terdaftar.',
            ];
            if($data->email != $post['email']){
                $validator = Validator::make($request->all(), [
                    'email'      => 'required|email|unique:' . $this->model->getConnectionName() . '.' . $this->model->getTable(),
                    'full_name' => 'required'
                ],$messages);
            }else{
                $validator = Validator::make($request->all(), [
                     'full_name' => 'required'
                ],$messages);
            }

            if ($validator->fails()) {
                    return redirect($this->parse['form_action'])->with('form_message', [
                        'message' => array(
                            'email'        => $validator->errors()->first('email'),
                            'full_name'    => $validator->errors()->first('full_name')
                        ),
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


            return redirect($this->parse['form_action'])->with('form_message', [
                    'message' => 'Success',
                    'status'  => 'success',
                ]);
        }
        return view($this->prefix_routes. 'profile', $this->parse);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request)
    {
        //
        $this->parse['page_title'] = '[Edit]';
        $getUser  = Auth::guard($this->guard)->user();
        $data = $this->model->find($getUser->id);

        $this->parse['form_action'] = route($this->prefix_routes. 'change_password');
        $this->parse['data'] = $data;

        if ($request->isMethod('post')) {
            $post = $request->all();

            $messages = [
                'password'    => 'Silakan masukkan password yang benar.',
                'required' => 'Kolom :attribute wajib diisi.',
                'min'      => ':attribute tidak kurang dari :min karakter.',
                'confirmed' => ':attribute tidak sama'
            ];
            $validator = Validator::make($request->all(), [
                'password'      => 'required|min:5|confirmed',
                'password_old' => 'required',
                'password_confirmation' => 'required'
            ],$messages);
            if ($validator->fails()) {
               return redirect($this->parse['form_action'])->with('form_message', [
                        'message' => array(
                            'password'        => $validator->errors()->first('password'),
                            'password_old'    => $validator->errors()->first('password_old'),
                            'password_confirmation'    => $validator->errors()->first('password_confirmation')
                        ),
                        'status' => 'danger',
                    ])->withInput();
            }

            if (Hash::check($post['password_old'], $data->password))
            {
                // The passwords match...
                $data->fill($post)->save();


                //  event(new Log($log));
                return redirect($this->parse['form_action'])->with('form_message', [
                        'message' => 'Success',
                        'status'  => 'success',
                    ]);
            }else{
                return redirect($this->parse['form_action'])->with('form_message', [
                    'message' => array(
                       'password_old'    => 'Password lama tidak sesuai'
                    ),
                    'status' => 'danger',
                ])->withInput();
            }

        }


        return view($this->prefix_routes. 'password', $this->parse);
    }


}
