<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class AdminSuccessStoryController extends Controller
{
    public function index()
    {
        $stories = SuccessStory::latest()->paginate(8);
        return view('admin.success-story.index', compact('stories'));
    }

    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'testimonial' => 'nullable|string',
            'is_active' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // ✅ Create new Brand
        $story = new SuccessStory();
        $story->name = $validated['name'];
        $story->role = $validated['role'];
        $story->company = $validated['company'];
        $story->testimonial = $validated['testimonial'] ?? null;
        $story->is_active = $validated['is_active'];

        // ✅ Handle photo upload with public URL
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/story');

            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Move file
            $file->move($destinationPath, $filename);

            // Save full public URL
            $story->photo = url('uploads/story/' . $filename);
        }

        // ✅ Save the success story
        $story->save();

        // ✅ Redirect with success notification
        return redirect()->route('admin.successStories.index')
            ->with('success', '🎉 Success Story "' . $story->name . '" has been added successfully!');
    }


        public function destroy($id)
{
    $story = SuccessStory::findOrFail($id);

    // Optionally delete image files if you store them locally
    if ($story->photo && file_exists(public_path('storage/' . $story->photo))) {
        unlink(public_path('storage/' . $story->photo));
    }
    $story->delete();

    return redirect()->route('admin.successStories.index')->with('success', 'testimonial deleted successfully!');
}

public function edit($id)
    {
        $story = SuccessStory::findOrFail($id);
        return view('admin.success-story.edit', compact('story'));
    }

       public function update(Request $request, $id)
{
    $brand = SuccessStory::findOrFail($id);

    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'testimonial' => 'nullable|string',
            'is_active' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
    ]);

    // Update basic fields
    $brand->name = $request->name;
    $brand->role = $request->role;
    $brand->company = $request->company;
    $brand->is_active = $request->is_active;
    $brand->testimonial = $request->testimonial;
    $brand->photo = $request->photo;

    // Handle photo upload as public URL
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time().'_'.$file->getClientOriginalName();
        $destinationPath = public_path('uploads/brands');
        $file->move($destinationPath, $filename);

        // Save the public URL
        $brand->photo = url('uploads/brands/'.$filename);
    }

    $brand->save();

    return redirect()->route('admin.brand.index')
                     ->with('success', 'Brand updated successfully!');
}
}
