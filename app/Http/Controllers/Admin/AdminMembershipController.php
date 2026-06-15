<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminMembershipController extends Controller
{
    // Show membership list
     public function index()
    {
        $members = User::where('role', 'user')->get();

        $walkInMembers = User::where('role', 'user')
            ->where('type', 'walk-in')
            ->get();

        $monthlyMembers = User::where('role', 'user')
            ->where('type', 'monthly')
            ->get();

        $annuallyMembers = User::where('role', 'user')
    ->where('type', 'annually')
    ->get();

       return view('admin.membership.index', compact(
    'members',
    'walkInMembers',
    'monthlyMembers',
    'annuallyMembers'
));
    }

  public function scanMember($id)
{
    $member = User::findOrFail($id);

    // Semak ada payment Paid
    $hasPaidPayment = \App\Models\Payment::where('user_id', $id)
                        ->where('status', 'Paid')
                        ->exists();

    if ($hasPaidPayment && $member->is_active != 1) {
        // Aktifkan membership semasa scan
        $member->update([
            'is_active'          => 1,
            'membership_expiry'  => now()->addMonth(),
         
        ]);
    }

    $isActive = $member->fresh()->is_active == 1
                && $member->fresh()->membership_expiry >= now()->toDateString();

    return view('admin.scan-result', compact('member', 'isActive'));
}

    // Verify membership (activate manually)
public function verify($id)
{
    $user = User::findOrFail($id);

    $user->is_active = 1;
    $user->membership_start = now();

    $type = strtolower(trim($user->type ?? ''));

    if ($type === 'monthly') {
        $user->membership_expiry = now()->addMonth();
    } elseif ($type === 'annually' || $type === 'annual') {
        $user->membership_expiry = now()->addYear();
    } else {
        // empty type, or walk-in
        $user->type = 'walk-in';
        $user->membership_expiry = now()->endOfDay();
    }

    $user->save();

    return back()->with('success', 'Verified');
}



    // Delete membership
    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'Deleted');
    }

    // Activate membership via QR scan
    public function activateMembership($id)
    {
        $member = User::findOrFail($id);

        $member->is_active = 1;
        $member->membership_start = now();
        
        // PEMBAIKAN UTAMA: Kemas kini tarikh luput secara dinamik mengikut jenis keahlian yang didaftarkan
        $memberType = strtolower(trim($member->type ?? ''));
        
        if ($memberType === 'monthly') {
            $member->membership_expiry = now()->addMonth();
        } elseif ($memberType === 'annually' || $memberType === 'annual') {
            $member->membership_expiry = now()->addYear();
        } else {
            // Jika semasa register jenisnya kosong/null, kita tetapkan pelan asas 'walk-in'
            $member->type = 'walk-in';
            $member->membership_expiry = now()->endOfDay();
        }
        
        $member->save();

        return redirect()->route('admin.members.index')
                         ->with('status', 'Membership activated successfully!');
    }

    // Renew expired membership (monthly or walk-in)
    public function renewMembership($id)
    {
        $member = User::findOrFail($id);

        // Flip back to active
        $member->is_active = 1;
        $member->membership_start = now();

        // PEMBAIKAN UTAMA: Tambah sokongan pelan 'annually' semasa pembaharuan (Renew) dibuat
        $memberType = strtolower(trim($member->type ?? ''));

        if ($memberType === 'monthly') {
            $member->membership_expiry = now()->addDays(30);
        } elseif ($memberType === 'annually' || $memberType === 'annual') {
            $member->membership_expiry = now()->addDays(365);
        } else {
            $member->type = 'walk-in';
            $member->membership_expiry = now()->endOfDay();
        }

        $member->save();

        return redirect()->route('admin.members.index')
                         ->with('success', 'Membership renewed successfully!');
    }

    // Route alias for admin.members.renew
    public function renew($id)
    {
        return $this->renewMembership($id);
    }
}