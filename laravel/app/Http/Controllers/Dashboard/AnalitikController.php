<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\UserMenu;
use App\Models\Dashboard\ShopeBack;
use App\Models\Dashboard\Video;
use Illuminate\Support\Carbon;
use Auth;
use DateTime;
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
            $this->parse['total_view']  = $this->model_shopeback->where('video_id',$id)->get()->count();

            $this->parse['uniq_user']  = $this->model_shopeback->where('video_id',$id)->groupBy('order_id')->get()->count();
            $this->parse['uniq_visitor']  = $this->model_shopeback->where('video_id',$id)->groupBy('order_id')->get()->count();
            $this->parse['avg']  = (int) $this->model_shopeback ->selectRaw('AVG(TIME_TO_SEC(duration)) as avg')->where('video_id',$id)->get()[0]['avg'];
            $this->parse['url_data']       = route($this->prefix_routes. 'list');
            $nowDate = Carbon::now();



            $date = array();
            $data = array();
            for ($i=0;$i<=7;$i++)
            {
                $date[$i] = $nowDate->subDay($i)->toDateString();
                $data[]   = $this->model_shopeback->where('video_id',$id)->whereDate('created_at',$date[$i])->count();

            }
            $this->parse['chartViwer']['date'] = json_encode($date);
            $this->parse['chartViwer']['data'] = json_encode($data);
            $this->parse['chartViwer']['series'] = 'viwer';

            $array = array('25','50','70','100');
            $category = array();
            $data = array();
            for ($i=0;$i<=3;$i++)
            {
                $category[$i] = $array[$i].'%';

                $data[]   = $this->model_shopeback->where('video_id',$id)->where('persentase',$array[$i])->get()->count();

            }

            $this->parse['chartPersentase']['category'] =json_encode($category);
            $this->parse['chartPersentase']['data'] = json_encode($data);
            $this->parse['chartPersentase']['series'] = 'viwer';
            // dd($this->parse);
            return view('dashboard.analitik.analitik', $this->parse);
        }
        return redirect('cms');
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        //
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {

            $startDate = date('Y-m-d', strtotime($post['startDate']));
            $startDate = Carbon::parse($startDate);
            $endDate = date('Y-m-d', strtotime($post['endDate']));
            $endDate = Carbon::parse($endDate);
            $id = $post['id'];

            $this->parse['total_view']  = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->count();
            $this->parse['uniq_visitor']  = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->groupBy('order_id')->get()->count();
            $this->parse['avg']  = (int) $this->model_shopeback ->selectRaw('AVG(TIME_TO_SEC(duration)) as avg')->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->get()[0]['avg'];


            $start = new DateTime($startDate->toDateString());
            $end   = new DateTime($endDate->toDateString());
            $selisih =  $end->diff($start);
            $date = array();
            $data = array();

            for ($i=0;$i<=$selisih->days;$i++)
            {
                if($i==0){
                    $date[$i] = $startDate->toDateString();
                }else{
                    $date[$i] = $startDate->addDay()->toDateString();
                }


                $data[]   = $this->model_shopeback->where('video_id',$id)->whereDate('created_at',$date[$i])->count();

            }
            $this->parse['chartViwer']['date'] = json_encode($date);
            $this->parse['chartViwer']['data'] = json_encode($data);
            $this->parse['chartViwer']['series'] = 'viwer';

            $array = array('25','50','70','100');
            $category = array();
            $data = array();
            for ($i=0;$i<=3;$i++)
            {
                $category[$i] = $array[$i].'%';

                $data[]   = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->where('persentase',$array[$i])->get()->count();

            }

            $this->parse['chartPersentase']['category'] =json_encode($category);
            $this->parse['chartPersentase']['data'] = json_encode($data);
            $this->parse['chartPersentase']['series'] = 'viwer';

            return response()->json($this->parse);
        }
        return redirect()->route($this->prefix_routes. 'index');
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getViwer(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {
            $startDate = date('Y-m-d', strtotime($post['startDate']));
            $startDate = Carbon::parse($startDate);
            $endDate = date('Y-m-d', strtotime($post['endDate']));
            $endDate = Carbon::parse($endDate);
            $id = $post['id'];
            $this->parse['total_view']  = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->count();

            return response()->json($this->parse);
        }
        return redirect()->route($this->prefix_routes. 'index');

    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUniq(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {
            $startDate = date('Y-m-d', strtotime($post['startDate']));
            $startDate = Carbon::parse($startDate);
            $endDate = date('Y-m-d', strtotime($post['endDate']));
            $endDate = Carbon::parse($endDate);
            $id = $post['id'];
            $this->parse['uniq_user']  = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->groupBy('order_id')->get()->count();

            return response()->json($this->parse);
        }
        return redirect()->route($this->prefix_routes. 'index');

    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVisitor(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {
            $startDate = date('Y-m-d', strtotime($post['startDate']));
            $startDate = Carbon::parse($startDate);
            $endDate = date('Y-m-d', strtotime($post['endDate']));
            $endDate = Carbon::parse($endDate);
            $id = $post['id'];
            $this->parse['uniq_visitor']  = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->groupBy('order_id')->get()->count();


            return response()->json($this->parse);
        }

    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAvg(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {
            $startDate = date('Y-m-d', strtotime($post['startDate']));
            $startDate = Carbon::parse($startDate);
            $endDate = date('Y-m-d', strtotime($post['endDate']));
            $endDate = Carbon::parse($endDate);
            $id = $post['id'];
            $this->parse['avg']  = (int) $this->model_shopeback ->selectRaw('AVG(TIME_TO_SEC(duration)) as avg')->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $endDate->toDateString().' 00:00:00'])->get()[0]['avg'];
            return response()->json($this->parse);
        }
        return redirect()->route($this->prefix_routes. 'index');

    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataChart(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {
            $startDate = date('Y-m-d', strtotime($post['startDate']));
            $startDate = Carbon::parse($startDate);
            $endDate = date('Y-m-d', strtotime($post['endDate']));
            $endDate = Carbon::parse($endDate);
            $id = $post['id'];

            $start = new DateTime($startDate->toDateString());
            $end   = new DateTime($endDate->toDateString());
            $selisih =  $end->diff($start);
            $date = array();
            $data = array();

            for ($i=0;$i<=$selisih->days;$i++)
            {
                if($i==0){
                    $date[$i] = $startDate->format('Y-m-d');
                }else{
                    $date[$i] = $startDate->addDay()->format('Y-m-d');
                }


                $data[]   = $this->model_shopeback->where('video_id',$id)->whereDate('created_at',$date[$i])->count();

            }
            $this->parse['chartViwer']['date'] = json_encode($date);
            $this->parse['chartViwer']['data'] = json_encode($data);
            $this->parse['chartViwer']['series'] = 'viwer';

            return response()->json($this->parse);
        }
        return redirect()->route($this->prefix_routes. 'index');

    }
}
