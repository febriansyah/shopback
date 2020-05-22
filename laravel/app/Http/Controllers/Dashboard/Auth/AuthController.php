<?php

namespace App\Http\Controllers\Dashboard\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Dashboard\AuthUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\PasswordReset;
use Redirect;
use Validator;
use Auth;
use Hash;
use Mail;

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
        // Mail::send('emails.test', compact('user'), function ($message) {
        //     $message->to('wahyu_bunyu_jogja@yahoo.co.id');
        //     $message->from('donotreply@repository.com', 'Repository ');
        //     $message->subject("coba email");
        // });

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
     /**
     * Logout url.
     *
     * @return redirect
     */
    public function forgetpassword(Request $request)
    {
        $redirectTo = route('cms');
        if ($request->isMethod('post')) {
            $post = $request->all();
            $messages = [
                'email'    => 'Silakan masukkan format email yang benar.',
                'required' => 'Kolom :attribute ini wajib diisi.',
                'min'      => 'Input :attribute tidak kurang dari :min karakter.',
                'unique'   => ':attribute anda sudah terdaftar.',
                'confirmed' => ':attribute tidak sama dengn Verify Password'
            ];
            $validator = Validator::make($request->all(), [
                'email'      => 'required|email',

            ],$messages);
            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json([
                        'status'  => 'failed',
                        'message' => array(
                                            'email'   => $validator->errors()->first('email'),

                        )
                    ]);
                }
            }
            $user = $this->model->getInfoByEmail($post['email']);

            if($user){
                //  event(new ForgetPassword($user));
                $response = $this->broker()->sendResetLink(
                    $request->only('email')
                );
                $response == Password::RESET_LINK_SENT;
                if ($request->ajax()) {
                    return response()->json([
                        'status'        => 'success',
                        'redirect_auth' => $redirectTo
                    ]);
                }else{
                    return redirect($redirectTo);
                }
            }else{
                return response()->json([
                        'status'  => 'failed',
                        'message' => array(
                                            'email'   => 'Email Tidak Terdaftar',

                        )
                    ]);
            }

        }
        return redirect()->route(frontend_path('.home'));
    }
    /**
     * Password broker for selected auth provider
     *
     * @return void
     */
    public function broker()
    {
        return Password::broker('users');
    }

    /**
     * Index page.
     *
     * @param Request $request
     *
     * @return void
     */
    public function reset(Request $request, $token = null)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'token'    => 'required',
                'password' => 'required|confirmed|min:6',
                'email'    => 'required|email|exists:' . $this->model->getConnectionName() . '.' . $this->model->getTable(),
            ]);
            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => alert_box($validator->errors()->all(), 'danger')
                    ]);
                }
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors($validator);
            }

            // Here we will attempt to reset the user's password. If it is successful we
            // will update the password on an actual user model and persist it to the
            // database. Otherwise we will parse the error and return the response.
            $response = $this->broker()->reset(
                $this->credentials($request),
                function ($user, $password) {

                    $this->resetPassword($user, $password);
                }
            );

            // If the password was successfully reset, we will redirect the user back to
            // the application's home authenticated view. If there is an error we can
            // redirect them back to where they came from with their error message.
            return $response == Password::PASSWORD_RESET
                ? $this->sendResetResponse($request, $response)
                : $this->sendResetFailedResponse($request, $response);

        }

        $this->parse['token'] = $token;

        return view($this->prefix_routes . 'reset', $this->parse);
    }
    public function redirectPath(){
        return route('frontend.home');
    }
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {

        $users = $this->model->getInfoByEmail($user['email']);

        $users->password = Hash::make($password);

        // $user->setRememberToken(Str::random(60));

        $users->save();

        event(new PasswordReset($users));

        Auth::guard('web')->login($user);
    }
}
