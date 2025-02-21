<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Services\SupplierService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    protected $supplierService;

    // Constructor for dependency injection of SupplierService
    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    // Rendering the supplier listing page
    public function index()
    {
        $suppliers = $this->supplierService->getAllsuppliers();
        return view('supplier.index', ['suppliers' => $suppliers]);
    }

    // Rendering the specific supplier details page
    public function show($id)
    {
        $supplier = $this->supplierService->getsupplierById($id);

        return view('supplier.show', [
            'suppliers' => $supplier
        ]);
    }

    // Initiating the create process and Rendering the supplier creation form
    public function create()
    {
        $userId = Auth::user()->id;

        return view('supplier.create', [
            'userId' => $userId
        ]);
    }

    // Storing incoming supplier data from the form to the database
    public function store()
    {
        // Backend validation of supplier attributes
        $validateAttributes = request()->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:users'],
            'phone' => ['required'],
            'address' => ['required'],
            'user_id' => ['required', 'integer']
        ]);

        // Creating the supplier using the service layer
        $this->supplierService->createSupplier($validateAttributes);

        // Session Message
        session()->flash('success', 'Supplier Created Successfully');

        // Redirecting upon successful storage
        return redirect()->route('supplier.index');
    }

    // Initiating the edit process and Rendering the supplier edit form
    public function edit($id)
    {
        $suppliers = $this->supplierService->getSupplierById($id);

        return view('supplier.edit', [
            'suppliers' => $suppliers
        ]);
    }

    // Updating incoming supplier data from the form to the database
    public function update(Request $request, $id)
    {
        // Backend validation of updated supplier attributes
        $validateAttributes = $request->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:suppliers,email,' . $id],
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        // Updating the supplier using the service layer
        $this->supplierService->updateSupplier($id, $validateAttributes);

        // Session Message
        session()->flash('success', 'Supplier Updated Successfully');

        // Redirecting upon successful update
        return redirect()->route('supplier.index');
    }

    // Searching supplier records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');

        // Querying the database for matching supplier records
        $suppliers = Suppliers::query()
            ->where(function ($query) use ($search) {
                $query->where('contact_name', 'iLIKE', "%{$search}%")
                    ->orWhere('company_name', 'iLIKE', "%{$search}%")
                    ->orWhere('email', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%")
                    ->orWhere('contact_title', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        // Throwing an exception if no records are found
        if ($suppliers->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        // Rendering the supplier index page with search results
        return view('supplier.index', ['suppliers' => $suppliers]);
    }

    // Deleting a supplier record
    public function destroy($id)
    {
        // Deleting the supplier using the service layer
        $this->supplierService->deleteSupplier($id);

        // Redirecting upon successful deletion
        return redirect()->route('supplier.index')
            ->with('success', 'Supplier deleted successfully');
    }
}
