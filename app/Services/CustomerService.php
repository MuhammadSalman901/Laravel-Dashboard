<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class CustomerService
{
    protected $customerRepository;

    public function __construct(RepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers()
    {
        return $this->customerRepository->getAll();
    }

    public function getCustomerById($id)
    {
        return $this->customerRepository->findById($id);
    }

    public function createCustomer($data)
    {
        return $this->customerRepository->create($data);
    }

    public function updateCustomer($id, $data)
    {
        return $this->customerRepository->update($id, $data);
    }

    public function deleteCustomer($id)
    {
        return $this->customerRepository->delete($id);
    }
}
