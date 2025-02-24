<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class CustomerService
{
    protected $customerRepository;

    // constructor
    public function __construct(RepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    // Fetching all customers
    public function getAllCustomers()
    {
        return $this->customerRepository->getAll();
    }

    // Fetching customer by specific id
    public function getCustomerById($id)
    {
        return $this->customerRepository->findById($id);
    }

    // Create customer
    public function createCustomer($data)
    {
        return $this->customerRepository->create($data);
    }

    // Update customer
    public function updateCustomer($id, $data)
    {
        return $this->customerRepository->update($id, $data);
    }

    // Delete customer
    public function deleteCustomer($id)
    {
        return $this->customerRepository->delete($id);
    }
}
