<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class ProductService
{
    protected $productRepository;

    // constructor
    public function __construct(RepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // Fetching all products
    public function getAllproducts()
    {
        return $this->productRepository->getAll();
    }

    // Fetching products by specific id
    public function getproductById($id)
    {
        return $this->productRepository->findById($id);
    }

    // Create products
    public function createProduct($data)
    {
        return $this->productRepository->create($data);
    }

    // Update products
    public function updateProduct($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    // Delete products
    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}
