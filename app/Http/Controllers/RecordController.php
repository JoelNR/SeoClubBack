<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use App\Models\Profile;
use App\Models\Competition;
use Illuminate\Http\Request;

class RecordController extends Controller
{

    public function profileRecords(Request $request, User $user)
    {
        $records = Record::where('user_id', $user->id)
        ->get();

        $recordsArray = array();

        foreach($records as $record){
            array_push($recordsArray,[
                'competition' => $record->competition()->first(),
                'record' => $record]);
        }

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'records' => $recordsArray,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    
    public function clubRecords(Request $request)
    {
        $categories = array (
            "Olímpico",
            "Poleas",
            "Desnudo",
            "Tradicional",
            "Longbow"
        );
        $distances = array (
            "Olímpico" => array(70,60,50,40,30,18,14),
            "Poleas" => array(50,40,30,18,14),
            "Desnudo" => array(50,40,30,18,14),
            "Tradicional" => array(30,18,14),
            "Longbow" => array(30,18,14)
        );

        $indoorRecordsArray = array();
        $outdoorRecordsArray = array();

        foreach($categories as $category){
            foreach ($distances[$category] as $distance){
                if($distance <= 18){
                    $indoorRecords = Record::where('category', $category)->where('distance', $distance)->where('modality', 'Sala')->get();
                    
                    if(count($indoorRecords) > 0){
                        $currentIndoorRecord = $indoorRecords[0];   
                        foreach($indoorRecords as $record){
                            if($record->points > $currentIndoorRecord->points){
                                $currentIndoorRecord = $record;
                            } 
                        }
                        $user = $currentIndoorRecord->user()->first();
                        array_push($indoorRecordsArray,[
                        'profile' => $user->profile()->first(),
                        'competition' => $currentIndoorRecord->competition()->first(),
                        'record' => $currentIndoorRecord]); 
                    }     
                }
                
                $outdoorRecords = Record::where('category', $category)->where('distance', $distance)->where('modality', 'Aire libre')->get();

                if(count($outdoorRecords) > 0){
                    $currentOutdoorRecord = $outdoorRecords->first();   
                    foreach($outdoorRecords as $record){
                        if($record->points > $currentOutdoorRecord->points){
                            $currentOutdoorRecord = $record;
                        } 
                    }
                    $user = $currentOutdoorRecord->user()->first();
                    array_push($outdoorRecordsArray,[
                    'profile' => $user->profile()->first(),
                    'competition' => $currentOutdoorRecord->competition()->first(),
                    'record' => $currentOutdoorRecord]); 
                }    
            }
        }

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'indoor_records' => $indoorRecordsArray,
                'outdoor_records' => $outdoorRecordsArray,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

}
