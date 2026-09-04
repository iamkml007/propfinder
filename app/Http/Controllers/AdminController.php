<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Inquiry;


class AdminController extends Controller
{
    public function dashboard()
    {
        // ==========================================
        // 1. STATS
        // ==========================================
        $stats = [
            'totalUsers' => User::count(),
            'newUsers' => User::where('created_at', '>=', now()->subDays(7))->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_agents' => User::where('role', 'agent')->count(),
            'total_clients' => User::where('role', 'user')->count(),
            'active_users' => User::where('status', 'active')->count(),
            'total_properties' => Property::count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
            'featured_properties' => Property::where('is_featured', true)->count(),
        ];

        // ==========================================
        // 2. RECENT PROPERTIES (Latest 5)
        // ==========================================
        $recentProperties = Property::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($property) {
                return [
                    'id' => $property->id,
                    'title' => $property->title,
                    'slug' => $property->slug,
                    'price' => $property->price,
                    'status' => $property->status,
                    'purpose' => $property->purpose,
                    'type' => $property->type,
                    'city' => $property->city,
                    'state' => $property->state,
                    'main_image' => $property->main_image,
                    'is_featured' => $property->is_featured,
                    'created_at' => $property->created_at,
                    'agent_name' => $property->user ? $property->user->name : 'N/A',
                ];
            });

        // ==========================================
        // 3. RECENT INQUIRIES (Latest 5)
        // ==========================================
        $recentInquiries = Inquiry::with(['property', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($inquiry) {
                return [
                    'id' => $inquiry->id,
                    'name' => $inquiry->name,
                    'email' => $inquiry->email,
                    'phone' => $inquiry->phone,
                    'message' => $inquiry->message,
                    'status' => $inquiry->status,
                    'property_title' => $inquiry->property ? $inquiry->property->title : 'N/A',
                    'created_at' => $inquiry->created_at,
                ];
            });

        // ==========================================
        // 4. RECENT USERS (Latest 5)
        // ==========================================
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentProperties', 'recentInquiries', 'recentUsers'));
    }
    public function allUsers()
    {
        $users = User::where('role','user')->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.users.index', compact('users'));
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,agent,client',
            'status' => 'required|in:active,pending,inactive',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
    public function allAgents()
    {
        $agents = User::where('role','agent')->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.agent.index', compact('agents'));
    }
    public function showAgent($id)
    {
        $agent = User::findOrFail($id);
        return view('admin.agent.show', compact('agent'));
    }
    public function editAgent($id)
    {
        $agent = User::findOrFail($id);
        return view('admin.agent.edit', compact('agent'));
    }
    public function updateAgent(Request $request, $id)
    {
        $agent = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'role' => 'required|in:admin,agent,user',
            'status' => 'required|in:active,pending,suspended',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($agent->photo && file_exists(public_path($agent->photo))) {
                unlink(public_path($agent->photo));
            }
            
            $photo = $request->file('photo');
            $photoName = time() . '_' . Str::slug($agent->name) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/agents'), $photoName);
            $validated['photo'] = 'images/agents/' . $photoName;
        }

        $agent->update($validated);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent "' . $agent->name . '" updated successfully!');
    }
     public function deleteAgent($id)
        {
            $agent = User::where('role', 'agent')->findOrFail($id);
            
            if ($agent->id === auth()->id()) {
                return back()->with('error', 'You cannot delete your own account!');
            }
            
            if ($agent->photo && file_exists(public_path($agent->photo))) {
                unlink(public_path($agent->photo));
            }
            
            $agent->delete();

            return redirect()->route('admin.agents.index')
                ->with('success', 'Agent "' . $agent->name . '" deleted successfully!');
        }

}
