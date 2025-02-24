<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoriesService;

    // constructor
    public function __construct(CategoryService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    // Rendering the user listing page
    public function index()
    {
        $categories = $this->categoriesService->getAllcategories();
        $noRecordsFound = false;

        return view('category.index', [
            'categories' => $categories,
            'noRecordsFound' => $noRecordsFound,
        ]);
    }

    // Rendering the specific id page
    public function show($id)
    {
        $categories = $this->categoriesService->getcategoriesById($id);

        return view('category.show', [
            'categories' => $categories
        ]);
    }

    // Initiating the create process and Rendering the create form
    public function create()
    {
        $userId = Auth::user()->id;

        return view('category.create', [
            'userId' => $userId
        ]);
    }

    // Storing incoming data from form to db
    public function store(Request $request)
    {
        // dd(request()->all());
        // Backend validation of attributes
        $validateAttributes = request()->validate([
            'user_id' => ['required', 'integer'],
            'category_name' => ['required', 'min:3'],
            'description' => ['required'],
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handling file type data
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');

            $validateAttributes['image_path'] = $imagePath;
        }

        $this->categoriesService->createCategory($validateAttributes);

        // Session Message
        session()->flash('success', 'Category Created Successfully');

        // Redirecting upon successful storage 
        return redirect()->route('category.index');
    }

    // Initiating the edit process and Rendering the edit form
    public function edit($id)
    {
        $categories = $this->categoriesService->getcategoriesById($id);

        return view('category.edit', [
            'categories' => $categories
        ]);
    }

    // Updating incoming data from form to db
    public function update(Request $request, $id)
    {
        // Backend validation of attributes
        $validateAttributes = $request->validate([
            'category_name' => ['required', 'min:3'],
            'description' => ['required'],
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handling file type data
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');

            $validateAttributes['image_path'] = $imagePath;
        }

        $this->categoriesService->updateCategory($id, $validateAttributes);

        // Session Message
        session()->flash('success', 'Category Updated Successfully');

        // Redirecting upon successful update
        return redirect()->route('category.index');
    }

    // Searching category records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');
        $perPage = 10; // Match pagination count

        // Querying the database for matching category records
        $categories = Category::query()
            ->where(function ($query) use ($search) {
                $query->where('category_name', 'iLIKE', "%{$search}%")  // Case-insensitive search
                    ->orWhere('description', 'iLIKE', "%{$search}%");   // Partial match in description
            })
            ->paginate($perPage);

        // Calculate result range
        $total = $categories->total();
        $currentPage = $categories->currentPage();
        $start = ($currentPage - 1) * $perPage + 1;
        $end = min($currentPage * $perPage, $total);

        return view('category.index', [
            'categories' => $categories,
            'resultInfo' => [
                'total' => $total,
                'start' => $start,
                'end' => $end,
                'searchTerm' => $search
            ],
            'noRecordsFound' => $categories->isEmpty() // No records flag
        ]);
    }

    // Delete function
    public function destroy($id)
    {
        $this->categoriesService->deleteCategory($id);

        // Redirecting upon successful deletion
        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }
}
