<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class ShareUrl extends Model
{
    //
    protected $table ="share_url";

    protected $fillable = [
        'email','link_id','timeout','created_at','video_id'
   ];
}
