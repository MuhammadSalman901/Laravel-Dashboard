<?php

namespace App\Repositories;

use App\Models\Customers;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerRepository implements RepositoryInterface
{
    protected $customers;

    public function __construct(Customers $customers)
    {
        $this->customers = $customers;
    }

    public function getAll()
    {
        $paginator = $this->customers->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException();
        }

        return $paginator;
    }

    public function findById($id, ?array $with = [])
    {
        return $this->customers->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->customers->create($data);
    }

    public function update($id, array $data)
    {
        return $this->customers->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->customers->destroy($id);
    }
}
