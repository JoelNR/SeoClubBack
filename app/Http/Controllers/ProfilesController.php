<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $profile = Profile::select('user_id','first_name', 'last_name', 'category')        
        ->where('user_id', $user->id)
        ->get();
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'profile' => $profile,
                'email' => $user->email,
                'telephone' => $user->telephone,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {

        $data = request()->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'category'=> '',
        ]);

        $profile = Profile::select('user_id','first_name', 'last_name', 'category')        
        ->where('user_id', $user->id)
        ->get();

        $profile->first_name = $data['first_name'];
        $profile->last_name = $data['last_name'];
        $profile->category = $data['category'];
        $profile->save();

        $data['email'] = request('email');
        $data['telephone'] = request('telephone');

        session()->user()->update(
            $data
        );

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'message' => $message,
            ],
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    // public function updatePassword(User $user, string $password)
    // {
    //     $user->password = Hash::make($password);
    //     $user->save();

    //     return response()->json([
    //         'success' => true,
    //     ]);
    // }

    // public function updateProfilePicture(User $user, \Illuminate\Http\UploadedFile $profilePhoto)
    // {
    //     $path = $profilePhoto->storePublicly('profile_photos');
    //     if (Str::startsWith($path, 'public/')) {
    //         $path = substr($path, 7);
    //     }

    //     $user->profile_photo_path = $path;
    //     $user->save();
    // }

    // public function updatePhone(User $user, string $phone, string $otp)
    // {
    //     if (SMSService::verifyOtpOnString($otp) && User::where('phone', '=', $phone)->count() == 0) {
    //         $user->phone = $phone;
    //         $user->save();

    //         return response()->json([
    //             'success' => true,
    //         ]);
    //     } else {
    //         if (User::where('phone', '=', $phone)->count() != 0) {
    //             return response()->json([
    //                 'success' => "Die angegebene Telefonnummer ist bereits vergeben",
    //             ]);
    //         }
    //     }
    // }

    // public function updateEmail(User $user, string $email, string $otp)
    // {
    //     if (SMSService::verifyOtpOnString($otp, true) && User::where('email', '=', $email)->count() == 0) {
    //         $user->email = $email;
    //         $user->save();

    //         return response()->json([
    //             'success' => true,
    //         ]);
    //     } elseif (User::where('email', '=', $email)->count() != 0) {
    //         return response()->json([
    //             'error' => "Die angegebene E-Mail ist bereits vergeben",
    //         ], 401);
    //     }

    //     return response()->json([
    //         'error' => 'Invalid OTP code',
    //     ], 401);
    // }
}
