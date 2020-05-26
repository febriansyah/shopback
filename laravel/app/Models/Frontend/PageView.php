<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    //
    protected $table ="page_view";

    protected $fillable = [
        'video_id','order_id', 'patner_name', 'patner_parameter',
        'duration','total_duration','persentase','uniq_id'
   ];
}
