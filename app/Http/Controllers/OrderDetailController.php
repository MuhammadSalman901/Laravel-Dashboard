<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\SalesOrder;
use App\Models\Shippers;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index()
    {
        $orders = $this->orderService->getAllorders();
        return view('order.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id, [
            'salesOrder.user',
            'salesOrder.customer',
            'salesOrder.shipper',
            'product'
        ]);

        return view('order.show', [
            'orders' => $order
        ]);
    }

    public function create($sales_order_id)
    {
        if (!SalesOrder::where('id', $sales_order_id)->exists()) {
            abort(404, 'Sales Order not found.');
        }

        return view('order.create', [
            'products' => Product::all(),
            'sales_order_id' => $sales_order_id,
            'user_id' => Auth::id()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.price' => ['required', 'string', 'max:255'],
            'products.*.discount' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'sales_order_id' => ['required', 'exists:sales_orders,id']
        ]);

        foreach ($validated['products'] as $product) {
            $this->orderService->createOrder([
                'sales_order_id' => $validated['sales_order_id'],
                'product_id' => $product['product_id'],
                'user_id' => $validated['user_id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'discount' => $product['discount'],
            ]);
        }

        return redirect()->route('order_list.index')
            ->with('success', 'Order details added successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $orders = OrderDetail::query()
            ->where(function ($query) use ($search) {
                $query->where('id', 'iLIKE', "%{$search}%")
                    ->orWhere('quantity', 'iLIKE', "%{$search}%")
                    ->orWhere('price', 'iLIKE', "%{$search}%")
                    ->orWhere('discount', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        if ($orders->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('order.index', ['orders' => $orders]);
    }
}
