<?php

namespace App\Repositories;

use App\Models\Suppliers;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierRepository implements RepositoryInterface
{
    protected $suppliers;

    // constructor function
    public function __construct(Suppliers $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    // Get All function
    public function getAll()
    {
        $paginator = $this->suppliers->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    // Find by specific id function
    public function findById($id, ?array $with=[])
    {
        return $this->suppliers->findOrFail($id);
    }

    // create function
    public function create(array $data)
    {
        return $this->suppliers->create($data);
    }

    // update function
    public function update($id, array $data)
    {
        return $this->suppliers->where('id', $id)->update($data);
    }

    // delete function
    public function delete($id)
    {
        return $this->suppliers->destroy($id);
    }
}
