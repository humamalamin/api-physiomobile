<?php

namespace App\Http\Controllers;

use App\Gender;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    /**
     * @header accessKey string required value api/tokens/create
    */
    public function createPatient(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'id_type' => 'required|string',
                'id_no' => 'required|string',
                'gender' => ['required', Rule::in(array_column(Gender::cases(), 'value'))],
                'dob' => 'required|date',
                'address' => 'required|string',
                'medium_acquisition' => 'required|string',
            ]);

            $patient = $this->userService->createPatient($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Patient created successfully',
                'data' => [
                    'patient_id' => $patient->id,
                ],
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @header accessKey string required value api/tokens/create
    */
    public function getAllPatients(Request $request)
    {
        try {
            $limit = 10;
            if ($request->has('limit')) {
                $limit = (int) $request->query('limit');
            }

            $page = 1;
            if ($request->has('page')) {
                $page = (int) $request->query('page');
            }

            $search = null;
            if ($request->has('search')) {
                $search = $request->query('search');
            }

            $patients = $this->userService->getAllPatients($limit, $page, $search);
            return response()->json([
                'status' => true,
                'message' => 'Patients retrieved successfully',
                'data' => $patients,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @header accessKey string required value api/tokens/create
    */
    public function getPatientById($id)
    {
        try {
            $patient = $this->userService->getPatientById($id);
            return response()->json([
                'status' => true,
                'message' => 'Patient retrieved successfully',
                'data' => $patient,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @header accessKey string required value api/tokens/create
    */
    public function updatePatient(Request $request, $patientId)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'id_type' => 'required|string',
                'id_no' => 'required|string',
                'gender' => ['required', Rule::in(array_column(Gender::cases(), 'value'))],
                'dob' => 'required|date',
                'address' => 'required|string',
                'medium_acquisition' => 'required|string',
            ]);

            $patient = $this->userService->updatePatient($patientId, $request->all());
            return response()->json([
                'status' => true,
                'message' => 'Patient updated successfully',
                'data' => [
                    'patient_id' => $patient->id,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @header accessKey string required value api/tokens/create
    */
    public function deletePatient($id)
    {
        try {
            $this->userService->deletePatient($id);
            return response()->json([
                'status' => true,
                'message' => 'Patient deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
