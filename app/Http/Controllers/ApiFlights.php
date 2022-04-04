<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiFlights extends Controller
{
    public function getAllFlights()
    {
        $response = Http::get('http://prova.123milhas.net/api/flights');

        return $response->json();
    }

    function getFlightsGroups()
    {
        $response = Http::get('http://prova.123milhas.net/api/flights');

        $data = json_decode($response, true);

        $idGroup = 1;
        $groups = [];

        foreach ($data as $value) {
            $fare = $value['fare'];
            if (!array_key_exists($fare, $groups)) {
                $groups[$fare] = [];
            }
            $groups[$fare][] = $value;
        }

        $groupsPriceOutbound['outbound'] = [];
        $groupsPriceInbound['inbound'] = [];

        foreach ($groups as $key => $group) {
            $groupsAux[$key] = [];

            // foreach ($group as $keyGroup => $flight) {
            //     if ($flight['outbound'] == 1) {
            //         $price = $flight['price'];
            //         if (!array_key_exists($price, $groupsPriceOutbound['outbound'])) {
            //             $groupsPriceOutbound['outbound'][$price] = [];
            //         }
            //         $groupsPriceOutbound['outbound'][$price][] = $flight;
            //     } else {
            //         $price = $flight['price'];
            //         if (!array_key_exists($price, $groupsPriceInbound['inbound'])) {
            //             $groupsPriceInbound['inbound'][$price] = [];
            //         }
            //         $groupsPriceInbound['inbound'][$price][] = $flight;
            //     }
            // }

            foreach ($group as $keyGroup => $flight) {
                if ($flight['outbound'] == 1) {
                    $groupsPriceOutbound['outbound'][] = $flight;
                } else {
                    $groupsPriceInbound['inbound'][] = $flight;
                }
            }
        }


        dump($groupsPriceOutbound);
        dump($groupsPriceInbound);
        // dump($groups);
        dump($groupsAux);

        // return $response->json();
    }
}
