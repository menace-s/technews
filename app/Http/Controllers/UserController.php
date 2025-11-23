<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors =  User::whereHas('roles', function ($query) {
            $query->where('name', 'author');
            // OU si ta colonne s'appelle différemment :
            // $query->where('role_name', 'author');
        })->get();
        return view('back.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Validate and store the user data
        $validatedData = $request->validated();
        // dd($validatedData);
        $validatedData['password'] = Hash::make('12345678'); // Default password, consider changing this logic
        // dd($validatedData);
        // Assuming you have a User model to handle user data
        User::create($validatedData);

        return redirect()->route('author.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update user data
        $user->update($validatedData);

        return redirect()->route('author.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('author.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
