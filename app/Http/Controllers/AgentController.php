<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Inquiry;

class AgentController extends Controller
{
    public function dashboard()
    {
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
    }
    public function indexProperty(){
        $properties = Property::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('agent.properties.index', compact('properties'));
    }
    public function showProperty($id)
    {
        $property = Property::with('user')->findOrFail($id);
        return view('agent.properties.show', compact('property'));
    }
    public function add(){
        return view('agent.properties.add');
    }
    public function store(Request $request)
    {
        $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:properties,slug',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'purpose' => 'required|in:sale,rent',
                'type' => 'required|in:apartment,villa,house,land,commercial',
                'status' => 'required|in:available,sold,rented',
                'area' => 'nullable|numeric',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'zip' => 'nullable|string|max:20',
                // 'is_featured' => 'nullable|boolean',
                // 'is_published' => 'nullable|boolean',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        if (empty($request['slug'])) {
            $request['slug'] = Str::slug($request['title']);
            
            $count = Property::where('slug', $request['slug'])->count();
            if ($count > 0) {
                $request['slug'] = $request['slug'] . '-' . ($count + 1);
            }
        }
        $property = new Property();
        $property->user_id = auth()->id();
        $property->title = $request['title'];
        $property->slug = $request['slug'];
        $property->description = $request['description'];
        $property->price = $request['price'];
        $property->purpose = $request['purpose'];
        $property->type = $request['type'];
        $property->status = $request['status'];
        $property->area = $request['area'];
        $property->address = $request['address'];
        $property->city = $request['city'];
        $property->state = $request['state'];
        $property->zip = $request['zip'];
        // $property->is_featured = $request->has('is_featured') ? 1 : 0;
        // $property->is_published = $request->has('is_published') ? 1 : 0;
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time();
            $image->move(public_path('images/properties'), $imageName);
            $property->main_image = 'images/properties/' . $imageName;
        }
        $property->save();
        return redirect()->route('agent.properties.index')->with('success', 'Property added successfully.');
    }
    public function editProperty($id)
    {
        $property = Property::findOrFail($id);
        return view('agent.properties.edit', compact('property'));
    }
    public function updateProperty(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'purpose' => 'required|in:sale,rent',
            'type' => 'required|in:apartment,villa,house,land,commercial',
            'status' => 'required|in:available,sold,rented',
            'area' => 'nullable|numeric',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'nullable|string|max:20',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if (empty($request['slug'])) {
            $request['slug'] = Str::slug($request['title']);
            
            $count = Property::where('slug', $request['slug'])->where('id', '!=', $id)->count();
            if ($count > 0) {
                $request['slug'] = $request['slug'] . '-' . ($count + 1);
            }
        }
        $property = Property::findOrFail($id);
        $property->title = $request['title'];
        $property->slug = $request['slug']; 
        $property->description = $request['description'];
        $property->price = $request['price'];
        $property->purpose = $request['purpose'];
        $property->type = $request['type'];
        $property->status = $request['status'];
        $property->area = $request['area'];
        $property->address = $request['address'];
        $property->city = $request['city'];
        $property->state = $request['state'];
        $property->zip = $request['zip'];
        $property->is_featured = $request->has('is_featured') ? 1 : 0;
        $property->is_published = $request->has('is_published') ? 1 : 0;
        if ($request->hasFile('main_image')) {
            if ($property->main_image && file_exists(public_path($property->main_image))) {
                unlink(public_path($property->main_image));
            }
            $image = $request->file('main_image');
            $imageName = time() . '_' . str_replace(' ', '_', $image->getClientOriginalName());
            $image->move(public_path('images/properties'), $imageName);
            $property->main_image = 'images/properties/' . $imageName;
        }
        $property->save();
        return redirect()->route('agent.properties.index')->with('success', 'Property updated successfully.');
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        if ($property->main_image && file_exists(public_path($property->main_image))) {
            unlink(public_path($property->main_image));
        }
        $property->delete();
        return redirect()->route('agent.properties.index')->with('success', 'Property deleted successfully.');
    }

    
    public function index()
    {
        $inquiries = Inquiry::with('property')->orderBy('created_at', 'desc')->paginate(5);
        return view('agent.inquiries.index', compact('inquiries'));
    }
    public function show($id)
    {
        $inquiry = Inquiry::with('property')->findOrFail($id);
        return view('agent.inquiries.show', compact('inquiry'));
    }
    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        echo "hello"; die;
        $request->validate([
            'status' => 'required|in:new,read,replied',
        ]);

        $inquiry->status = $request->status;
        $inquiry->save();

        return back()->with('success', '✅ Status updated to ' . ucfirst($request->status) . '!');
    }
    public function destroyInquiry(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('agent.inquiries.index')
            ->with('success', 'Inquiry deleted successfully!');
    }
}
