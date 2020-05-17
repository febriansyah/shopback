<?php

namespace App\Http\Controllers\Dashboard\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Dashboard\AuthUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Redirect;
use Validator;
use Auth;
use Hash;


class AuthController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

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
     * Set username for login.
     *
     * @var string
     */
    protected $username = 'username';

    /**
     * Default guard.
     *
     * @var string
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:dashboard')->except('logout');

        $this->guard = 'dashboard';
        $this->model = new AuthUser;
    }

    /**
     * Login page.
     *
     * @return view layout
     */
    public function login(Request $request)
    {

        $loginPath  = 'dashboard.auth.login';
        $redirectTo = route('dashboard.index');

        if ($request->isMethod('post')) {

            $messages = [
                'email'    => 'Silakan masukkan format email yang benar.',
                'required' => 'Kolom :attribute ini wajib diisi.',
                'min'      => 'Input :attribute tidak kurang dari :min karakter.',
                'unique'   => ':attribute anda sudah terdaftar.',
                'confirmed' => ':attribute tidak sama dengn Verify Password'
            ];
            $validator = Validator::make($request->all(), [
                'email'      => 'required',
                'password'      => 'required',
            ],$messages);
            if ($validator->fails()) {
                return redirect()->route($loginPath)->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }
            $param_auth = [
                'email' => $request['email'],
                'password' => $request['password'],

            ];

            $remember_me = $request->has('remember_me') ? true : false;
            // if (Auth::guard($this->guard)->attempt($param_auth)) {
            if (Auth::guard($this->guard)->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me))
            {
                $user = $this->model->getInfoByEmail($request['email']);

                // update last login

                $user->last_login_at = date('Y-m-d H:i:s');

                $user->save();


                if (request()->session()->exists('tmp_login_dashboard_redirect')) {

                    $redirectTo = request()->session()->pull('tmp_login_dashboard_redirect', 'dashboard.index');
                }

                return redirect()->to($redirectTo);
            } else {
                $error_message = 'Email dan Password tidak ada';

                // return redirect()
                return redirect()->route($loginPath)->with('form_message', [
                    'message' => $error_message,
                    'status' => 'danger',
                 ])->withInput();
            }

        }
        return view($loginPath, $this->parse);
    }
     /**
     * Signup page.
     *
     * @return view layout
     */
    public function signup(Request $request)
    {
        $signupPath = 'dashboard.auth.register';
        $redirectTo = route('dashboard.index');
        $this->parse['head_title'] = 'Signup';

        if ($request->isMethod('post')) {
            $messages = [
                'email'    => 'Silakan masukkan format email yang benar.',
                'required' => 'Kolom :attribute ini wajib diisi.',
                'min'      => 'Input :attribute tidak kurang dari :min karakter.',
                'unique'   => ':attribute anda sudah terdaftar.',
                'confirmed' => ':attribute tidak sama dengn Verify Password'
            ];
            $validator = Validator::make($request->all(), [
                'email'      => 'required|email|unique:' . $this->model->getConnectionName() . '.' . $this->model->getTable(),
                'password'      => 'required|min:5|confirmed',
                // 'phone'      => 'required',/
                // 'gender'     => 'required',
                'full_name' => 'required'
            ],$messages);
            if ($validator->fails()) {
                return redirect()->route($signupPath)->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
            }

            $post = $request->all();

            $post['last_login_at']     = date('Y-m-d H:i:s');
            $post['previous_login_at'] = date('Y-m-d H:i:s');

            $data = $this->model->create($post);

            Auth::guard($this->guard)->login($data);

            // event(new UserRegistered($data));

            return redirect($redirectTo);


        }

        $this->parse['form_action'] = route($signupPath);

        return view($signupPath, $this->parse);
    }
      /**
     * Logout url.
     *
     * @return redirect
     */
    public function logout()
    {
        Auth::guard($this->guard)->logout();

        return  Redirect::to('cms/login');
    }
}
