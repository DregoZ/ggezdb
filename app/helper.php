<?php

use Illuminate\Support\Facades\Cache;

/* sets link como active si nos encontramos en la ruta a donde apunta */
function setLinkActivo($nombreRuta) 
{
    return request()->routeIs($nombreRuta) ? 'active' : '';
}

/* transforma cadenas a modo slug */
function slugify($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}

function getTopGames() {
    $channelsApi = 'https://api.twitch.tv/helix/games/top';
    $clientId = '9ykyznssb1ba4y7mqz8dw6y2u2ztrw';
    $token = 'Bearer 7sr4rhagcr1pj1zam2qi3m4p3qnbx6';
    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_HTTPHEADER => array(
            'Client-ID: ' . $clientId,
            'Authorization: ' . $token
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $channelsApi
    ));

    $topgames = curl_exec($ch);
    curl_close($ch);


    
    return json_decode($topgames);
}