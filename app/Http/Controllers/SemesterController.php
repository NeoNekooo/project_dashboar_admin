<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::all();
        return view('semesters.index', compact('semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        // Deactivate all other semesters if this one is being activated
        if ($request->has('activate') && $request->activate == 'true') {
            Semester::where('id', '!=', $semester->id)->update(['is_active' => false]);
            $semester->update(['is_active' => true]);
            return redirect()->route('semesters.index')->with('success', 'Semester ' . $semester->name . ' berhasil diaktifkan.');
        }

        // Deactivate this semester
        if ($request->has('deactivate') && $request->deactivate == 'true') {
            $semester->update(['is_active' => false]);
            return redirect()->route('semesters.index')->with('success', 'Semester ' . $semester->name . ' berhasil dinonaktifkan.');
        }

        return redirect()->route('semesters.index')->with('error', 'Aksi tidak valid.');
    }
}