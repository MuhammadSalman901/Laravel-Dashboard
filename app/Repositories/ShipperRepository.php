<?php

namespace App\Repositories;

use App\Models\Shippers;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShipperRepository implements RepositoryInterface
{
    protected $shippers;

    public function __construct(Shippers $shippers)
    {
        $this->shippers = $shippers;
    }

    public function getAll()
    {
        $paginator = $this->shippers->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    public function findById($id, ?array $with = [])
    {
        return $this->shippers->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->shippers->create($data);
    }

    public function update($id, array $data)
    {
        return $this->shippers->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->shippers->destroy($id);
    }
}
