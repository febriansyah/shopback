<?php

namespace App\Models\Dashboard;

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
