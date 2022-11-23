<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

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

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'competitions' => $competition,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
