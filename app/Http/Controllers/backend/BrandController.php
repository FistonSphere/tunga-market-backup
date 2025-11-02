<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
   public function index(){

    $brands=Brand::paginate(1);
    return view('admin.brand.index', compact('brands'));
   }

 public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // ✅ Create new Brand
        $brand = new Brand();
        $brand->name = $validated['name'];
        $brand->description = $validated['description'] ?? null;

        // ✅ Handle logo upload with public URL
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/brands');
            
            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Move file
            $file->move($destinationPath, $filename);

            // Save full public URL
            $brand->logo = url('uploads/brands/' . $filename);
        }

        // ✅ Save the brand
        $brand->save();

        // ✅ Redirect with success notification
        return redirect()->route('admin.brand.index')
            ->with('success', '🎉 Brand "' . $brand->name . '" has been added successfully!');
    }

      public function destroy($id)
{
    $brand = Brand::findOrFail($id);

    // Optionally delete image files if you store them locally
    if ($brand->logo && file_exists(public_path('storage/' . $brand->logo))) {
        unlink(public_path('storage/' . $brand->logo));
    }
    $brand->delete();

    return redirect()->route('admin.brand.index')->with('success', 'brand deleted successfully!');
}

public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
{
    $brand = Brand::findOrFail($id);

    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Update basic fields
    $brand->name = $request->name;
    $brand->description = $request->description;
    $brand->logo = $request->logo;

    // Handle logo upload as public URL
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = time().'_'.$file->getClientOriginalName();
        $destinationPath = public_path('uploads/brands');
        $file->move($destinationPath, $filename);

        // Save the public URL
        $brand->logo = url('uploads/brands/'.$filename);
    }

    $brand->save();

    return redirect()->route('admin.brand.index')
                     ->with('success', 'Brand updated successfully!');
}
}
