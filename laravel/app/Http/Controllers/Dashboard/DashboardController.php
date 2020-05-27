<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Client;
use App\Models\Dashboard\Video;
use Auth;

class DashboardController extends Controller
{
     //
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /**
     * Set globally for this controller.
     *
     * @var array
     */
    protected $parse = [];

    /**
     * Prefix routing.
     *
     * @var string
     */
    protected $prefix_routes;

    /**
     * Class constructor.
     *
     */
    public function __construct()
    {

        $this->prefix_routes = 'dashboard';
        $this->model_client = new Client;
        $this->model_video = new Video;

        $this->parse['head_title']  = 'Dashboard';
    }

    /**
     * Index page.
     *
     * @return layout
     */
    public function index()
    {
        $this->auth_user  = Auth::guard('dashboard')->user();
        // dd($this->auth_user);
        $this->parse['client'] = $this->model_client->count();
        $this->parse['ads'] = $this->model_video->where('status',1)->count();
        $this->parse['recent'] = $this->model_video->where(function($query) {
                 $query->whereDate('end_publish','>=',date('Y-m-d'));
            })->where('status',1)->count();
        $this->parse['video'] = $this->model_video->where('status',1)->orderBy('created_at','desc')->take(10)->get();

        return view('dashboard.dashboard.dashboard', $this->parse);
    }
}
