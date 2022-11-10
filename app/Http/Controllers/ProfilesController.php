<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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

        $profile = Profile::select('user_id','first_name', 'last_name', 'category', 'image')        
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

    public function updatePhoto(Request $request, User $user){
        $data = request()->validate([
            'image' => 'image'
        ]);

        // $imagePath = request('image')->store('uploads','public');

        // $image = Image::make(public_path("http://127.0.0.1:8000/storage/{$imagePath}"))->fit(450,450);
        // $image->save();  

        $imagePath = $request->file('image')->hashName();
        Storage::disk('public')->put($imagePath, file_get_contents($request->file('image')));
        $profile = $user->profile;
        $profile->image = 'http://127.0.0.1:8000/storage/' . $imagePath;
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
    public function update(User $user)
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
