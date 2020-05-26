<?php

namespace App\Listeners\Video;

use App\Events\VideoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Dashboard\Video;
use Illuminate\Support\Facades\Storage;
use FFMpeg;

class UpdateStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Video  $event
     * @return void
     */
    public function handle(VideoEvent $event)
    {
        //
        $video = $event->video;
        $getVideo = Video::where('id',$video['id'])->first();
        if($getVideo['title']==''){
            $getVideo['status'] ='0';
        }else{
                $getVideo['status'] ='1';
        }
        $getVideo->save();
    }
}
