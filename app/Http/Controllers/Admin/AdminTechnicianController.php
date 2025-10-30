<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTechnicianController extends Controller
{
    public function index()
    {
        $technicians = Technician::with('user')->latest()->paginate(10);
        return view('admin.technicians.index', compact('technicians'));
    }

    public function create()
    {
        $users = User::doesntHave('technician')->get(); // Only users who are not yet technicians
        return view('admin.technicians.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:technicians,user_id',
            'employee_code' => 'required|unique:technicians,employee_code',
            'specialization' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'certification_no' => 'nullable|string|max:255',
            'service_area' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Technician::create($request->all());

        return redirect()->route('admin.technicians.index')->with('success', 'Technician added successfully.');
    }

    public function edit(Technician $technician)
    {
        $users = User::all();
        return view('admin.technicians.edit', compact('technician', 'users'));
    }

    public function update(Request $request, Technician $technician)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:technicians,user_id,' . $technician->id,
            'employee_code' => 'required|unique:technicians,employee_code,' . $technician->id,
            'specialization' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'certification_no' => 'nullable|string|max:255',
            'service_area' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $technician->update($request->all());

        return redirect()->route('admin.technicians.index')->with('success', 'Technician updated successfully.');
    }

    public function destroy(Technician $technician)
    {
        $technician->delete();

        return redirect()->route('admin.technicians.index')->with('success', 'Technician deleted successfully.');
    }
}
