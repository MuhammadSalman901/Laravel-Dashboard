<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository implements RepositoryInterface
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function getAll()
    {
        $paginator = $this->products->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    public function findById($id, ?array $with = [])
    {
        return $this->products->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->products->create($data);
    }

    public function update($id, array $data)
    {
        return $this->products->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->products->destroy($id);
    }
}
