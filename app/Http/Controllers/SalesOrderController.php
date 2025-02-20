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

    public function __construct(SalesOrderService $salesorderService)
    {
        $this->salesorderService = $salesorderService;
    }

    public function index()
    {
        $salesorders = $this->salesorderService->getAllsalesorders();
        return view('salesorder.index', ['salesorders' => $salesorders]);
    }

    public function show($id)
    {
        $salesorder = $this->salesorderService->getSalesOrderById($id);

        return view('salesorder.show', [
            'salesorders' => $salesorder
        ]);
    }

    public function create()
    {
        return view('salesorder.create', [
            'users' => User::all(),
            'customers' => Customers::all(),
            'shippers' => Shippers::all(),
            'userId' => Auth::id()
        ]);
    }

    public function store()
    {
        // dd(request()->all());
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

        $salesOrder = $this->salesorderService->createSalesOrder($validateAttributes);

        return redirect()->route('order_list.create', ['sales_order_id' => $salesOrder->id])
            ->with('success', 'Sales Order created. Now add products.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $salesorders = SalesOrder::query()
            ->where(function ($query) use ($search) {
                $query->where('ship_name', 'iLIKE', "%{$search}%")
                    ->orWhere('ship_address', 'iLIKE', "%{$search}%")
                    ->orWhere('ship_city', 'iLIKE', "%{$search}%")
                    ->orWhere('ship_country', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        if ($salesorders->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('salesorder.index', ['salesorders' => $salesorders]);
    }

    public function destroy($id)
    {
        $this->salesorderService->deleteSalesOrder($id);

        return redirect()->route('sales_order.index')
            ->with('success', 'Sales Order deleted successfully');
    }
}
