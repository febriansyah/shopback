<?php

namespace App\Listeners\Video;

use App\Events\VideoEvent;
use App\Models\Dashboard\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use FFMpeg;

class CutVideo
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

        $start = \FFMpeg\Coordinate\TimeCode::fromSeconds(1);

        $duration =  \FFMpeg\Coordinate\TimeCode::fromSeconds(5);

        $clipFilter = new \FFMpeg\Filters\Video\ClipFilter($start,$duration);

        FFMpeg::fromDisk('local')
            ->open('public/uploads/video//video/'.$video['video'])
            ->addFilter($clipFilter)
            ->export()
            ->toDisk('local')
            ->inFormat(new FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
            ->save('public/uploads/video//video/cut_'.$video['video_name'].'.mp4');
    }
}
