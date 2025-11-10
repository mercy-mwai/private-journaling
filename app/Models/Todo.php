<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use SoftDeletes;
    protected $table = 'todos';

    protected $fillable=[
        'user_id',
        'date',
        'text',
        'completed'
    ];

    protected  $cast=[
        'date'=> 'date',
        'completed'=> 'boolean'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
