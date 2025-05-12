<?php

namespace App\Services;

class UserService
{
    protected $userRepository;

    public function __construct(\App\Repository\interface\UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createPatient(array $data)
    {
        return $this->userRepository->createPatient($data);
    }

    public function getAllPatients($limit, $page, $search)
    {
        return $this->userRepository->getAllPatients($limit, $page, $search);
    }

    public function getPatientById($id)
    {
        return $this->userRepository->getPatientById($id);
    }

    public function updatePatient($id, array $data)
    {
        return $this->userRepository->updatePatient($id, $data);
    }

    public function deletePatient($id)
    {
        return $this->userRepository->deletePatient($id);
    }
}
