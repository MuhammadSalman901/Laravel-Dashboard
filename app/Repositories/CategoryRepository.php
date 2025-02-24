<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository implements RepositoryInterface
{
    protected $categories;

    // Constructor
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    // Get All function
    public function getAll()
    {
        $paginator = $this->categories->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    // Find by specific id function
    public function findById($id, ?array $with = [])
    {
        return $this->categories->findOrFail($id);
    }

    // Create function
    public function create(array $data)
    {
        return $this->categories->create($data);
    }

    // Update function
    public function update($id, array $data)
    {
        return $this->categories->where('id', $id)->update($data);
    }

    // Delete function
    public function delete($id)
    {
        return $this->categories->destroy($id);
    }
}
