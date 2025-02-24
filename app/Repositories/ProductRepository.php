<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository implements RepositoryInterface
{
    protected $products;

    // constructor
    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    // Get All function
    public function getAll()
    {
        $paginator = $this->products->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    // Find by specific id function
    public function findById($id, ?array $with = [])
    {
        return $this->products->findOrFail($id);
    }

    // create function
    public function create(array $data)
    {
        return $this->products->create($data);
    }

    // update function
    public function update($id, array $data)
    {
        return $this->products->where('id', $id)->update($data);
    }

    // delete function
    public function delete($id)
    {
        return $this->products->destroy($id);
    }
}
