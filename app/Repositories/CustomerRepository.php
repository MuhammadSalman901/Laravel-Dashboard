<?php

namespace App\Repositories;

use App\Models\Customers;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerRepository implements RepositoryInterface
{
    protected $customers;

    // Constructor
    public function __construct(Customers $customers)
    {
        $this->customers = $customers;
    }

    // Get All functions
    public function getAll()
    {
        $paginator = $this->customers->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException();
        }

        return $paginator;
    }

    // Find by specific id function
    public function findById($id, ?array $with = [])
    {
        return $this->customers->findOrFail($id);
    }

    // create function
    public function create(array $data)
    {
        return $this->customers->create($data);
    }

    // update function
    public function update($id, array $data)
    {
        return $this->customers->where('id', $id)->update($data);
    }

    // delete function
    public function delete($id)
    {
        return $this->customers->destroy($id);
    }
}
