<?php

namespace App\Services;

use App\Models\Mascota;
use App\Services\MascotaApiService;

class MascotaService
{
    protected MascotaApiService $mascotaApiService;

    public function __construct()
    {
        $this->mascotaApiService = new MascotaApiService();
    }

public function crearMascotaConDatosExternos(array $data)
{
    $datosExternos = $this->mascotaApiService->fetchBreedInfo($data['especie'], $data['raza']);
        if (empty($datosExternos)) {
        throw new \Exception("No se encontraron datos externos para la especie y raza proporcionadas.");
    }
    $data['external_data'] = json_encode($datosExternos);
    $data['imagen'] = $datosExternos['imagen'] ?? null;
    $data['user_id'] = auth()->id();

    return Mascota::create($data);
}
}
