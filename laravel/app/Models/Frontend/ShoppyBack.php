<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class ShoppyBack extends Model
{
    //
    protected $table ="shoope_back";

    protected $fillable = [
        'video_id','order_id', 'patner_name', 'patner_parameter',
        'duration','total_duration','persentase','uniq_id'
   ];

}
