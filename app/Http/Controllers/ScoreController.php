<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;

class ScoreController extends Controller
{
    public function store(User $user, Request $request)
    {
        $data = request()->validate([
            'competition_id' => 'required',
        ]);

        $scoreData = $user->scores()->where('competition_id',$data['competition_id'])->first();

        if($scoreData == null){
            $scoreData = $user->scores()->create([
                'points'=> 0, 
                'competition_id' =>$data['competition_id']
            ]);
        } 

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'score' => $scoreData,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
