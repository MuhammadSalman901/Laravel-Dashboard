<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoriesService;

    public function __construct(CategoryService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }
    public function index()
    {
        $categories = $this->categoriesService->getAllcategories();
        return view('category.index', ['categories' => $categories]);
    }

    public function show($id)
    {
        $categories = $this->categoriesService->getcategoriesById($id);

        return view('category.show', [
            'categories' => $categories
        ]);
    }


    public function create()
    {
        $userId = Auth::user()->id;

        return view('category.create', [
            'userId' => $userId
        ]);
    }

    public function store(Request $request)
    {
        $validateAttributes = request()->validate([
            'category_name' => ['required', 'min:3'],
            'description' => ['required'],
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'category_id' => ['required', 'integer']
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');

            $validateAttributes['image_path'] = $imagePath;
        }

        $this->categoriesService->createCategory($validateAttributes);

        return redirect()->route('category.index')
            ->with('success', 'category created successfully');
    }

    public function edit($id)
    {
        $categories = $this->categoriesService->getcategoriesById($id);

        return view('category.edit', [
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateAttributes = $request->validate([
            'category_name' => ['required', 'min:3'],
            'description' => ['required'],
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');

            $validateAttributes['image_path'] = $imagePath;
        }

        $this->categoriesService->updateCategory($id, $validateAttributes);

        return redirect()->route('category.index')
            ->with('success', 'category updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::query()
            ->where(function ($query) use ($search) {
                $query->where('category_name', 'iLIKE', "%{$search}%")
                    ->orWhere('description', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        if ($categories->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('category.index', ['categories' => $categories]);
    }

    public function destroy($id)
    {
        $this->categoriesService->deleteCategory($id);

        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }
}
