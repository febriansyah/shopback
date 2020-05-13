<?php

namespace App\Http\Controllers\Master\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Master\AuthUser;
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
        $this->middleware('guest:backend')->except('logout');

        $this->guard = 'backend';
        $this->model = new AuthUser;
    }

    /**
     * Login page.
     *
     * @return view layout
     */
    public function login(Request $request)
    {

        $loginPath  = 'master.auth.login';
        $redirectTo = route('master.index');

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'username' => 'required|exists:'. $this->model->getConnectionName(). '.'.$this->model->getTable(),
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => alert_box($validator->errors()->all(), 'danger')
                    ]);
                }

                return Redirect::to('master/login')->withErrors($validator);
            }
            $param_auth = [
                'username' => $request['username'],
                'password' => $request['password'],

            ];


            if (Auth::guard($this->guard)->attempt($param_auth)) {
                $user = $this->model->getInfoByUsername($request['username']);

                // update last login

                $user->last_login_at = date('Y-m-d H:i:s');

                $user->save();


                if (request()->session()->exists('tmp_login_master_redirect')) {

                    $redirectTo = request()->session()->pull('tmp_login_master_redirect', 'master.index');
                }

                if ($request->ajax()) {
                    return response()->json(['redirect_auth' => $redirectTo]);
                }


                return redirect()->to($redirectTo);
            } else {
                $error_message = 'Your credential is incorrect.';

                // \FatLib::createLog('login', 'FAILED User login', $request->except('password'));

                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => alert_box($error_message, 'danger')
                    ]);
                }
                // return redirect()
                //         ->withErrors([$error_message])->route($loginPath);
                        return Redirect::to('master/login')->withErrors($error_message);
            }

        }
        return view($loginPath, $this->parse);
    }

      /**
     * Logout url.
     *
     * @return redirect
     */
    public function logout()
    {
        Auth::guard($this->guard)->logout();

        return  Redirect::to('master/login');
    }
}
