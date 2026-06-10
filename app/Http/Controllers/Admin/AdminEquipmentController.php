<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EquipmentReport;

class AdminEquipmentController extends Controller
{
    // ✅ Show all equipment reports for admin
public function index()
{
    $reports = \App\Models\EquipmentReport::with('user')
        ->orderBy('created_at', 'desc')
        ->get();

    // ✅ Match your actual file name
    return view('admin.equipments_report', compact('reports'));
}


    // ✅ Admin can update status (pending/fixed)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,fixed',
        ]);

        $report = EquipmentReport::findOrFail($id);
        $report->status = $validated['status'];
        $report->save();

        // Redirect back to the admin equipment page
        return redirect()->route('admin.equipment.index')
                         ->with('success', 'Status updated successfully.');
    }

    // ✅ Admin can delete a report if needed
    public function destroy($id)
    {
        $report = EquipmentReport::findOrFail($id);
        $report->delete();

        return back()->with('success', 'Report deleted.');
    }
}
