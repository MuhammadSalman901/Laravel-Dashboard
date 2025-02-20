<?php

namespace App\Repositories;

use App\Models\Suppliers;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierRepository implements RepositoryInterface
{
    protected $suppliers;

    public function __construct(Suppliers $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    public function getAll()
    {
        $paginator = $this->suppliers->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    public function findById($id, ?array $with=[])
    {
        return $this->suppliers->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->suppliers->create($data);
    }

    public function update($id, array $data)
    {
        return $this->suppliers->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->suppliers->destroy($id);
    }
}
