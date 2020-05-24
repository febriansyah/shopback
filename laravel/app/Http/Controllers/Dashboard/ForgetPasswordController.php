<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\AuthUser;
use App\Events\User\ForgetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Validator;
use Password;

class ForgetPasswordController extends Controller
{
    //
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

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
     * Prefix routing.
     *
     * @var string
     */
    protected $prefix_routes = 'auth.';

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redirectTo = route('dashboard.index');
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

                    return redirect()->route('dashboard.forgetpassword')->with('form_message', [
                        'message' => $validator->errors()->all(),
                        'status' => 'danger',
                    ])->withInput();
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

                    return redirect()->route('dashboard.forgetpassword')->with('form_message', [
                        'status'        => 'success',
                        'message' => 'success'
                    ])->withInput();
                }else{
                    return redirect($redirectTo);
                }
            }else{

                    return redirect()->route('dashboard.forgetpassword')->with('form_message', [
                        'message' => 'Email Tidak Terdaftar',
                        'status' => 'danger',
                    ])->withInput();
            }

        }
        return view('dashboard.auth.forgetpassword', $this->parse);

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
}
