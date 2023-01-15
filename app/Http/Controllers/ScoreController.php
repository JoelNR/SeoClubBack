<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;
use App\Models\Round;

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

            $user->rounds()->create([
                'points'=> 0, 
                'score_id' => $scoreData->id]);
            $user->rounds()->create([
                'points'=> 0, 
                'score_id' => $scoreData->id]);
        }

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'score' => $scoreData,
                'rounds' => $scoreData->rounds()->get(),
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function update(Score $score, Request $request)
    {

        $data = request()->validate([
            'points' => 'required',
        ]);
        $score->points = $data['points'];
        $score->update();

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'score' => $score,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
