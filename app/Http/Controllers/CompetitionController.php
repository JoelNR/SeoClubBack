<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\User;
use App\Models\Profile;
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
                'archer' => Profile::find($user->user_id),
                'category' => $user->category,
                'distance' => $user->distance,
                'target_number' => $user->target_number,
                'target_letter' => $user->target_letter]);
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
            'category' => 'required',
            'distance' => 'required'
        ]);

        $user = User::find($data['user_id']);
        $competition->users()->attach($user, ['category' => $data['category'], 'distance' => $data['distance']]);

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

    public function targetArchers(Competition $competition, Request $request)
    {
        $data = request()->validate([
            'user_id' => 'required',
        ]);

        $usersArray = array();
        $user = User::find($data['user_id']);
        $userTarget = DB::table('competition_user')->where('competition_id',$competition->id)->where('user_id',$data['user_id'])->first();
        $archers = DB::table('competition_user')->where('competition_id',$competition->id)->where('target_number',$userTarget->target_number)->get(); 

        foreach($archers as $archer){
            array_push($usersArray,[
                'archer' => Profile::find($archer->user_id),
                'category' => $archer->category,
                'distance' => $archer->distance,
                'target_number' => $archer->target_number,
                'target_letter' => $archer->target_letter]);
        }
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'competitions' => $competition,
                'archers' => $usersArray,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
