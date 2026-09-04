<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('admin.users.index', compact('users')); 
    }
    public function propertyShow($id)
    {
        echo "Property Show ID: " . $id; die(); // Debugging line to check the ID
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property')); 
    }
}
