<?php

namespace App\Repositories;

use App\Models\Mascota;


class PetRepository
{
    public function all($perPage = 10)
    {
        return Mascota::paginate($perPage);
    }

    public function find($id)
    {
        return Mascota::findOrFail($id);
    }

    public function create(array $data)
    {
        return Mascota::create($data);
    }

    public function update(Mascota $pet, array $data)
    {
        $pet->update($data);
        return $pet;
    }

    public function delete(Mascota $pet)
    {
        return $pet->delete();
    }

    public function getByPerson($personId)
    {
        return Mascota::where('user_id', $personId)->get();
    }
}
