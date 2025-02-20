<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class UserService
{
    protected $userRepository;

    // constructor
    public function __construct(RepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Fetching all users
    public function getAllusers()
    {
        return $this->userRepository->getAll();
    }

    // Fetching user by specific id
    public function getuserById($id)
    {
        return $this->userRepository->findById($id);
    }

    // Create user
    public function createUser($data)
    {
        return $this->userRepository->create($data);
    }

    // Update user
    public function editUser($id, $data)
    {
        return $this->userRepository->update($id, $data);
    }

    // Delete user
    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
