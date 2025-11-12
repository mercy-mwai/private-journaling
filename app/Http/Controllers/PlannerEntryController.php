<?php

namespace App\Http\Controllers;

use App\Models\PlannerEntry;
use Illuminate\Http\Request;
use App\Models\PlannerMetadata;
use App\Http\Requests\StorePlannerEntryRequest;

class PlannerEntryController extends Controller
{
    public function getByWeek($startDate) :JsonResponse
    {
       $entries= PlannerEntry:: where('user_id', auth()->id())
        ->where('date', '>=', $startDate)
        ->where('date', '<', date('Y-m-d',strtotime($startDate. '+7 days')))
        ->orderBy('date')
        ->orderBy('time')
        ->get();


         return response()->json([
        'entries'=>$entries
    ]);
    }
    public function getByDay($date) :JsonResponse
    {
        $entries =PlannerEntry::where('user_id',auth()->id())
        ->where('date', $date)
        ->orderBy('time')
        ->get();

        return response()->json([
            'entries'=>$entries
        ]);
    }

    public function Store(StorePlannerEntryRequest $request) :JsonResponse
    {
        $entries= PlannerEntry::create([
            'user_id'=>auth()->id(),
            'date'=>$request->date,
            'time'=>$request->time,
            'activity'=>$request->activity,
            'day_of_week'=>$request->day_of_week
        ]);
        return response()->json([
            'message'=> 'Activty added successfully',
            'data'=>$entries
        ]);
    }
    public function Update(StorePlannerEntryRequest $request, $id):JsonResponse
    {
        $entry =PlannerEntry::where('user_id', auth()->id())
        ->findOrFail($id);

        $updateEntry=update([
            'time'=>$request->time,
            'activity'=>$request->activity,
            'day_of_week'=>$request->day_of_week
        ]);

        return response()->json([
            'message'=> 'Activity updated Successfully',
            'data'=>$updateEntry
        ]);
    }
  public function Destroy($id):JsonResponse
  {
    $entry= PlannerEntry::where('user_id', auth()->id())
    ->findOrFail($id);
   $entry->delete();

   return response()->json([
    'message'=> 'Activity Deleted Successfully',

   ]);
  }
    
}
