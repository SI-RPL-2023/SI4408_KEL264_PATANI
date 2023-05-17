<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MitraWorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::all();
        return view('mitra.workshops.index', compact('workshops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'capacity' => 'required|integer',
            'image' => 'required|image',
        ]);

        // Cek apakah terdapat file gambar yang di-upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('workshop_images'), $filename);
        }

        $workshop = new Workshop([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'capacity' => $request->get('capacity'),
            'image' => $filename,
        ]);

        $workshop->user()->associate(Auth::user());
        $workshop->save();

        return redirect()->route('mitraWorkshops.index')->with('success', 'Workshop created successfully.');
    }

    public function update($id, Request $request)
    {


        // Get the workshop data by id
        $workshop = Workshop::findOrFail($id);

        // Update the workshop data
        $workshop->title = $request->input('title');
        $workshop->description = $request->input('description');
        $workshop->start_time = $request->input('start_time');
        $workshop->end_time = $request->input('end_time');
        $workshop->capacity = $request->input('capacity');

        // Handle image upload if there is a new image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $workshop->image = $imageName;
        }

        // Save the updated workshop data
        $workshop->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Workshop has been updated successfully.');
    }


    public function destroy($id)
    {
        $workshop = Workshop::find($id);

        if (!$workshop) {
            return response()->json([
                'message' => 'Workshop not found.'
            ], 404);
        }

        $workshop->delete();

        return  redirect()->back();
    }
}
