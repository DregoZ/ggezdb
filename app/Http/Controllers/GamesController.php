<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\GameVideo;
use MarcReichel\IGDBLaravel\Models\Platform;
use MarcReichel\IGDBLaravel\Models\Screenshot;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;


class GamesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(String $slug)
    {

         /* si la búsqueda especificada existe en la cache, devuelve esa búsqueda... */
        Cache::forget('gamepage' . $slug);
         if (Cache::has('gamepage' . $slug)) {
            $gamepage_cache = Cache::get('gamepage' . $slug);
            $cached = '+';
            return Inertia::render('Querys/Games', [
                'gameweb'=> $gamepage_cache[0],
                'portada' => $gamepage_cache[1],
                'plataformas' => $gamepage_cache[2],
                'screenshots' => $gamepage_cache[3],
                'videos' => $gamepage_cache[4],
                'cached' => $cached
            ]);
          //  return 'cache: '.$gamepage_cache;
        } else {
            // recupera datos a partir del slug  
            $cached = '-';
            //juegos
            $gameweb = Game::where('slug', $slug)->first();
            //portadas
            $gameweb_cover = Game::select('cover')->where('slug', $slug)->first();
            $gameweb_cover == null ? $portada = null : $portada = Cover::where('id', $gameweb_cover->cover)->first();
            //plataformas
            $gameweb_plataformas = Game::select('platforms')->where('slug', $slug)->get();
            $gameweb_plataformas[0]->platforms == null ? $plataformas = null : $plataformas = Platform::whereIn('id', $gameweb_plataformas[0]->platforms)->get();
            // screenshots
            $gameweb_screenshots = Game::select('screenshots')->where('slug', $slug)->get();
            $gameweb_screenshots[0]->screenshots == null ? $screenshots = null : $screenshots = Screenshot::whereIn('id', $gameweb_screenshots[0]->screenshots)->get();
            //videos
            $gameweb_videos = Game::select('videos')->where('slug', $slug)->get();
            $gameweb_videos[0]->videos == null ? $videos = null : $videos = GameVideo::whereIn('id', $gameweb_videos[0]->videos)->get();
            
            // almacena en la cache la búsqueda y muestra el resultado del query
            Cache::put('gamepage'.$slug, [$gameweb, $portada, $plataformas, $screenshots, $videos]);
            return Inertia::render('Querys/Games', [
                'gameweb' => $gameweb, 
                'portada'=> $portada, 
                'plataformas' => $plataformas, 
                'screenshots' => $screenshots, 
                'videos' => $videos,
                'cached' => $cached
            ]);
            
        }
    }
}
