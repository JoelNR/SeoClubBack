<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Set;

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

        $set->points = $data['points'];
        $arrows = $set->arrows()->get();
        
        for ($i = 0; $i < count($arrows); ++$i) {
            $arrows[$i] = $data['arrows'][$i];
            $arrows[$i]->update();
         }

        // foreach($arrows as $arrow){
        //     $arrow->delete();
        // }

        // foreach($data['arrows'] as $arrow){
        //     $set->arrows()->create([
        //         'points'=> $arrow,
        //         'user_id' => $data['user_id']
        //     ]);
        // }

        $set->update();

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

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'set' => $set,
                'arrows' => $set->arrows()->get(),
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
