<?php

namespace App\Repositories;

use App\Models\Shippers;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShipperRepository implements RepositoryInterface
{
    protected $shippers;

    // constructor
    public function __construct(Shippers $shippers)
    {
        $this->shippers = $shippers;
    }

    // Get All function 
    public function getAll()
    {
        $paginator = $this->shippers->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    // Find by specific id function
    public function findById($id, ?array $with = [])
    {
        return $this->shippers->findOrFail($id);
    }

    // create function
    public function create(array $data)
    {
        return $this->shippers->create($data);
    }

    // update function
    public function update($id, array $data)
    {
        return $this->shippers->where('id', $id)->update($data);
    }

    // delete function
    public function delete($id)
    {
        return $this->shippers->destroy($id);
    }
}
