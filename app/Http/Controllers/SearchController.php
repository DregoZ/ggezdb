<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Platform;

use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __invoke(Request $request)
    {
        /* query Builders si no usamos el wrapper */
        // $igdb = new IGDB('games');
        // $platforms = new IGDB('platforms');

        // $search_field = request('search'); // busca lo introducido en el form, transformado en slug
        $search_field = $request['busqueda'];
        $request = slugify($search_field);

        /**
         * TODO redirect a página TRENDING GAMES
         */
        try {
            if (trim($request) == null or trim($request) == "") {
                throw new Exception('No query data');
            }
        } catch (Exception $e) {
            $errors = $e->getMessage();
            //   return view('querys.queryErrors', compact('errors'));
        }

        //  Cache::flush();
        // /* si la búsqueda especificada existe en la cache, devuelve esa búsqueda... */
        if (Cache::has($request)) {
            $games_cache = Cache::get($request);
            $cached = '+';
            // return view('querys.queryResult', $games_cache)->with('search_field', $search_field)->with('cached', $cached);
            return Inertia::render('Querys/Search', [
                'games' => $games_cache[0],
                'portadas'=> $games_cache[1],
                'plataformas' => $games_cache[2],
                'search_field' => $search_field,
                'cached' => $cached
            ]);
           
             //return compact('games_cache');
             // return $games_cache[0];
        } else {
            $cached = '- ';
        /**
         * query a Games según el formulario de búsqueda, ordenándolos por rating (máximo 50, modificable)
         * TODO mostrar resultados variables por página
         */
            $games = Game::orderBy('rating', 'desc')->where('rating', '!=', null)->where('slug', 'like', '%' . $request . '%')->limit(50)->get();
            //   $games == null ? view('trendingGames') : 'Buscando en la base de datos...';

            /**
             * almacena en arrays los elementos que a los que haremos query en otras tablas (Platform y Covers)
             */
            $game_covers_arr = array();
            $game_platforms_arr = array();

            if ($games != null) {
                foreach ($games as $game) {
                    $slug_code = $game->slug;

                    //portadas
                    $game_cover = Game::select('cover')->where('slug', $slug_code)->first();
                    if ($game_cover != null && $game_cover->cover != null) array_push($game_covers_arr, $game_cover->cover);

                    //plataformas
                    $game_plataformas = Game::select('platforms')->where('slug', $slug_code)->get();
                    if ($game_plataformas != null) {
                        foreach ($game_plataformas as $plataforma) {
                            if ($plataforma->platforms != null) {
                                foreach ($plataforma->platforms as $plataforma_ind) {
                                    in_array($plataforma_ind, $game_platforms_arr) ? 'Plataforma ya existente' : array_push($game_platforms_arr, $plataforma_ind);
                                }
                            }
                        }
                    }
                }

                $game_covers_arr == null ? $portadas = null : $portadas = Cover::whereIn('id', $game_covers_arr)->limit(50)->get();
                $game_platforms_arr == null ? $plataformas = null : $plataformas = Platform::whereIn('id', $game_platforms_arr)->limit(170)->get();

                // almacena en la cache la búsqueda y muestra el resultado del query
                Cache::put($request, [$games, $portadas, $plataformas]);

                return Inertia::render('Querys/Search', [
                    'games' => $games,
                    'portadas' => $portadas,
                    'plataformas' => $plataformas,
                    'search_field' => $search_field,
                    'cached' => $cached
                ]);
            }
        }
    }
}
