<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Dashboard\AuthUser;
use Auth;
use Password;
use Validator;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    //
     /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Default guard.
     *
     * @var string
     */
    protected $guard;

    /**
     * So we can call a model in every method.
     *
     * @var object|array
     */
    protected $model;

    /**
     * Prefix routing.
     *
     * @var string
     */
    protected $prefix_routes = 'password.';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:dashboard');

        $this->guard = 'dashboard';

        $this->prefix_routes = frontend_path('.' . $this->prefix_routes);

        $this->model = new AuthUser;

        $this->parse['form_action']  = route('dashboard.reset-password-post');

    }

    /**
     * Set guard.
     *
     * @return void
     */
    protected function guard()
    {
        return Auth::guard('dashboard');
    }

    /**
     * Password broker for selected auth provider
     *
     * @return void
     */
    public function broker()
    {
        return Password::broker('dashboarduser');
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


                    return redirect()->back()->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
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

        return view('dashboard.auth.resetpassword', $this->parse);
    }
    public function redirectPath(){
        return route('dashboard.index');
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

        $users->password = $password;

        // $user->setRememberToken(Str::random(60));

        $users->save();

        event(new PasswordReset($users));

        Auth::guard('dashboard')->login($user);
    }
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
