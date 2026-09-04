<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('user')->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.properties.index', compact('properties'));
    }
    public function add()
    {
        return view('admin.properties.add');
    }
    public function show($id)
    {
        $property = Property::with('user')->findOrFail($id);
        return view('admin.properties.show', compact('property'));
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
        return redirect()->route('admin.properties.index')->with('success', 'Property added successfully.');
    }
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('admin.properties.edit', compact('property'));
    }
    public function update(Request $request, $id)
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
        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        if ($property->main_image && file_exists(public_path($property->main_image))) {
            unlink(public_path($property->main_image));
        }
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}
