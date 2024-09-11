<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChilexpressController extends Controller
{
    private $baseUrl = 'https://testservices.wschilexpress.com';
    private $subscriptionKey = 'c17619e460b847429e8e7d031828c053';
     private $apikey ='dad6ae9cb40d47d9966bb2cb86e0e6d8';

    private function getClient()
    {
        return Http::withOptions([
            'verify' => false, // Desactiva la verificación del certificado SSL
        ]);
    }

    // Obtener todas las regiones
    public function getRegions()
    {
        $response = $this->getClient()->get("{$this->baseUrl}/georeference/api/v1.0/regions");

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'No se pudieron cargar las regiones.'], $response->status());
    }

    // Obtener todos los orígenes
    public function getAllOrigins()
    {
        $regionsResponse = $this->getClient()->get("{$this->baseUrl}/georeference/api/v1.0/regions");

        if ($regionsResponse->successful()) {
            $regionsData = $regionsResponse->json();
            $allOrigins = [];

            foreach ($regionsData['regions'] as $region) {
                $coverageAreasResponse = $this->getClient()->get("{$this->baseUrl}/georeference/api/v1.0/coverage-areas", [
                    'query' => [
                        'RegionCode' => $region['regionId'],
                        'type' => 0
                    ]
                ]);

                if ($coverageAreasResponse->successful()) {
                    $coverageAreasData = $coverageAreasResponse->json();
                    $allOrigins = array_merge($allOrigins, $coverageAreasData['coverageAreas']);
                }
            }

            // Ordenar y eliminar duplicados
            $allOrigins = collect($allOrigins)->unique('countyCode')->sortBy('countyName')->values();

            return response()->json($allOrigins);
        }

        return response()->json(['error' => 'No se pudieron cargar los orígenes.'], $regionsResponse->status());
    }

    // Obtener destinos basados en la región seleccionada
      public function getDestinations($regionCode)
{
    // Datos que se enviarán en la solicitud POST
    $data = [
        'RegionCode' => $regionCode,
        'type' => 0
    ];


    $response = $this->getClient()->withHeaders([
        'Ocp-Apim-Subscription-Key' => $this->apikey,
        'Content-Type' => 'application/json'
    ])->get("{$this->baseUrl}/georeference/api/v1.0/coverage-areas", $data);

    if ($response->successful()) {
        $data = $response->json();
        $sortedCoverageAreas = collect($data['coverageAreas'])->sortBy('countyName')->values();

        return response()->json($sortedCoverageAreas);
    }

    return response()->json(['error' => 'No se pudieron cargar los destinos.'], $response->status());
}

    

    // Calcular envío
    public function calculateShipment(Request $request)
    {
        $data = $request->validate([
            'originCountyCode' => 'required|string',
            'destinationCountyCode' => 'required|string',
            'package.weight' => 'required|numeric',
            'package.height' => 'required|numeric',
            'package.width' => 'required|numeric',
            'package.length' => 'required|numeric',
            'productType' => 'required|integer',
            'contentType' => 'required|integer',
            'declaredWorth' => 'required|string',
            'deliveryTime' => 'required|integer'
        ]);

        $response = $this->getClient()->withHeaders([
            'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
            'Content-Type' => 'application/json'
        ])->post("{$this->baseUrl}/rating/api/v1.0/rates/courier", $data);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Error al calcular el envío.'], $response->status());
    }
}
