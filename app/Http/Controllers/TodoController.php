<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;

class TodoController extends Controller
{
   public function getByDay($date)
   {
    $todo= Todo::where('user_id', auth()->id())
    ->where('date', $date)
    ->orderBy('created_at')
    ->get();

    return response()->json([
        'todos'=>$todo
    ],200);
   }
   public function Store(StoreTodoRequest $request)
   {
    $todos=Todo::create([
        'user_id'=>auth()->id(),
        'date'=>$request->date,
        'text'=>$request->text,
        'completed'=>$request->completed ?? false
    ]);

    return response()->json([
        'message'=>'Todos added Successfully',
        'data'=>$todos
    ],201);
   }
   public function Toggle($id)
   {
    $todo=Todo::where('user_id', auth()->id())
    ->findOrFail($id);
    $todo=update([
        'completed'=>!$todo->completed
    ]);
    return response()->json([
        'message'=> 'Todo updated successfully',
        'data'=>$todo
    ],200);
   }

   public function Update(StoreTodoRequest $request ,$id)
   {
    $todo=Todo::where('user_id', auth()->id())
    ->findOrFail($id);
    $todo=Update([
        'text'=>$request->text,
        'completed'=>$request->completed ?? $todo->completed
    ]);
    
    return response()->json([
        'message'=> 'Todos Updated Successfully',
        'data'=>$todo
    ],200);
   }

   public function Destroy(StoreTodoRequest $request, $id)
   {
    $todo=Todo::where('user_id', auth()->id())
    ->findOrFail($id);
    $todo->delete();

    return response()->json([
        'message'=>'Todo deleted successfully',
    ],200);
   }

}
