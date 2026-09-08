<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Modules\Complaints\Models\Complaints;
use App\Modules\Item_reports\Models\Item_reports;
use App\Modules\report_statuses\Models\report_statuses as ReportStatuses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $statuses = ReportStatuses::query()->pluck('status_name', 'id');
        $reports = collect(Complaints::query()
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->get()
            ->map(function ($report) use ($statuses) {
                return [
                    'type' => 'Pengaduan',
                    'title' => $report->judul,
                    'id' => $report->id,
                    'status' => $statuses[$report->status_id] ?? 'Sedang Diproses',
                    'created_at' => $report->created_at,
                ];
            }))
            ->concat(Item_reports::query()
                ->where('user_id', $user->id)
                ->latest('created_at')
                ->get()
                ->map(function ($report) use ($statuses) {
                    return [
                        'type' => 'Lost & Found',
                        'title' => $report->nama_barang,
                        'id' => $report->id,
                        'status' => $statuses[$report->status_id] ?? 'Sedang Diproses',
                        'created_at' => $report->created_at,
                    ];
                }))
            ->sortByDesc('created_at')
            ->values();

        return view('profile.edit', [
            'user' => $user,
            'reports' => $reports,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->safe()->except('profile_photo')->toArray());

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $user->profile_photo = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
