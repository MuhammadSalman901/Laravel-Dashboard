<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\SalesOrder;
use App\Models\Shippers;
use App\Models\User;
use App\Services\SalesOrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    protected $salesorderService;

    // Constructor for dependency injection of SalesOrderService
    public function __construct(SalesOrderService $salesorderService)
    {
        $this->salesorderService = $salesorderService;
    }

    // Rendering the sales order listing page
    public function index()
    {
        $salesorders = $this->salesorderService->getAllsalesorders();
        $noRecordsFound = false;

        return view('salesorder.index', [
            'salesorders' => $salesorders,
            'noRecordsFound' => $noRecordsFound,
        ]);
    }

    // Rendering the specific sales order details page
    public function show($id)
    {
        $salesorder = $this->salesorderService->getSalesOrderById($id);

        return view('salesorder.show', [
            'salesorders' => $salesorder
        ]);
    }

    // Initiating the create process and Rendering the sales order creation form
    public function create()
    {
        return view('salesorder.create', [
            'users' => User::all(),
            'customers' => Customers::all(),
            'shippers' => Shippers::all(),
            'userId' => Auth::id()
        ]);
    }

    // Storing incoming sales order data from the form to the database
    public function store()
    {
        // Backend validation of sales order attributes
        $validateAttributes = request()->validate([
            'ship_name' => ['required', 'min:3'],
            'ship_address' => ['required'],
            'ship_city' => ['required'],
            'ship_country' => ['required'],
            'order_date' => ['required'],
            'required_date' => ['required'],
            'shipped_date' => ['required'],
            'user_id' => ['required', 'integer'],
            'customers_id' => ['required', 'integer'],
            'shippers_id' => ['required', 'integer'],
        ]);

        // Creating the sales order using the service layer
        $salesOrder = $this->salesorderService->createSalesOrder($validateAttributes);

        // Redirecting to the order list creation page with the sales order ID
        return redirect()->route('order_list.create', ['sales_order_id' => $salesOrder->id]);
    }

    // Searching sales order records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');
        $perPage = 10; // Match pagination count

        // Querying the database for matching sales order records
        $salesorders = SalesOrder::query()
            ->where(function ($query) use ($search) {
                $query->where('ship_name', 'iLIKE', "%{$search}%")
                    ->orWhere('ship_address', 'iLIKE', "%{$search}%")
                    ->orWhere('ship_city', 'iLIKE', "%{$search}%")
                    ->orWhere('ship_country', 'iLIKE', "%{$search}%");
            })
            ->paginate($perPage);

        // Calculate result range
        $total = $salesorders->total();
        $currentPage = $salesorders->currentPage();
        $start = ($currentPage - 1) * $perPage + 1;
        $end = min($currentPage * $perPage, $total);

        return view('salesorder.index', [
            'salesorders' => $salesorders,
            'resultInfo' => [
                'total' => $total,
                'start' => $start,
                'end' => $end,
                'searchTerm' => $search
            ],
            'noRecordsFound' => $salesorders->isEmpty()
        ]);
    }

    // Deleting a sales order record
    public function destroy($id)
    {
        // Deleting the sales order using the service layer
        $this->salesorderService->deleteSalesOrder($id);

        // Redirecting upon successful deletion
        return redirect()->route('sales_order.index')
            ->with('success', 'Sales Order deleted successfully');
    }
}
