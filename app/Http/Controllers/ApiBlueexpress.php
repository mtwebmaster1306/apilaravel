<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class ApiBlueexpress extends Controller
{
    private $bluexApiBase = 'https://bx-tracking.bluex.cl/bx-pricing/v1';
    private $geoApi = 'https://bx-tracking.bluex.cl/bx-geo';
    private $headers = [
        'BX-TOKEN' => '1d629416cf222568df3c231ce57c93ec',
        'BX-USERCODE' => '183462',
        'BX-CLIENT_ACCOUNT' => '77563939-2-80',
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    public function getRegions()
    {
        try {
            $client = new Client([
                'verify' => false, // Desactiva la verificación del certificado SSL
            ]);
    
            $response = $client->request('GET', "{$this->geoApi}/state/all", [
                'headers' => $this->headers,
            ]);
    
            $data = json_decode($response->getBody(), true);
            return response()->json($data);
        } catch (RequestException $e) {
            return response()->json([
                'error' => 'Error fetching regions',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function calculateShipment(Request $request)
    {
        try {
            $client = new Client([
                'verify' => false, // Desactiva la verificación del certificado SSL
            ]);
    
            $response = $client->request('POST', $this->bluexApiBase, [
                'headers' => $this->headers,
                'json' => $request->all()
            ]);
    
            $data = json_decode($response->getBody(), true);
            return response()->json($data);
        } catch (RequestException $e) {
            return response()->json([
                'error' => 'Error calculating shipment',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}