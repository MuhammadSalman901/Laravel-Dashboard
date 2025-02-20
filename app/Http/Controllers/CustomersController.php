<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Support\Facades\Hash;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    public function index()
    {
        $customers = $this->customerService->getAllcustomers();
        return view('customer.index', ['customers' => $customers]);
    }

    public function show($id)
    {
        $customer = $this->customerService->getcustomerById($id);

        return view('customer.show', [
            'customers' => $customer
        ]);
    }

    public function create()
    {
        $userId = Auth::user()->id;

        return view('customer.create', [
            'userId' => $userId
        ]);
    }

    public function store()
    {
        $validateAttributes = request()->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:customers'],
            'phone' => ['required'],
            'address' => ['required'],
            'user_id' => ['required', 'integer']
        ]);

        $this->customerService->createCustomer($validateAttributes);

        return redirect()->route('customer.index')
            ->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $customers = $this->customerService->getCustomerById($id);

        return view('customer.edit', [
            'customers' => $customers
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateAttributes = $request->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:customers,email,' . $id],
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        $this->customerService->updateCustomer($id, $validateAttributes);

        return redirect()->route('customer.index')
            ->with('success', 'Customer updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $customers = Customers::query()
            ->where(function ($query) use ($search) {
                $query->where('contact_name', 'iLIKE', "%{$search}%")
                    ->orWhere('company_name', 'iLIKE', "%{$search}%")
                    ->orWhere('email', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%")
                    ->orWhere('contact_title', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        if ($customers->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('customer.index', ['customers' => $customers]);
    }

    public function destroy($id)
    {
        $this->customerService->deleteCustomer($id);

        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully');
    }
}
