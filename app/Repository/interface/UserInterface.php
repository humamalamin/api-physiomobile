<?php

namespace App\Repository\interface;

interface UserInterface
{
    public function createPatient(array $data);
    public function getAllPatients($limit, $page, $search);
    public function getPatientById($id);
    public function updatePatient($id, array $data);
    public function deletePatient($id);
}
