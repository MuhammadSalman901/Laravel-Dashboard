<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderRepository implements RepositoryInterface
{
    protected $orders;

    // constructor
    public function __construct(OrderDetail $orders)
    {
        $this->orders = $orders;
    }

    // Get All function
    public function getAll()
    {
        $paginator = $this->orders->latest()->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) {
            throw new ModelNotFoundException;
        }

        return $paginator;
    }

    // Find by specific id function
    public function findById($id, ?array $with = [])
    {
        $query = $this->orders;

        if (!empty($with)) {
            $query = $query->with($with);
        }

        return $query->findOrFail($id);
    }

    // create function
    public function create(array $data)
    {
        return $this->orders->create([
            'sales_order_id' => $data['sales_order_id'],
            'product_id' => $data['product_id'],
            'user_id' => $data['user_id'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'discount' => $data['discount'],
        ]);
    }

    // update function
    public function update($id, array $data)
    {
        return $this->orders->where('id', $id)->update($data);
    }

    // delete function
    public function delete($id)
    {
        return $this->orders->destroy($id);
    }
}
