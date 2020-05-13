<?php

namespace App\Listeners\Video;

use App\Events\VideoEvent;
use App\Models\Dashboard\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use FFMpeg;
class Risize
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
        FFMpeg::fromDisk('local')
            ->open('public/uploads/video//video/cut_'.$video['video_name'].'.mp4')
            ->addFilter(function ($filters) {
                $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            })
            ->export()
            ->toDisk('local')
            ->inFormat(new FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
            ->save('public/uploads/video//video/640_'.$video['video_name'].'.mp4');

        FFMpeg::fromDisk('local')
            ->open('public/uploads/video//video/cut_'.$video['video_name'].'.mp4')
            ->addFilter(function ($filters) {
                $filters->resize(new \FFMpeg\Coordinate\Dimension(1280, 960));
            })
            ->export()
            ->toDisk('local')
            ->inFormat(new FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
            ->save('public/uploads/video//video/1280_'.$video['video_name'].'.mp4');
    }
}
