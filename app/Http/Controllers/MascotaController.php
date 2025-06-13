<?php

namespace App\Http\Controllers;

use App\Http\Requests\MascotaRequest;
use App\Http\Resources\MascotaResource;
use App\Models\Mascota;
use App\Services\MascotaService;
use App\Http\Requests\UpdateMascotaRequest;

class MascotaController extends Controller
{
    protected MascotaService $service;

    public function __construct(MascotaService $service)
    {
        $this->service = $service;
    }

    public function store(MascotaRequest $request)
    {
        $mascota = $this->service->crearMascotaConDatosExternos($request->validated());
        return new MascotaResource($mascota);
    }

    public function show($id)
    {
        return new MascotaResource(Mascota::findOrFail($id));
    }

   public function update(UpdateMascotaRequest $request, Mascota $mascota)
    {
        $this->authorize('update', $mascota);

        $data = $request->validated();
        $mascota->update($data);

        return response()->json(['message' => 'Mascota actualizada correctamente', 'data' => $mascota]);
    }

    public function destroy(Mascota $mascota)
    {
        $this->authorize('delete', $mascota);

        $mascota->delete();

        return response()->json(['message' => 'Mascota eliminada correctamente']);
    }

    // Esta función parece pertenecer a Persona, no a Mascota
    public function showWithPets($id)
    {
        // Cambiar esto si tienes relación inversa
        $mascota = Mascota::with('users')->findOrFail($id);
        return new MascotaResource($mascota);
    }
}
