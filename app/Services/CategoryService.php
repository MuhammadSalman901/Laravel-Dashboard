<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

class CategoryService
{
    protected $categoriesRepository;

    public function __construct(RepositoryInterface $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getAllcategories()
    {
        return $this->categoriesRepository->getAll();
    }

    public function getcategoriesById($id)
    {
        return $this->categoriesRepository->findById($id);
    }

    public function createCategory($data)
    {
        return $this->categoriesRepository->create($data);
    }

    public function updateCategory($id, $data)
    {
        return $this->categoriesRepository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->categoriesRepository->delete($id);
    }
}
