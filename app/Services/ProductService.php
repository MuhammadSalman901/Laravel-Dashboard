<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(RepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllproducts()
    {
        return $this->productRepository->getAll();
    }

    public function getproductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct($data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}
