<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\UserMenu;
use App\Models\Dashboard\ShopeBack;
use App\Models\Dashboard\Video;
use Auth;
class AnalitikController extends Controller
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
        $this->model_video     = new Video;
        $this->model_shopeback = new ShopeBack;

        $this->auth_user = Auth::guard(backend_guard())->user();

        $this->prefix_routes = 'dashboard.'. $this->prefix_routes;

        $this->parse['data_url']           = route($this->prefix_routes. 'index');
       $this->parse['url_data']       = route($this->prefix_routes. 'list');

    }
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id, $slug='' )
    {
        //
        $getVideo = $this->model_video->where('id', $id)->first();
        if($getVideo){
            $this->parse['video']  = $getVideo;
            $this->parse['total_view']  = $this->model_shopeback->where('video_id',$id)->count();
            $this->parse['uniq_user']  = $this->model_shopeback->where('video_id',$id)->groupBy('order_id')->get()->count();
            $this->parse['uniq_visitor']  = $this->model_shopeback->where('video_id',$id)->groupBy('order_id')->get()->count();
            $this->parse['avg']  = (int) $this->model_shopeback ->selectRaw('AVG(TIME_TO_SEC(duration)) as avg')->where('video_id',$id)->get()[0]['avg'];
            $this->parse['url_data']       = route($this->prefix_routes. 'list');

            return view('dashboard.analitik.analitik', $this->parse);
        }
        return redirect('cms');
    }
}
