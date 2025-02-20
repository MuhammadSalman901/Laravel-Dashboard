<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class ShipperService
{
    protected $shipperRepository;

    public function __construct(RepositoryInterface $shipperRepository)
    {
        $this->shipperRepository = $shipperRepository;
    }

    public function getAllShippers()
    {
        return $this->shipperRepository->getAll();
    }

    public function getShipperById($id)
    {
        return $this->shipperRepository->findById($id);
    }

    public function createShipper($data)
    {
        return $this->shipperRepository->create($data);
    }

    public function updateShipper($id, $data)
    {
        return $this->shipperRepository->update($id, $data);
    }

    public function deleteShipper($id)
    {
        return $this->shipperRepository->delete($id);
    }
}
