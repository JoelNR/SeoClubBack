<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $profiles = DB::table('profiles')->where('is_member', 'true')->get();
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'profiles' => $profiles,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
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
    public function show(User $user): JsonResponse
    {

        $profile = Profile::select('user_id','first_name', 'last_name', 'category', 'image')        
        ->where('user_id', $user->id)
        ->first();
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

    public function updatePhoto(Request $request, User $user): JsonResponse{
        $data = request()->validate([
            'image' => 'image'
        ]);

        
        $imagePath = $request->file('image')->hashName();
        Storage::disk('public')->put($imagePath, file_get_contents($request->file('image')));
        $profile = $user->profile;
        $profile->image = env('APP_URL') . '/storage/' . $imagePath;
        $profile->save();

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'image' => $profile->image,
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
    public function update(User $user): JsonResponse
    {

        $data = request()->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'category'=> '',
        ]);

        $profile = $user->profile;

        $profile->first_name = $data['first_name'];
        $profile->last_name = $data['last_name'];
        $profile->category = $data['category'];

        $profile->save();

        $data['email'] = request('email');
        $data['telephone'] = request('telephone');

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->telephone = $data['telephone'];
        $user->save();

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
}
