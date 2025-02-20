<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Services\SupplierService;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $suppliers = $this->supplierService->getAllsuppliers();
        return view('supplier.index', ['suppliers' => $suppliers]);
    }

    public function show($id)
    {
        $supplier = $this->supplierService->getsupplierById($id);

        return view('supplier.show', [
            'suppliers' => $supplier
        ]);
    }

    public function create()
    {
        $userId = Auth::user()->id;

        return view('supplier.create', [
            'userId' => $userId
        ]);
    }

    public function store()
    {
        $validateAttributes = request()->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:users'],
            'phone' => ['required'],
            'address' => ['required'],
            'user_id' => ['required', 'integer']
        ]);

        $this->supplierService->createSupplier($validateAttributes);

        return redirect()->route('supplier.index')
            ->with('success', 'supplier created successfully');
    }

    public function edit($id)
    {
        $suppliers = $this->supplierService->getSupplierById($id);

        return view('supplier.edit', [
            'suppliers' => $suppliers
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateAttributes = $request->validate([
            'contact_name' => ['required', 'min:3'],
            'company_name' => ['required', 'min:3'],
            'contact_title' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:suppliers,email,' . $id],
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        $this->supplierService->updateSupplier($id, $validateAttributes);

        return redirect()->route('supplier.index')
            ->with('success', 'supplier updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $suppliers = Suppliers::query()
            ->where(function ($query) use ($search) {
                $query->where('contact_name', 'iLIKE', "%{$search}%")
                    ->orWhere('company_name', 'iLIKE', "%{$search}%")
                    ->orWhere('email', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%")
                    ->orWhere('contact_title', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        if ($suppliers->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('supplier.index', ['suppliers' => $suppliers]);
    }

    public function destroy($id)
    {
        $this->supplierService->deleteSupplier($id);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier deleted successfully');
    }
}
