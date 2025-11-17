<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
   public function getByDay($date)
   {
    $todos= Todo::where('user_id', auth()->id())
    ->where('date', $date)
    ->orderBy('time')
    ->get();

    return response()->json([
        'todos'=>$todos
    ]);
   }
}
