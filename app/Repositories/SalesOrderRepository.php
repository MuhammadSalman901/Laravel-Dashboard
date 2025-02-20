<?php

namespace App\Repositories;

use App\Models\SalesOrder;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SalesOrderRepository implements RepositoryInterface
{
    protected $salesorders;

    public function __construct(SalesOrder $salesorders)
    {
        $this->salesorders = $salesorders;
    }

    public function getAll()
    {
        $paginator = $this->salesorders->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    public function findById($id, ?array $with = [])
    {
        $query = $this->salesorders;

        if (!empty($with)) {
            $query = $query->with($with);
        }

        return $query->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->salesorders->create($data);
    }

    public function update($id, array $data)
    {
        return $this->salesorders->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->salesorders->destroy($id);
    }
}
