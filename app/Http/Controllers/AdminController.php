<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function listAdmins()
    {
        $admins = User::where('role', 'admin')->orderBy('id', 'desc')->get();
        return view('admin.management.admin-data', compact('admins'));
    }

    public function listMechanics()
    {
        $mechanics = User::where('role', 'mechanic')->orderBy('id', 'desc')->get();
        return view('admin.management.mechanic-data', compact('mechanics'));
    }

    public function listUsers()
    {
        $role = Auth::user()->role;
        $userId = Auth::id();

        if ($role === "admin") {
            $clients = User::with('repairs')->where('role', 'client')->orderBy('id', 'desc')->get();
            $mechanics = User::where('role', 'mechanic')->orderBy('id', 'desc')->get();
        } elseif ($role === "mechanic") {
            $clients = User::where('role', 'mechanic')->where('id', $userId)->orderBy('id', 'desc')->get();
            $mechanics = User::where('role', 'mechanic')->orderBy('id', 'desc')->get();
        } else {
            $clients = User::with('repairs')->where('role', 'client')->where('id', $userId)->orderBy('id', 'desc')->get();
            $mechanics = User::where('role', 'mechanic')->orderBy('id', 'desc')->get();
        }

        return view('admin.management.users-data', compact('clients', 'mechanics'));
    }

    public function removeUser(Request $request)
    {
        $user = User::find($request->cdeleteId);

        if ($user) {
            $user->delete();
            session()->flash('success', __('User deleted successfully'));
            return "ok";
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function updateUserForm(User $user)
    {
        return view('admin.users.edit-data', compact('user'));
    }

    public function newUser()
    {
        return view('admin.create');
    }

    public function createUser()
    {
        return view('admin.management.add-users');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        session()->flash('success', __('User created successfully'));
        return redirect()->back();
    }

    public function modifyUser(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);

            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'address' => 'required',
                'phoneNumber' => 'required|string',
            ]);

            $user->update($validatedData);
            return redirect()->back();

        } catch (ModelNotFoundException $e) {
            return redirect(route('admin.dashboard'))->with('success', 'User not found');
        } catch (QueryException $e) {
            return back()->withError('Email already exists.')->withInput();
        }
    }

    public function fetchUserDetails(Request $request)
    {
        $userId = $request->input('id');
        $user = User::with(['vehicles', 'repairs', 'repairs.invoices'])->find($userId);

        if ($user) {
            return response()->json($user);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }
}
