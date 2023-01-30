<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Competition;
use App\Models\User;
use App\Models\Arrow;
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

    public function getProfileCompetition(Profile $profile)
    {
        $competitionArray = array();
        $usersCompetition = DB::table('competition_user')->where('user_id',$profile->user_id)->paginate(6);
        foreach($usersCompetition as $competition){
            $place = 1;
            $competitionPosition = DB::table('competition_user')->where('competition_id',$competition->competition_id)->get();
            foreach ($competitionPosition as $positionCheck){
                if($positionCheck->category == $competition->category){
                    if ($positionCheck->distance == $competition->distance){
                        if($positionCheck->points > $competition->points){
                            $place++;
                        }
                    }
                }
            }

            array_push($competitionArray,[
                'competition' => Competition::find($competition->competition_id),
                'category' => $competition->category,
                'distance' => $competition->distance,
                'place' => $place,
                'points' => $competition->points]);
        }

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'competitions' => $competitionArray,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function getProfileStats(Profile $profile)
    {
        $numberOfPodiums = 0;
        $usersCompetition = DB::table('competition_user')->where('user_id',$profile->user_id)->get();
        foreach($usersCompetition as $competition){
            if ($competition->points != 0){
                $place = 1;
                $competitionPosition = DB::table('competition_user')->where('competition_id',$competition->competition_id)->get();
                foreach ($competitionPosition as $positionCheck){
                    if($positionCheck->category == $competition->category){
                        if ($positionCheck->distance == $competition->distance){
                            if($positionCheck->points > $competition->points){
                                $place++;
                            }
                        }
                    }
                }
                if ($place <= 3){
                    $numberOfPodiums++;
                }
            }
        }
        
        $arrows = Arrow::where('user_id',$profile->user_id)->get();
        $avarageArrow = 0;
        foreach ($arrows as $arrow){
            $avarageArrow += $arrow->points == 'X' ? 10 : ($arrow->points == 'M' ? 0 : $arrow->points);
        }

        $avarageArrow = count($arrows) != 0 ? $avarageArrow / count($arrows) : 0;

        $tens = Arrow::where('user_id',$profile->user_id)->where('points',10)->get();
        $nines = Arrow::where('user_id',$profile->user_id)->where('points',9)->get();
        $x = Arrow::where('user_id',$profile->user_id)->where('points','X')->get();

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'competitions' => count($usersCompetition),
                'tens' => count($tens),
                'nines' => count($nines),
                'x' => count($x),
                'avarage' => round($avarageArrow,2),
                'podiums' => $numberOfPodiums,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
