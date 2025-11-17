<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlannerMetadata;
use App\Http\Requests\StorePlannerMetadataRequest;

class PlannerMetadataController extends Controller
{
    public function Show($date) 
    {
        $metadata= PlannerMetadata::where('user_id', auth()->id())
        ->where('date', $date)
        ->first();

        if(!$metadata){
            return response()->json([
                'date'=>$date,
                'main_focus'=>null,
                'goals'=>null,
                'mood'=>null
            ]);
        }
        return response()->json($metadata);
    }

    public function Store(StorePlannerMetadataRequest $request) 
    {
        $metadata= PlannerMetadata::updateOrCreate(
        [
            'user_id'=>auth()->id(),
            'date'=>$request->date
        ],
        [
            'main_focus'=>$request->main_focus,
            'goals'=>$request->goal,
            'mood'=>$request->mood
        ]
    );
    return response()->json([
        'message'=>'Planner Metadata  saved successfully',
        'data'=>$metadata
    ],201);
    }
}
