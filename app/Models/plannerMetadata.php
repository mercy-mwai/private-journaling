<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class plannerMetadata extends Model
{
    protected $fillable=[
        'user_id',
        'planner_metadata_id',
        'date',
        'main_focus',
        'goals',
        'mood',

    ];
}
