<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class OrderService
{
    protected $orderRepository;

    // constructor
    public function __construct(RepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    // Fetching all orders
    public function getAllorders()
    {
        return $this->orderRepository->getAll();
    }

    // Fetching order by specific id
    public function getOrderById($id, array $with = [])
    {
        return $this->orderRepository->findById($id, $with);
    }

    // Create order
    public function createOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }
}
