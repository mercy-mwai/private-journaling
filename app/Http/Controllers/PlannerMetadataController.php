<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlannerMetadata;

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
                'goal'=>null,
                'activity'=>null
            ]);
        }
        return response()->json($metadata);
    }

    public function Store()
    {
        $metadata= PlannerMetadata::create(
        [
            'user_id'=>auth()->id(),
            'date'=>$date
        ],
        [
            'main_focus'=>$request->main_focus,
            'goal'=>$request->goal,
            'activity'=>$request->activity
        ]
    );
    return response()->json([
        'message'=>'Planner Metadata  saved successfully',
        'data'=>$metadata
    ],201);
    }
}
