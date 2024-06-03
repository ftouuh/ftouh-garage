<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Exports\ClientExport;
use App\Exports\MechanicExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ClientController extends Controller
{
    public function uploadUsers(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));
        } catch (\Exception $e) {
            session()->flash('error', 'Error importing users: ' . $e->getMessage());
            return redirect()->back();
        }
    
        session()->flash('success', 'Users imported successfully');
        return redirect(route('admin.admins'));
    }

    public function exportClients()
    {
        $users = User::where('role', 'client')->get();
        return Excel::download(new ClientExport($users), 'clients.xlsx');
    }

    public function exportMechanics()
    {
        $users = User::where('role', 'mechanic')->get();
        return Excel::download(new MechanicExport($users), 'mechanics.xlsx');
    }
}