<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllusers();
        return view('user.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = $this->userService->getuserById($id);

        return view('user.show', [
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // dd(request()->all());
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

        $validated['skills_input'] = implode(
            ',',
            array_filter(array_map('trim', $validated['skills_input']))
        );

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('images', 'public');
        }

        $this->userService->createUser($validated);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // dd(request()->all());
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

        $validated['skills_input'] = implode(
            ',',
            array_filter(array_map('trim', $validated['skills_input']))
        );

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('images', 'public');
        }

        $this->userService->editUser($id, $validated);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->where(function ($query) use ($search) {
                $query->where('name', 'iLIKE', "%{$search}%")
                    ->orWhere('email', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%")
                    ->orWhere('title', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        if ($users->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('user.index', ['users' => $users]);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
