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

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = $this->productService->getAllproducts();
        return view('product.index', ['products' => $products]);
    }

    public function show($id)
    {
        $product = $this->productService->getproductById($id);

        return view('product.show', [
            'products' => $product
        ]);
    }

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

    public function store()
    {
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

        $validateAttributes['product_id'] = Auth::product()->id;

        $this->productService->createProduct($validateAttributes);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully');
    }

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

    public function update(Request $request, $id)
    {
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

        $this->productService->updateProduct($id, $validateAttributes);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

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
            ->paginate(10);

        if ($products->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('product.index', ['products' => $products]);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully');
    }
}
