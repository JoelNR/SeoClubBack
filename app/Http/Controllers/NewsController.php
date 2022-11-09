<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::all();
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'news' => $news,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    public function show(News $news)
    {

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'news' => $news,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }
}
