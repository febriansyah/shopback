<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class LogDashboard extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action', 'description', 'path','ip_addres'
    ];
}
