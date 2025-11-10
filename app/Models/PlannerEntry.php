<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlannerEntry extends Model
{
    use SoftDeletes;
    protected $table= 'planner_entries';

    protected $fillable=[
        'user_id',
        'date',
        'time',
        'activity',
        'day_of_week'
    ];

    protected $cast =[
        'date'=> 'date',
        'time'=> 'datetime:H:i'

    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
