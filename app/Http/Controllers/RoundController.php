<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Round;

class RoundController extends Controller
{
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
