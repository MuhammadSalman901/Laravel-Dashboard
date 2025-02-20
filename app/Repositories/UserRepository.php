<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Repositories\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function getAll()
    {
        $paginator = $this->users->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    public function findById($id, ?array $with = [])
    {
        return $this->users->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->users->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->users->findOrFail($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        return $this->users->destroy($id);
    }
}
