<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userService;

    // Constructor for dependency injection of UserService
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Rendering the user listing page
    public function index()
    {
        $users = $this->userService->getAllusers();
        $noRecordsFound = false;

        return view('user.index', [
            'users' => $users,
            'noRecordsFound' => $noRecordsFound,
        ]);
    }

    // Rendering the specific user details page
    public function show($id)
    {
        $user = $this->userService->getuserById($id);

        return view('user.show', [
            'user' => $user
        ]);
    }

    // Initiating the create process and Rendering the user creation form
    public function create()
    {
        return view('user.create');
    }

    // Storing incoming user data from the form to the database
    public function store(Request $request)
    {
        // Backend validation of user attributes
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'title' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required'],
            'address' => ['required'],
            'skills_input' => ['required', 'array'],
            'skills_input.*' => ['string', 'max:255'],
            'experience' => ['required', 'integer', 'min:1'],
            'image_path' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'bio' => ['required']
        ]);

        // Processing skills array and image upload
        $validated['skills_input'] = implode(
            ',',
            array_filter(array_map('trim', $validated['skills_input']))
        );

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('images', 'public');
        }

        // Creating the user using the service layer
        $this->userService->createUser($validated);

        // Session Message
        session()->flash('success', 'User Created Successfully');

        // Redirecting upon successful storage
        return redirect()->route('user.index');
    }

    // Initiating the edit process and Rendering the user edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    // Updating incoming user data from the form to the database
    public function update(Request $request, $id)
    {
        // Backend validation of updated user attributes
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'title' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['required'],
            'address' => ['required'],
            'skills_input' => ['required', 'array'],
            'skills_input.*' => ['string', 'max:255'],
            'experience' => ['required', 'integer', 'min:1'],
            'image_path' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'bio' => ['required']
        ]);

        // Processing skills array and image upload
        $validated['skills_input'] = implode(
            ',',
            array_filter(array_map('trim', $validated['skills_input']))
        );

        // Handling password hashing
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('images', 'public');
        }

        // Updating the user using the service layer
        $this->userService->editUser($id, $validated);

        // Session Message
        session()->flash('success', 'User Updated Successfully');

        // Redirecting upon successful update
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    // Searching user records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');

        // Querying the database for matching user records
        $users = User::query()
            ->where(function ($query) use ($search) {
                $query->where('name', 'iLIKE', "%{$search}%")
                    ->orWhere('email', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%")
                    ->orWhere('title', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        // Check if no records are found
        $noRecordsFound = $users->isEmpty();

        // Rendering the user index page with search results
        return view('user.index', [
            'users' => $users,
            'noRecordsFound' => $noRecordsFound, // Pass this flag to the view to append no records found
        ]);
    }

    // Deleting a user record
    public function destroy($id)
    {
        // Deleting the user using the service layer
        $this->userService->deleteUser($id);

        // Redirecting upon successful deletion
        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
