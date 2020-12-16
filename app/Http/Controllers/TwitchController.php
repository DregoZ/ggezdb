<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Cache;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use MarcReichel\IGDBLaravel\Models\Game;

class TwitchController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
         {
       // Cache::forget('example');
        if (Cache::has('example')) {
            $cached = 'YUP';
            $game_example = Cache::get('example');
            return Inertia::render('Querys/Twitch', [
                'game_cache' => $game_example,
                'cached' => $cached

            ]);
            
            //return $game_example;
        } else {
            $cached = 'NOPE';
            $date = strtotime("2015-01-01") * 1000;
            $game_example = Game::orderBy('rating', 'desc')->where('rating', '!=', null)->where('first_release_date', '>=', $date)->limit(50)->get();

            Cache::put('example', $game_example);


            return Inertia::render('Querys/Twitch', [
                'game_example' => $game_example,
                'cached' => $cached

            ]);
        }
    }

//     public function store(Request $request)
//     {
//         // todo get auth token
    
//         $channelsApi = 'https://api.twitch.tv/helix/games/top';
//         $clientId = '9ykyznssb1ba4y7mqz8dw6y2u2ztrw';
//         $token = 'Bearer 7sr4rhagcr1pj1zam2qi3m4p3qnbx6';
//         $ch = curl_init();
 
//    curl_setopt_array($ch, array(
//       CURLOPT_HTTPHEADER => array(
//       'Client-ID: ' . $clientId,
//       'Authorization: ' . $token
//       ),
//       CURLOPT_RETURNTRANSFER=> true,
//       CURLOPT_URL => $channelsApi 
//    ));
 
//    $response = curl_exec($ch);
//    curl_close($ch);
   
   
//    return Inertia::render('Querys/Trending', [
//         'response' => $response 
//    ]);
//    } 


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
