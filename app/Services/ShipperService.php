<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class ShipperService
{
    protected $shipperRepository;

    // constructor
    public function __construct(RepositoryInterface $shipperRepository)
    {
        $this->shipperRepository = $shipperRepository;
    }

    // Fetching all shippers 
    public function getAllShippers()
    {
        return $this->shipperRepository->getAll();
    }

    // Fetching shippers by specific id 
    public function getShipperById($id)
    {
        return $this->shipperRepository->findById($id);
    }

    // Create shipper
    public function createShipper($data)
    {
        return $this->shipperRepository->create($data);
    }

    // Update shipper
    public function updateShipper($id, $data)
    {
        return $this->shipperRepository->update($id, $data);
    }

    // Delete shipper
    public function deleteShipper($id)
    {
        return $this->shipperRepository->delete($id);
    }
}
