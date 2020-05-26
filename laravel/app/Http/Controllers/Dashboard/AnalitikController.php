<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\UserMenu;
use App\Models\Dashboard\ShopeBack;
use App\Models\Dashboard\Video;
use App\Models\Dashboard\ShareUrl;
use Illuminate\Support\Carbon;
use Auth;
use DateTime;
use Hash;
use Analytics;
use Spatie\Analytics\Period;
use Mail;

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
        $this->model_shareurl  = new ShareUrl;


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
			$nowDate = Carbon::now()->addDay();
			$startDate = Carbon::now()->addDay();
			$startDate =$startDate->subDays(7);


            $this->parse['total_view']  = $this->model_shopeback->where('status',1)->where('video_id',$id)->get()->count();

            $this->parse['uniq_user']  = $this->model_shopeback->where('video_id',$id)->groupBy('order_id')->get()->count();
			$this->parse['persent_view']  = $this->model_shopeback->where('status',1)->where('persentase','100')->where('video_id',$id)->get()->count();
            $this->parse['uniq_visitor']  = $this->model_shopeback->where('video_id',$id)->groupBy('order_id')->get()->count();
            $this->parse['avg']  = (int) $this->model_shopeback ->selectRaw('AVG(TIME_TO_SEC(duration)) as avg')->where('video_id',$id)->get()[0]['avg'];
            $this->parse['url_data']       = route($this->prefix_routes. 'list');

			$strKetStartDate ='';
			$strKetEndDate ='';
			if($startDate->format('m')==$nowDate->format('m')){
				$strKetStartDate .=$startDate->format('d');
				$strKetEndDate .=$nowDate->format('d F');
			}else if($startDate->format('m')!=$nowDate->format('m')){
				$strKetStartDate .=$startDate->format('d m');
				$strKetEndDate .=$nowDate->format('d F');
			}

			if($startDate->format('y')==$nowDate->format('y')){
				$strKetEndDate .=', '.$nowDate->format('Y');
			}else if($startDate->format('y')!=$nowDate->format('y')){
				$strKetStartDate .= ', '.$startDate->format('Y');
				$strKetEndDate .=', '.$nowDate->format('Y');
			}
			$this->parse['ketDate'] = $strKetStartDate.' - ' .$strKetEndDate;

            $date = array();
            $data = array();
            for ($i=0;$i< 7;$i++)
            {
                if($i==0){
                    $date[$i] = $nowDate->toDateString();
                }else{
                    $date[$i] = $nowDate->subDays()->toDateString();
                }

                $data[]   = $this->model_shopeback->where('status',1)->where('video_id',$id)->whereDate('created_at',$date[$i])->count();

            }
            $this->parse['chartViwer']['date'] = json_encode($date);
            $this->parse['chartViwer']['data'] = json_encode($data);
            $this->parse['chartViwer']['series'] = 'viwer';

            $array = array('0','25','50','70','100');
            $category = array();
            $data = array();
            for ($i=0;$i<=4;$i++)
            {
                $category[$i] = $array[$i].'%';
				if($array[$i]<100){


					$data[]   = $this->model_shopeback->where(function($query) use ($array,$i)  {

								$startPersent = $array[$i];
								$akhirPersent = $array[$i+1] - 1;
								$query->whereRaw("persentase >=".$startPersent);
								$query->whereRaw("persentase <".$akhirPersent);

							})->where('status',1)->where('video_id',$id)->get()->count();
				} else{
					$data[]   = $this->model_shopeback->where('status',1)->where('video_id',$id)->where('persentase',$array[$i])->get()->count();
				}


            }

            $this->parse['chartPersentase']['category'] =json_encode($category);
            $this->parse['chartPersentase']['data'] = json_encode($data);
            $this->parse['chartPersentase']['series'] = 'viwer';

            $city = Analytics::performQuery(
                Period::years(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:pageviews',
                    'dimensions' => 'ga:city, ga:pageTitle',
                    'filters' => 'ga:pageTitle%3D~%5Evideo ads : '.$getVideo['title']
                ]
            );
            $gaCity= collect($city['rows'] ?? [])->map(function (array $dateRow) {
                return [
                    $dateRow[0],
                    (int) $dateRow[2],
                ];
            });
            $this->parse['chartGACity']['data'] = json_encode($gaCity);
            $this->parse['chartGACity']['series'] = 'viwer';

            $gender = Analytics::performQuery(
                Period::years(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:pageviews',
                    'dimensions' => 'ga:userGender,ga:pageTitle',
                    'filters' => 'ga:pageTitle%3D~%5Evideo ads : '.$getVideo['title']
                ]
            );
            $gaGender= collect($gender['rows'] ?? [])->map(function (array $dateRow) {
                return [
                    $dateRow[0],
                    (int) $dateRow[2],
                ];
            });
            $this->parse['chartGACity']['data'] = json_encode($gaCity);
            $this->parse['chartGACity']['series'] = 'viwer';

            $this->parse['chartGAGender']['data'] = json_encode($gaGender);
            $this->parse['chartGAGender']['series'] = 'viwer';
            // dd(json_encode($gaCity));

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

            // $startDate = date('Y-m-d', strtotime($post['startDate']));
            // $startDate = Carbon::parse($startDate);
            // $endDate = date('Y-m-d', strtotime($post['endDate']));
            // $endDate = Carbon::parse($endDate);
            $rangeDate = $post['rangeDate'];
            $endDate = Carbon::now()->addDay();
            $nowDate = Carbon::now()->addDay();
            $startDate = $endDate->subDays($rangeDate );
            $id = $post['id'];
			$getVideo = $this->model_video->where('id', $id)->first();
            $this->parse['total_view']  = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $nowDate->toDateString().' 23:59:59'])->count();
            $this->parse['uniq_visitor']  = $this->model_shopeback->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $nowDate->toDateString().' 23:59:59'])->groupBy('order_id')->get()->count();
            $this->parse['avg']  = (int) $this->model_shopeback ->selectRaw('AVG(TIME_TO_SEC(duration)) as avg')->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $nowDate->toDateString().' 23:59:59'])->get()[0]['avg'];
			$this->parse['persent_view']  = $this->model_shopeback->where('status',1)->where('persentase','100')->where('video_id',$id)->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $nowDate->toDateString().' 23:59:59'])->get()->count();

            $start = new DateTime($startDate->toDateString());
            $end   = new DateTime($endDate->toDateString());

            $array = array('0','25','50','70','100');
            $category = array();
            $data = array();
			$strKetStartDate ='';
			$strKetEndDate ='';
			if($startDate->format('m y')==$nowDate->format('m y')){
				$strKetStartDate .=$startDate->format('d');
				$strKetEndDate .=$nowDate->format('d F');
			}else if($startDate->format('m y')!=$nowDate->format('m y')){
				$strKetStartDate .=$startDate->format('d F');
				$strKetEndDate .=$nowDate->format('d F');
			}

			if($startDate->format('y')==$nowDate->format('y')){
				$strKetEndDate .=', '.$nowDate->format('Y');
			}else if($startDate->format('y')!=$nowDate->format('y')){
				$strKetStartDate .= ', '.$startDate->format('Y');
				$strKetEndDate .=', '.$nowDate->format('Y');
			}
			$this->parse['ketDate'] = $strKetStartDate.' - '.$strKetEndDate;
            for ($i=0;$i<=4;$i++)
            {
                $category[$i] = $array[$i].'%';
				if($array[$i]<100){


					$data[]   = $this->model_shopeback->where(function($query) use ($array,$i)  {

								$startPersent = $array[$i];
								$akhirPersent = $array[$i+1] - 1;
								$query->whereRaw("persentase >=".$startPersent);
								$query->whereRaw("persentase <".$akhirPersent);

							})->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $nowDate->toDateString().' 23:59:59'])->where('status',1)->where('video_id',$id)->get()->count();
				} else{
					$data[]   = $this->model_shopeback->whereBetween('created_at', [ $startDate->toDateString().' 00:00:00', $nowDate->toDateString().' 23:59:59'])->where('status',1)->where('video_id',$id)->where('persentase',$array[$i])->get()->count();
				}


            }

            $this->parse['chartPersentase']['category'] =json_encode($category);
            $this->parse['chartPersentase']['data'] = json_encode($data);
            $this->parse['chartPersentase']['series'] = 'viwer';

            $city = Analytics::performQuery(
                Period::create($startDate, $nowDate),
                'ga:sessions',
                [
                     'metrics' => 'ga:pageviews',
                    'dimensions' => 'ga:city, ga:pageTitle',
                    'filters' => 'ga:pageTitle%3D~%5Evideo ads : '.$getVideo['title']
                ]
            );

            $gaCity= collect($city['rows'] ?? [])->map(function (array $dateRow) {
                return [
                    $dateRow[0],
                    (int) $dateRow[2],
                ];
            });
            $this->parse['chartGACity']['data'] = json_encode($gaCity);
            $this->parse['chartGACity']['series'] = 'viwer';


            $gender = Analytics::performQuery(
                Period::create($startDate, $endDate),
                'ga:sessions',
                [
                    'metrics' => 'ga:pageviews',
                    'dimensions' => 'ga:userGender,ga:pageTitle',
                    'filters' => 'ga:pageTitle%3D~%5Evideo ads : '.$getVideo['title']
                ]
            );
            $gaGender= collect($gender['rows'] ?? [])->map(function (array $dateRow) {
                return [
                    $dateRow[0],
                    (int) $dateRow[2],
                ];
            });
            $this->parse['chartGAGender']['data'] = json_encode($gaGender);
            $this->parse['chartGAGender']['series'] = 'viwer';


            $data = array();
            $date = array();
            for ($i=0;$i<= $rangeDate;$i++)
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();

        if ($post && $ajax) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $permitted_chars = str_shuffle($permitted_chars);
            $current = Carbon::now();
            $param['timeout'] = $current->addHours(2);
            $param['email'] = $post['email'];
            $param['video_id'] = $post['video_id'];
            $data = $this->model_shareurl->create($param);
            $data->link_id = $permitted_chars.$data->id;
            $data->save();

            //SENDING EMAIL @PEPIPOST
            //$curl = curl_init();
            //curl_setopt_array($curl, array(
            //CURLOPT_URL => "https://api.pepipost.com/v2/sendEmail",
            //CURLOPT_RETURNTRANSFER => true,
           // CURLOPT_ENCODING => "",
           // CURLOPT_MAXREDIRS => 10,
           // CURLOPT_TIMEOUT => 30,
           // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           // CURLOPT_CUSTOMREQUEST => "POST",
            //CURLOPT_POSTFIELDS => "{\"personalizations\":[{\"recipient\":\"".$param['email']."\"}],\"from\":{\"fromEmail\":\"admin@videoads.mfebriansyah.com\",\"fromName\":\"Admin Ceki\"},\"subject\":\"Hi gaes Lo dapet Link ni dari Shopback \",\"content\":\"Hi Gaes, Click Link ini dah ".$data->link_id." Buat Lanjutin Shopback Lo\"}",
           // CURLOPT_HTTPHEADER => array(
             // "api_key: 7121cb46e21d6e4b090e55767c745498",
             // "content-type: application/json"
           // ),
         // ));

          //$response = curl_exec($curl);
          //$err = curl_error($curl);
          //curl_close($curl);

             Mail::send('emails.sendurl', compact('data'), function($message)  use ($data) {
                 $message->to($data['email'])->subject
                    ('Link Dashboard Shoopy Back');
                 $message->from('testing@videoads.mfebriansyah.com','CEO Okedeht');
              });


            return response()->json([
                'message' => 'Success',
                'status'  => 'success',
                'data'    => $data
            ]);

        }

    }



     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shareUrl(Request $request)
    {
        $post = $request->post();
        $ajax = $request->ajax();
        if ($post && $ajax) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $permitted_chars = str_shuffle($permitted_chars);
            $current = Carbon::now();
            $param['timeout'] = $current->addHours(2);
            $data = $this->model_shareurl->create($param);
            $data->link_id = $permitted_chars+$data->id;
            $data->save();
            return response()->json([
                'message' => 'Success',
                'status'  => 'success',
                'data'    => $data,
            ]);
        }
        return redirect()->route($this->prefix_routes. 'index');

    }
}
