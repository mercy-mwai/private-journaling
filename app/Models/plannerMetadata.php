<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlannerMetadata extends Model
{
    protected $table = 'planner_metadata';
    protected $fillable=[
        'user_id',
        'date',
        'main_focus',
        'goals',
        'mood',

    ];
    protected $cast= [
        'date'=>'date'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
