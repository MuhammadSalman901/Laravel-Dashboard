<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class SalesOrderService
{
    protected $salesorderRepository;

    public function __construct(RepositoryInterface $salesorderRepository)
    {
        $this->salesorderRepository = $salesorderRepository;
    }

    public function getAllsalesorders()
    {
        return $this->salesorderRepository->getAll();
    }

    public function getSalesOrderById($id, array $with = [])
    {
        return $this->salesorderRepository->findById($id, $with);
    }

    public function createSalesOrder($data)
    {
        return $this->salesorderRepository->create($data);
    }

    public function deleteSalesOrder($id)
    {
        return $this->salesorderRepository->delete($id);
    }
}
