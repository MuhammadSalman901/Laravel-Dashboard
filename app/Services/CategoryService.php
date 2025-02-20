<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class CategoryService
{
    protected $categoriesRepository;

    // constructor
    public function __construct(RepositoryInterface $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    // Fetching all categories
    public function getAllcategories()
    {
        return $this->categoriesRepository->getAll();
    }

    // Fetching category by specific id 
    public function getcategoriesById($id)
    {
        return $this->categoriesRepository->findById($id);
    }

    // Create category
    public function createCategory($data)
    {
        return $this->categoriesRepository->create($data);
    }

    // Update category
    public function updateCategory($id, $data)
    {
        return $this->categoriesRepository->update($id, $data);
    }

    // Delete category
    public function deleteCategory($id)
    {
        return $this->categoriesRepository->delete($id);
    }
}
