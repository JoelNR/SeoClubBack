<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Round;

class RoundController extends Controller
{

    public function showSet(Round $round, Request $request)
    {

        $sets = $round->sets()->get();
        $arrowsArray = array();
        
        foreach($sets as $set){
            $arrowPoints = array();
            $setArrows = $set->arrows()->get();
            foreach($setArrows as $arrow){
                array_push($arrowPoints, $arrow->points);
            }
            array_push($arrowsArray,['set' => $set,
            'arrows' => $arrowPoints]);
        }


        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'sets' => $arrowsArray,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }


    public function store(User $user, Request $request)
    {
        $data = request()->validate([
            'score_id' => 'required',
        ]);

        $roundsData = $user->rounds()->where('score_id',$data['score_id'])->get();

        if(count($roundsData) < 2){
            $roundsData = $user->rounds()->create([
                'points'=> 0, 
                'score_id' => $data['score_id'],
                'points'=> 0, 
                'score_id' => $data['score_id']
            ]);
        } 

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'rounds' => $roundsData,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
