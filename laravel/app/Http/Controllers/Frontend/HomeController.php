<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Frontend\ShoppyBack;
use App\Models\Frontend\Video;

class HomeController extends Controller
{
    //
      /**
     * Set globally for this controller.
     *
     * @var array
     */
    protected $parse = [];
      /**
     * Class constructor.
     *
     */
    public function __construct()
    {
        $this->model     = new ShoppyBack;
        $this->model_video     = new Video;

    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->parse['video'] = $this->model_video->where(function($query) {

            $query->whereRaw("target_days = '0'");
            $query->orwhereRaw("target_days >= (select count(*) as total from shoope_back where video_id = videos.id and DATE(created_at) = CURDATE() )  ");

        })->whereDate('start_publish','<=',date('Y-m-d'))->whereDate('end_publish','>=',date('Y-m-d'))->inRandomOrder()->first();
        $post = $request->all();
        $this->parse['pageview'] = '0';
        if (isset($post['shopbackid']) && isset($post['shopbackid2']) && isset($post['partner'])) {
            $param = array(
                        'video_id'         => $this->parse['video']['id'],
                        'order_id'         => $post['shopbackid'],
                        'patner_name'      => $post['partner'],
                        'patner_parameter' => $post['shopbackid2'],
                        'status' => '0'
            );

            $data = $this->model->create($param);
            $this->parse['pageview'] = $data['id'];
        }

        // $data->uniq_id  =  'Shoopyback-'.$post['shopbackid'].'-'.$data->id;
        // $data->save();

        return view('frontend.home', $this->parse);
    }
    public function test()
    {
        //
        echo'<a href="http://projectvideo.zef/index5.html?shopbackid=~~SBID~~&shopbackid2=5678&partner=shopback" target="_blank">open</a>';die;
    }
    public function saveData(Request $request){
        if ($request->isMethod('post') && $request->ajax()) {
           $post = $request->all();
           $data = $this->model->where('video_id', $post['video_id'])->where('order_id', $post['shopbackid'])->where('id', $post['id'])->first();
            if($data){
                $calculate = $post['duration' ]/ $post['total_duration'];
                $calculate = $calculate*100;
                $calculate = floor($calculate/10);
                $calculate = $calculate *10;
                if($calculate >= 0 && $calculate < 50){
                    $persentase = '20';
                } else if($calculate >= 50 && $calculate < 75){
                    $persentase = '50';
                } else if($calculate >= 75 && $calculate < 100){
                    $persentase = '75';
                }else{
                    $persentase = '100';
                }
                $param = array(
                    'duration' => $post['duration'],
                    'total_duration' => $post['total_duration'],
                    'persentase' => $persentase,
                );

                $data->fill($param)->save();
            }

            if($data){
                return response()->json([
                    'status' => 'success',
                    'message' => 'data behasil dimasukkan'
                ]);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'proses gagal'
                ]);
            }

        }
    }
    public function checkData(Request $request){
       if ($request->isMethod('post') && $request->ajax()) {
            $post = $request->all();
            $data = $this->model->where('status', '1')->whereDate('created_at',date('Y-m-d'))->where('order_id', $post['shopbackid'])->get()->count();
            // dd($data);
            if($data >= 2){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'quota Anda untuk menonton video hari ini sudah habis'
                ]);
            }else{
                $checkData = $this->model->where('id', $post['pageview'])->first();
                if ($checkData) {
                    $checkData->uniq_id  = 'Shoopyback-'.$post['shopbackid'].'-'.$checkData->id;
                    $checkData->status = '1';
                    $checkData->save();


                    $client = new Client();
                    $request = $client->get('http://shopback.go2cloud.org/aff_lsr?offer_id=2929&aff_id=1069&aff_sub='.$post['shopbackid'].'&adv_sub='.$checkData->uniq_id.'&security_token=a087b78e6787a59ee9c5424b396c4bc5');
                    return response()->json([
                        'id'    => $checkData->id,
                        'test' => $request,
                        'status' => 'success',
                        'message' => 'success'
                    ]);
                }


            }
       }

        return response()->json([
            'status' => 'failed',
            'message' => 'proses gagal'
        ]);


    }
}
