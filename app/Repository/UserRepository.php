<?php

namespace App\Repository;

use App\Gender;
use App\Models\Patient;
use App\Models\User;

class UserRepository implements \App\Repository\interface\UserInterface
{
    private $model;
    private $patient;

    public function __construct(User $model, Patient $patient)
    {
        $this->patient = $patient;
        $this->model = $model;
    }

    public function getAllPatients($limit, $page, $search)
    {
        $query = $this->patient->select('id', 'medium_acquisition', 'user_id')->with('user:id,name,dob,id_no');

        if ($search) {
            $query->WhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('id_no', 'like', "%$search%");
            })
            ->orWhere(function ($q) use ($search) {
                $q->where('medium_acquisition', 'like', "%$search%");
            });
        }

        return $query->paginate($limit, ['*'], 'page', $page);
    }


    public function getPatientById($id)
    {
        return $this->patient->select('id', 'medium_acquisition', 'user_id')
            ->with('user:id,name,dob,id_type,id_no,address')->findOrFail($id);
    }

    public function updatePatient($id, array $data)
    {
        $patient = $this->patient->findOrFail($id);
        $patient->update([
            'medium_acquisition' => $data['medium_acquisition'],
        ]);

        $patient->user->update([
            'name' => $data['name'],
            'id_type' => $data['id_type'],
            'gender' => Gender::from($data['gender']),
            'dob' => $data['dob'],
            'address' => $data['address'],
            'id_no' => $data['id_no'],
        ]);
        return $patient;
    }

    public function deletePatient($id)
    {
        $patient = $this->patient->findOrFail($id);
        if ($patient->user->patients()->count() == 1) {
            $patient->user()->delete();
        }
        return $patient->delete();
    }

    public function createPatient(array $data)
    {

        $user = $this->model->updateOrCreate(
            ['id_no' => $data['id_no']],
            [
                'name' => $data['name'],
                'id_type' => $data['id_type'],
                'gender' => Gender::from($data['gender']),
                'dob' => $data['dob'],
                'address' => $data['address'],
            ]
        );
        return $user->patients()->create([
            'medium_acquisition' => $data['medium_acquisition'],
        ]);
    }
}
