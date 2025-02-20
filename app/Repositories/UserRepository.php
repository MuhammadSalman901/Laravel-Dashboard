<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Repositories\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    protected $users;

    // constructor 
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    // get All function
    public function getAll()
    {
        $paginator = $this->users->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    // Find by specific id function
    public function findById($id, ?array $with = [])
    {
        return $this->users->findOrFail($id);
    }

    // create function
    public function create(array $data)
    {
        return $this->users->create($data);
    }

    // update function
    public function update($id, array $data)
    {
        $model = $this->users->findOrFail($id);     // Fetching data from user model
        $model->fill($data);    // The ORM function from Eloquent that will fill the attributes in db  
        $model->save();     // Saving the data to the db
        return $model;
    }

    // delete function
    public function delete($id)
    {
        return $this->users->destroy($id);
    }
}
