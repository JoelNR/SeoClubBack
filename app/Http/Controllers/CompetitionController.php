<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $competitions = Competition::orderBy('date','desc')->get();
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'competitions' =>  $competitions,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function show(Competition $competition)
    {
        $usersArray = array();
        $usersCompetition = DB::table('competition_user')->where('competition_id',$competition->id)->get();
        foreach($usersCompetition as $user){
            array_push($usersArray,[
                'archer' => User::find($user->user_id),
                'category' => $user->category]);
        }

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'competitions' => $competition,
                'usersArray' => $usersArray,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function update(Competition $competition, Request $request)
    {
        $data = request()->validate([
            'user_id' => 'required',
            'category' => 'required'
        ]);

        $user = User::find($data['user_id']);
        $competition->users()->attach($user, ['category' => $data['category']]);

        $competition->update();

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
