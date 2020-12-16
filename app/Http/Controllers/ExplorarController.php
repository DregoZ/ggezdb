<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ExplorarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        //return ['topgames' => $topgames->data];
        // return Inertia::render('Explorar', [
            //     'hola' => $hola
            // ]);
            
        $topgames = getTopGames();

        // return inertia('Explorar', [
        //     'topgames' => $topgames->data
        // ]);
            
        return $topgames->data;
    }
}
