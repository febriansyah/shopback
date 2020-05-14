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
    public function index()
    {
        //
        $this->parse['video'] = $this->model_video->inRandomOrder()->first();

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
                } else if($calculate >= 50 && $calculate < 70){
                    $persentase = '50';
                } else if($calculate >= 70 && $calculate < 100){
                    $persentase = '70';
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
            $data = $this->model->where('video_id', $post['video_id'])->where('order_id', $post['shopbackid'])->count();
            if($data >= 2){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'anda sudah 2 kali menonton video nya'
                ]);
            }else{
                $param = array(
                            'video_id'         => $post['video_id'],
                            'order_id'         => $post['shopbackid'],
                            'patner_name'      => $post['patner'],
                            'patner_parameter' => $post['shopbackid2']
                );


                 $data = $this->model->create($param);
                 $data->uniq_id  =  'Shoopyback-'.$post['shopbackid'].'-'.$data->id;
                 $data->save();
                 $client = new Client();
                 $request = $client->get('http://shopback.go2cloud.org/aff_lsr?offer_id='.$data->uniq_id.'&aff_id='.$post['shopbackid'].'&adv_sub=ORDERID&security_token=a087b78e6787a59ee9c5424b396c4bc5');

                 return response()->json([
                    'id'    => $data->id,
                    'test' => $request,
                    'status' => 'success',
                    'message' => 'success'
                ]);
            }
       }

        return response()->json([
            'status' => 'failed',
            'message' => 'proses gagal'
        ]);


    }
}
