<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class OrderService
{
    protected $orderRepository;

    public function __construct(RepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllorders()
    {
        return $this->orderRepository->getAll();
    }

    public function getOrderById($id, array $with = [])
    {
        return $this->orderRepository->findById($id, $with);
    }

    public function createOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }
}
