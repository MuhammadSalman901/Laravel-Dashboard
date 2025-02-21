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

    // Constructor for dependency injection of OrderService
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // Rendering the order listing page
    public function index()
    {
        $orders = $this->orderService->getAllorders();
        return view('order.index', ['orders' => $orders]);
    }

    // Rendering the specific order details page with related data
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

    // Initiating the create process and Rendering the order creation form
    public function create($sales_order_id)
    {
        // Validating if the sales order exists
        if (!SalesOrder::where('id', $sales_order_id)->exists()) {
            abort(404, 'Sales Order not found.');
        }

        return view('order.create', [
            'products' => Product::all(),
            'sales_order_id' => $sales_order_id,
            'user_id' => Auth::id()
        ]);
    }

    // Storing incoming order data from the form to the database
    public function store(Request $request)
    {
        // Backend validation of order attributes
        $validated = $request->validate([
            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.price' => ['required', 'string', 'max:255'],
            'products.*.discount' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'sales_order_id' => ['required', 'exists:sales_orders,id']
        ]);

        // Looping through each product and creating an order
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

        // Session Message
        session()->flash('success', 'Order Created Successfully');

        // Redirecting upon successful storage
        return redirect()->route('order_list.index');
    }

    // Searching order records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');

        // Querying the database for matching order records
        $orders = OrderDetail::query()
            ->where(function ($query) use ($search) {
                $query->where('id', 'iLIKE', "%{$search}%")
                    ->orWhere('quantity', 'iLIKE', "%{$search}%")
                    ->orWhere('price', 'iLIKE', "%{$search}%")
                    ->orWhere('discount', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        // Throwing an exception if no records are found
        if ($orders->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        // Rendering the order index page with search results
        return view('order.index', ['orders' => $orders]);
    }
}
