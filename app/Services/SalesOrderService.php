<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class SalesOrderService
{
    protected $salesorderRepository;

    // constructor
    public function __construct(RepositoryInterface $salesorderRepository)
    {
        $this->salesorderRepository = $salesorderRepository;
    }

    // Fetching All sales orders
    public function getAllsalesorders()
    {
        return $this->salesorderRepository->getAll();
    }

    // Fetching sales by specific id 
    public function getSalesOrderById($id, array $with = [])
    {
        return $this->salesorderRepository->findById($id, $with);
    }

    // Create Sales Order
    public function createSalesOrder($data)
    {
        return $this->salesorderRepository->create($data);
    }

    // Delete Sales Order
    public function deleteSalesOrder($id)
    {
        return $this->salesorderRepository->delete($id);
    }
}
