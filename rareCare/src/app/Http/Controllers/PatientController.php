<?php

namespace App\Http\Controllers;

use App\Swagger\OpenApiSpec;
use OpenApi\Annotations as OA;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\DTO\CreatePatientDTO

class PatientController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/patients",
     *     summary="Get all patients",
     *     tags={"Patients"},
     *     @OA\Response(
     *         response=200,
     *         description="List of patients"
     *     )
     * )
     */

    public function index()
    {
        return Patient::paginate(10);
    }
    
    public function store(Request $request)
    {
        $userDto = new CreatePatientDTO($request->name, $request->age, $request->treatment, $request->symptoms, $request->disease);
        $data = $userDto->dtoReturn($request);
        return Patient::create($data);
    }

    public function show(Patient $patient)
    {
        return $patient;
    }

    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->all());
        return $patient;
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(['message' => 'deleted']);
    }
}
