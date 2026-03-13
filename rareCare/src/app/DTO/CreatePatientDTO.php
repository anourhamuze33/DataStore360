<?php

namespace App\DTO;

class CreatePatientDTO
{
    public string $name;
    public int $age;
    public string $disease;
    public string $symptoms;
    public string $treatment;

    public function __construct(string $name, int $age, string $disease, string $symptoms, string $treatment)
    {
        $this->name = $name;
        $this->age = $age;
        $this->$disease;
        $this->$symptoms;
        $this->$treatment;
    }

    public function dtoReturn($request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'disease' => 'required|string',
            'symptoms' => 'required|string',
            'treatment' => 'nullable|string'
        ]);
        return $data;
    }
}
