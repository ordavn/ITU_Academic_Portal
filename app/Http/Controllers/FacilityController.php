<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display the facilities page (Student View).
     * Accessible by: All users
     * Route: GET /facilities
     */
    public function showPage()
    {
        $facilities = Facility::all();
        
        return Inertia::render('Facilities', [
            'facilities' => $facilities,
        ]);
    }

    /**
     * Display the admin facilities management page.
     * Accessible by: Authenticated users (with admin middleware if needed)
     * Route: GET /admin/facilities
     */
    public function adminPage()
    {
        return Inertia::render('Admin/FacilitiesAdmin');
    }

    /**
     * Display a listing of the facilities.
     * Accessible by: Students (Read-only) and Admins
     * Route: GET /api/facilities
     */
    public function index()
    {
        $facilities = Facility::all();
        
        return response()->json($facilities, 200);
    }

    /**
     * Store a newly created facility in the database.
     * Accessible by: Admins
     * Route: POST /api/facilities
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            'building'          => 'required|string|max:255',
            'description'       => 'nullable|string',
            'location'          => 'required|string|max:255',
            'capacity'          => 'nullable|integer',
            'operational_hours' => 'nullable|string|max:255',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('facilities', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $facility = Facility::create($validatedData);

        return response()->json([
            'message' => 'Facility created successfully!',
            'data'    => $facility
        ], 201);
    }

    /**
     * Display the specified facility.
     * Route: GET /api/facilities/{id}
     */
    public function show($id)
    {
        $facility = Facility::findOrFail($id);
        
        return response()->json($facility, 200);
    }

    /**
     * Update the specified facility in the database.
     * Accessible by: Admins
     * Route: PUT /api/facilities/{id}
     */
    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        $validatedData = $request->validate([
            'name'              => 'sometimes|required|string|max:255',
            'building'          => 'sometimes|required|string|max:255',
            'description'       => 'nullable|string',
            'location'          => 'sometimes|required|string|max:255',
            'capacity'          => 'nullable|integer',
            'operational_hours' => 'nullable|string|max:255',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($facility->image_path && Storage::disk('public')->exists($facility->image_path)) {
                Storage::disk('public')->delete($facility->image_path);
            }
            
            $image = $request->file('image');
            $imagePath = $image->store('facilities', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $facility->update($validatedData);

        return response()->json([
            'message' => 'Facility updated successfully!',
            'data'    => $facility
        ], 200);
    }

    /**
     * Remove the specified facility from the database.
     * Accessible by: Admins
     * Route: DELETE /api/facilities/{id}
     */
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return response()->json([
            'message' => 'Facility deleted successfully!'
        ], 200);
    }
}