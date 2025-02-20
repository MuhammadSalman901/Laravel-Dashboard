<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(RepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllsuppliers()
    {
        return $this->supplierRepository->getAll();
    }

    public function getsupplierById($id)
    {
        return $this->supplierRepository->findById($id);
    }

    public function createSupplier($data)
    {
        return $this->supplierRepository->create($data);
    }

    public function updateSupplier($id, $data)
    {
        return $this->supplierRepository->update($id, $data);
    }

    public function deleteSupplier($id)
    {
        return $this->supplierRepository->delete($id);
    }
}
