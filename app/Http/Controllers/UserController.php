<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function agents(){
        $agents = User::where('role', 'agent')->get();
        return view('agents', compact('agents'));
    }
    public function dashboard(){
        if(Auth::check() && Auth::user()){
            if(Auth::check() && Auth::user()->role === 'admin'){
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


                $recentUsers = User::latest()
                    ->take(5)
                    ->get();

                return view('admin.dashboard', compact('stats', 'recentProperties', 'recentInquiries', 'recentUsers'));
            }elseif(Auth::check() && Auth::user()->role === 'agent'){

            $agent = Auth::user();
            $agentId = $agent->id;

            $stats = [
                'total_properties' => Property::where('user_id', $agentId)->count(),
                'total_inquiries' => Inquiry::whereHas('property', function($query) use ($agentId) {
                    $query->where('user_id', $agentId);
                    })->count(),
            ];
            $recentProperties = Property::where('user_id', $agentId)
                ->with('user')
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
            $recentInquiries = Inquiry::whereHas('property', function($query) use ($agentId) {
                $query->where('user_id', $agentId);
                })
                ->with(['property', 'user'])
                ->latest()
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
            return view('agent.dashboard', compact('stats','recentInquiries','recentProperties'));
                return view('agent.dashboard');
            }else{
                return view('dashboard');
            }
        }
    }
    public function home()
    {
        $properties = Property::where('is_featured', 1)->get();
        return view('home', compact('properties'));
    }
    public function allProperties(){
        $ftproperties = Property::where('is_featured', 1)->get();
        $properties = Property::where('is_featured', 0)
            ->where('is_published', 1)
            ->latest()
            ->get();

        return view('properties.index', compact('ftproperties','properties'));
    }
    public function propertyShow($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property')); 
    }
}
