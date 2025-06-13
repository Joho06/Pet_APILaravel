<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MascotaApiService
{
    public function fetchBreedInfo(string $especie, string $raza): array
    {
        if (strtolower($especie) === 'perro') {
            $apiKey = env('API_DOG');

            // Buscar datos de la raza
            $breedResponse = Http::withHeaders([
                'x-api-key' => $apiKey,
            ])->get('https://api.thedogapi.com/v1/breeds/search?q=' . urlencode($raza));

            if ($breedResponse->successful() && !empty($breedResponse[0])) {
                $breed = $breedResponse[0];

                // Intentar obtener imagen usando el id de la raza
                $imageUrl = null;

                if (isset($breed['id'])) {
                    $imageResponse = Http::withHeaders([
                        'x-api-key' => $apiKey,
                    ])->get('https://api.thedogapi.com/v1/images/search', [
                        'breed_ids' => $breed['id'],
                        'limit' => 1,
                    ]);

                    if ($imageResponse->successful() && !empty($imageResponse[0]['url'])) {
                        $imageUrl = $imageResponse[0]['url'];
                    }
                }

                return [
                    'nombre_raza' => $breed['name'] ?? null,
                    'temperamento' => $breed['temperament'] ?? null,
                    'origen' => $breed['origin'] ?? null,
                    'imagen' => $imageUrl,
                    'peso' => $breed['weight']['metric'] ?? null,
                    'altura' => $breed['height']['metric'] ?? null,
                ];
            }
        }

        return [];
    }
}
