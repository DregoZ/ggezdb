<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use MarcReichel\IGDBLaravel\Models\Game;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $topgames = getTopGames();
                
        //return ['topgames' => $topgames->data];
        // return Inertia::render('Home', [
        //     'hola' => $hola
        // ]);
       


        return view('welcome', [
            'topgames' => $topgames->data
            
        ]);

        

        

    }
}