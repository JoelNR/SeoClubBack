<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\InitiationDate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InitiationDateController extends Controller
{
    public function index(Request $request)
    {
        $initationDates = InitiationDate::orderBy('date','desc')->get();
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'initationDates' =>  $initationDates,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request, InitiationDate $initationDate)
    {
        $data = request()->validate([
            'telephone' => 'required',
            'user_id' => 'required'
        ]);

        $user = User::where('user_id','=',$data['user_id']);
        $user->telephone = $data['telephone'];
        $user->initationDate = $initationDate;
        $initationDate->user()->associate($user);

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'initationDate' => $initationDate,
                'user' => $user,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
