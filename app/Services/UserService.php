<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(RepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllusers()
    {
        return $this->userRepository->getAll();
    }

    public function getuserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser($data)
    {
        return $this->userRepository->create($data);
    }

    public function editUser($id, $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
