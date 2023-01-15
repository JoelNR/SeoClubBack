<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Set;
use App\Models\Round;
use App\Models\Competition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SetController extends Controller
{
    public function index(Request $request)
    {
        $data = request()->validate([
            'user_id' => 'required',
        ]);
        
        $userSets = DB::table('sets')->where('user_id',$data['user_id'])->get();
        $message = 'All right';

        $response = [
            'data' => [
                'success' => true,
                'userSets' => $userSets,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function show(Set $set, Request $request)
    {
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'set' => $set,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function update(Set $set, Request $request)
    {
        $data = request()->validate([
            'arrows' => 'required',
            'points' => 'required',
            'user_id' => 'required',
        ]);
        $round = $set->round()->first();
        $score = $round->score()->first();

        $round->points -= $set->points;
        $score->points -= $set->points;

        $set->points = $data['points'];
        $arrows = $set->arrows()->delete();

        foreach($data['arrows'] as $arrow){
            $set->arrows()->create([
                'points'=> $arrow,
                'user_id' => $data['user_id'],
                'set_id' => $set->id
            ]);
        }

        $set->update();

        $round->points += $data['points'];
        $round->update();
        

        $score->points += $data['points'];
        $score->update();

        $competition = $score->competition()->first();

        $relation = DB::table('competition_user')->where('competition_id',$competition->id)->where('user_id', $data['user_id'])->update(['points' => $score->points ]);

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'set' => $set,
                'arrows' => $set->arrows()->get(),
                'round' => $round,
                'score' => $score,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function store(User $user, Request $request)
    {
        $data = request()->validate([
            'arrows' => 'required',
            'points' => 'required',
            'round_id' => 'required',
        ]);

        $set = $user->sets()->create([
            'points'=> $data['points'], 
            'round_id' =>$data['round_id'],
        ]);

        foreach($data['arrows'] as $arrow){
            $set->arrows()->create([
                'points'=> $arrow,
                'user_id' => $user->id,
                'set_id' => $set->id
            ]);
        }

        $round = $set->round()->first();
        $round->points = $round->points + $data['points'];
        $round->update();
        
        $score = $round->score()->first();
        $score->points = $score->points + $data['points'];
        $score->update();

        $competition = $score->competition()->first();

        $relation = DB::table('competition_user')->where('competition_id',$competition->id)->where('user_id', $user->id)->update(['points' => $score->points ]);

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'set' => $set,
                'arrows' => $set->arrows()->get(),
                'round' => $round,
                'score' => $score,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
