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
           $param = array(
                    'video_id'         => $post['video_id'],
                    'order_id'         => $post['shopbackid'],
                    'patner_name'      => $post['patner'],
                    'patner_parameter' => $post['shopbackid2'],
                    'duration' => $post['duration'],
           );

            //    $checkUser = $htis->model->where('order_id',$post['shopbackid'])->first();
            //    if($checkUser){

            //    }
            $data = $this->model->create($param);
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
    public function checkData(Request $request,$id){
       if($id !=''){
            $data = $this->model->where('order_id',$id)->count();
            if($data >= 2){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'anda sudah 2 kali menonton video nya'
                ]);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'data behasil dicek'
                ]);
            }
       }

        return response()->json([
            'status' => 'failed',
            'message' => 'proses gagal'
        ]);


    }
}
