<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\InitiationDate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class InitiationDateController extends Controller
{
    public function index(Request $request)
    {
        $data = request()->validate([
            'user_id' => 'required',
        ]);
        $userDate = DB::table('initiation_date_user')->where('user_id',$data['user_id'])->first();
        $initiationDates = InitiationDate::orderBy('date','asc')->get();
        $message = 'All right';
        if ($userDate != null){
            $userDate = InitiationDate::find($userDate->initiation_date_id);
        }

        $response = [
            'data' => [
                'success' => true,
                'userDate' => $userDate,
                'initiationDates' =>  $initiationDates,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function show(InitiationDate $initiation_dates, Request $request)
    {
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'initiationDates' => $initiation_dates,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function update(InitiationDate $initiation_dates, Request $request)
    {
        $data = request()->validate([
            'user_id' => 'required',
            'attendees' => ''
        ]);

        $user = User::find($data['user_id']);
        $initiation_dates->users()->attach($user);
        if($data['attendees'] != null){
            $initiation_dates->capacity -= $data['attendees'];
        }

        $initiation_dates->capacity--;
        $initiation_dates->update();

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'initiationDates' => $initiation_dates,
                'user' => $user,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
