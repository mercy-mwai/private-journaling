<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlannerMetadata;

class PlannerEntryController extends Controller
{
    public function store(Request $request){
        $validatedEntries= $request->validate([
            'main_focus'=> 'string|max:255|required',
            'goals'=> 'string|nullable',
            'mood'=> 'string|nullable|max:100',

        ]);
        $metadata = PlannerMetadata::create($validatedEntries);
        
    }
    
}
