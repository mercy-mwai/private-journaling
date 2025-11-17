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
   public function Store(StoreTodoRequest $request)
   {
    $todos=Todo::create([
        'date'=>$request->date,
        'text'=>$request->text,
        'completed'=>$request->completed
    ]);

    return response()->json([
        'message'=>'Todos added Successfully',
        'data'=>$todos
    ]);
   }
}
