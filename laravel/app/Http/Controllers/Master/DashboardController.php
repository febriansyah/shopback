<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $this->prefix_routes = 'master';

        $this->parse['head_title']  = 'Dashboard';
    }

    /**
     * Index page.
     *
     * @return layout
     */
    public function index()
    {

        return view('master.dashboard.dashboard', $this->parse);
    }
}
