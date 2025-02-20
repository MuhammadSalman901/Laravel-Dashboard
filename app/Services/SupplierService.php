<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class SupplierService
{
    protected $supplierRepository;

    // constructor
    public function __construct(RepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    // Fetching all suppliers
    public function getAllsuppliers()
    {
        return $this->supplierRepository->getAll();
    }

    // Fetching suppliers on specific id 
    public function getsupplierById($id)
    {
        return $this->supplierRepository->findById($id);
    }

    // Create supplier
    public function createSupplier($data)
    {
        return $this->supplierRepository->create($data);
    }

    // Update supplier
    public function updateSupplier($id, $data)
    {
        return $this->supplierRepository->update($id, $data);
    }

    // Delete supplier
    public function deleteSupplier($id)
    {
        return $this->supplierRepository->delete($id);
    }
}
