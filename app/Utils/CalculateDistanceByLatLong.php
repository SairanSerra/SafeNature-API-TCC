<?php

namespace App\Utils;

class CalculateDistanceByLatLong
{

    public function index(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float
    {
        // Raio da Terra em quilômetros
        $radiusOfEarth = 6371;

        // Converter graus para radianos
        $lat1Rad = deg2rad($latitude1);
        $lon1Rad = deg2rad($longitude1);
        $lat2Rad = deg2rad($latitude2);
        $lon2Rad = deg2rad($longitude2);

        // Diferenças das coordenadas
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLon = $lon2Rad - $lon1Rad;

        // Fórmula de Haversine
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos($lat1Rad) * cos($lat2Rad) *
             sin($deltaLon / 2) * sin($deltaLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Distância em quilômetros
        $distance = $radiusOfEarth * $c;

        return $distance;
    }

}
