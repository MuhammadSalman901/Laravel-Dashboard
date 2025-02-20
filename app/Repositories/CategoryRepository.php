<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository implements RepositoryInterface
{
    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function getAll()
    {
        $paginator = $this->categories->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    public function findById($id, ?array $with = [])
    {
        return $this->categories->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->categories->create($data);
    }

    public function update($id, array $data)
    {
        return $this->categories->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->categories->destroy($id);
    }
}
