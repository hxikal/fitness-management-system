<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EquipmentReportController extends Controller
{
    public function index()
    {
        $reports = EquipmentReport::where('user_id', Auth::guard('web')->id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('equipment-report', compact('reports'));
    }

public function store(Request $request)
{
    $request->validate([
        'equip_name' => 'required',
        'urgency' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // 1. LIMIT CHECK: Prevent too many reports (e.g., max 10)
    $maxReports = 10;
    $userReportCount = EquipmentReport::where('user_id', Auth::guard('web')->id())->count();

    if ($userReportCount >= $maxReports) {
        return back()->with('error', 'Limit reached. Please delete old reports before creating a new one.');
    }

    // 2. CREATE REPORT
    $report = new EquipmentReport();
    $report->user_id = Auth::guard('web')->id();
    $report->equip_name = $request->equip_name;
    $report->urgency = $request->urgency;
    $report->description = $request->description;

   if ($request->hasFile('image')) {

    $file = $request->file('image');

    $filename = time() . '_' . $file->getClientOriginalName();

    $path = $file->storeAs('reports', $filename, 'public');

    $report->image = $path;
}
    $report->status = 'pending';
    $report->save();

    return back()->with('success', 'Report submitted successfully!');
}
public function update(Request $request, $id)
{
    $report = EquipmentReport::findOrFail($id);

    $report->equip_name = $request->equip_name;
   $report->description = $request->description;
    $report->urgency = $request->urgency;

if ($request->hasFile('image')) {

    $path = $request->file('image')->store('reports', 'public');

    $report->image = $path;
}

    $report->save();

    return redirect()->back()->with('success', 'Report updated successfully!');
}
    public function destroy($id)
    {
        $report = EquipmentReport::where('user_id', Auth::guard('web')->id())
            ->where('id', $id)
            ->firstOrFail();

        $report->delete();

        return back()->with('success', 'Laporan berjaya dipadam!');
    }

    public function handleUpdateOrDelete(Request $request, $id)
{
    if ($request->isMethod('put')) {
        return $this->update($request, $id);
    }
    return $this->destroy($id);
}
}
