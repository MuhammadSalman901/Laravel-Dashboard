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

    // Search function
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');

        // Using the query() function we can send a search query to match data with db and reteirve it 
        $categories = Category::query()
            ->where(function ($query) use ($search) {
                $query->where('category_name', 'iLIKE', "%{$search}%")  // 'iLIKE' lets you mtach exact data word by word (If you want to add case sensitivity, you can just use 'LIKE')
                    ->orWhere('description', 'iLIKE', "%{$search}%");   // And if we do not want exact matching, you can send the query back without 'LIKE' or 'iLIKE' keyword
            })
            ->paginate(10);

        // Check if no records are found
        $noRecordsFound = $categories->isEmpty();

        return view('category.index', [
            'categories' => $categories,
            'noRecordsFound' => $noRecordsFound, // Pass this flag to the view to append no records found
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
