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

    // Constructor for dependency injection of CustomerService
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    // Rendering the customer listing page
    public function index()
    {
        $customers = $this->customerService->getAllcustomers();
        return view('customer.index', ['customers' => $customers]);
    }

    // Rendering the specific customer details page
    public function show($id)
    {
        $customer = $this->customerService->getcustomerById($id);

        return view('customer.show', [
            'customers' => $customer
        ]);
    }

    // Initiating the create process and Rendering the customer creation form
    public function create()
    {
        $userId = Auth::user()->id;

        return view('customer.create', [
            'userId' => $userId
        ]);
    }

    // Storing incoming customer data from the form to the database
    public function store()
    {
        // Backend validation of customer attributes
        $validateAttributes = request()->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:customers'],
            'phone' => ['required'],
            'address' => ['required'],
            'user_id' => ['required', 'integer']
        ]);

        // Creating the customer using the service layer
        $this->customerService->createCustomer($validateAttributes);

        // Session Message
        session()->flash('success', 'Customer Created Successfully');

        // Redirecting upon successful storage
        return redirect()->route('customer.index');
    }

    // Initiating the edit process and Rendering the customer edit form
    public function edit($id)
    {
        $customers = $this->customerService->getCustomerById($id);

        return view('customer.edit', [
            'customers' => $customers
        ]);
    }

    // Updating incoming customer data from the form to the database
    public function update(Request $request, $id)
    {
        // Backend validation of updated customer attributes
        $validateAttributes = $request->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:customers,email,' . $id],
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        // Updating the customer using the service layer
        $this->customerService->updateCustomer($id, $validateAttributes);

        // Session Message
        session()->flash('success', 'Customer Updated Successfully');

        // Redirecting upon successful update
        return redirect()->route('customer.index');
    }

    // Searching customer records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');

        // Querying the database for matching customer records
        $customers = Customers::query()
            ->where(function ($query) use ($search) {
                $query->where('contact_name', 'iLIKE', "%{$search}%")
                    ->orWhere('company_name', 'iLIKE', "%{$search}%")
                    ->orWhere('email', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%")
                    ->orWhere('contact_title', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        // Throwing an exception if no records are found
        if ($customers->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        // Rendering the customer index page with search results
        return view('customer.index', ['customers' => $customers]);
    }

    // Deleting a customer record
    public function destroy($id)
    {
        // Deleting the customer using the service layer
        $this->customerService->deleteCustomer($id);

        // Redirecting upon successful deletion
        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully');
    }
}
