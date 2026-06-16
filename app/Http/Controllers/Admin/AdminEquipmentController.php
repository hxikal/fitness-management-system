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


  public function update(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|string|in:pending,fixed',
    ]);

    $report = EquipmentReport::findOrFail($id);

    // ✅ only update status (no risk of overwriting anything else)
    $report->status = $validated['status'];

    // ✅ extra safety check (prevents silent overwrite issues)
    if ($report->exists) {
        $report->save();
    }

    return redirect()->route('admin.equipment.index')
                     ->with('success', 'Status updated successfully.');
}

    // ✅ Admin can delete a report if needed
public function destroy($id)
{
    $report = EquipmentReport::find($id);

    if ($report) {
        $report->delete();

        return redirect('admin/equipment-reports')->with('success', 'Deleted successfully');
    }

    return redirect('admin/equipment-reports')->with('error', 'Record already deleted or does not exist.');
}
}
