<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Models\Category;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    // Constructor for dependency injection of ProductService
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Rendering the product listing page
    public function index()
    {
        $products = $this->productService->getAllproducts();
        $noRecordsFound = false;

        return view('product.index', [
            'products' => $products,
            'noRecordsFound' => $noRecordsFound,
        ]);
    }

    // Rendering the specific product details page
    public function show($id)
    {
        $product = $this->productService->getproductById($id);

        return view('product.show', [
            'products' => $product
        ]);
    }

    // Initiating the create process and Rendering the product creation form
    public function create()
    {
        $userId = Auth::user()->id;
        $categories = Category::all();
        $suppliers = Suppliers::all();
        return view('product.create', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'userId' => $userId
        ]);
    }

    // Storing incoming product data from the form to the database
    public function store()
    {
        // Backend validation of product attributes
        $validateAttributes = request()->validate([
            'product_name' => ['required', 'min:3'],
            'quantity' => ['required'],
            'price' => ['required'],
            'units_in_stock' => ['required'],
            'units_on_order' => ['required'],
            'reorder_level' => ['required'],
            'discontinued' => ['required', 'min:0', 'max:1'],
            'product_id' => ['required', 'integer'],
            'suppliers_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
        ]);

        // Creating the product using the service layer
        $this->productService->createProduct($validateAttributes);

        // Session Message
        session()->flash('success', 'Product Created Successfully');

        // Redirecting upon successful storage
        return redirect()->route('product.index');
    }

    // Initiating the edit process and Rendering the product edit form
    public function edit($id)
    {
        $products = $this->productService->getproductById($id);
        $categories = Category::all();
        $suppliers = Suppliers::all();
        return view('product.edit', [
            'products' => $products,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }

    // Updating incoming product data from the form to the database
    public function update(Request $request, $id)
    {
        // Backend validation of updated product attributes
        $validateAttributes = $request->validate([
            'product_name' => ['required', 'min:3'],
            'quantity' => ['required'],
            'price' => ['required'],
            'units_in_stock' => ['required'],
            'units_on_order' => ['required'],
            'reorder_level' => ['required'],
            'discontinued' => ['required', 'min:0', 'max:1'],
            'suppliers_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
        ]);

        // Updating the product using the service layer
        $this->productService->updateProduct($id, $validateAttributes);

        // Session Message
        session()->flash('success', 'Product Updated Successfully');

        // Redirecting upon successful update
        return redirect()->route('product.index');
    }

    // Searching product records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');
        $perPage = 10; // Match pagination count

        // Querying the database for matching product records
        $products = Product::query()
            ->where(function ($query) use ($search) {
                $query->where('product_name', 'iLIKE', "%{$search}%")
                    ->orWhere('quantity', 'iLIKE', "%{$search}%")
                    ->orWhere('price', 'iLIKE', "%{$search}%")
                    ->orWhere('units_on_order', 'iLIKE', "%{$search}%")
                    ->orWhere('reorder_level', 'iLIKE', "%{$search}%")
                    ->orWhere('discontinued', 'iLIKE', "%{$search}%")
                    ->orWhere('units_in_stock', 'iLIKE', "%{$search}%");
            })
            ->paginate($perPage);

        // Calculate result range
        $total = $products->total();
        $currentPage = $products->currentPage();
        $start = ($currentPage - 1) * $perPage + 1;
        $end = min($currentPage * $perPage, $total);

        return view('product.index', [
            'products' => $products,
            'resultInfo' => [
                'total' => $total,
                'start' => $start,
                'end' => $end,
                'searchTerm' => $search
            ],
            'noRecordsFound' => $products->isEmpty()
        ]);
    }

    // Deleting a product record
    public function destroy($id)
    {
        // Deleting the product using the service layer
        $this->productService->deleteProduct($id);

        // Redirecting upon successful deletion
        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully');
    }
}
