<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;
date_default_timezone_set('UTC');

class TrainingController extends Controller
{
    public function store(User $user){
        $data = request()->validate([
            'modality' => 'required',
            'category' => 'required',
            'distance' => 'required',
            'title' => 'required',
        ]);

        $training = $user->trainings()->create([
            'modality' => $data['modality'],
            'category' => $data['category'],
            'distance' => $data['distance'],
            'title' => $data['title'],
            'date' => date("m/d/y")
        ]);            

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'training' => $training,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function index(User $user){

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'training' => $user->trainings()->orderBy('date','desc')->get(),
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function destroy(Training $training){

        $training->delete();
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
