<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();
    public function findById($id, ?array $with = []);
    public function create(array $data);
    public function update(int|string $id, array $data);
    public function delete(int|string $id);
}
