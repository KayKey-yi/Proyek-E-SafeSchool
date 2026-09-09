<?php

namespace App\Http\Controllers;

use App\Helpers\Permission;
use App\Modules\Complaints\Models\Complaints;
use App\Modules\Item_reports\Models\Item_reports;
use App\Modules\report_statuses\Models\report_statuses as ReportStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function userDashboard()
    {
        $userId = Auth::id();
        $statuses = ReportStatuses::query()->pluck('status_name', 'id');
        $complaints = Complaints::query()->where('user_id', $userId)->latest('created_at')->get();
        $itemReports = Item_reports::query()->where('user_id', $userId)->latest('created_at')->get();
        $finishedStatuses = ['selesai', 'dikembalikan', 'ditemukan'];

        $activities = collect($complaints->map(function ($report) use ($statuses) {
            return [
                'type' => 'Pengaduan',
                'title' => $report->judul,
                'status' => $statuses[$report->status_id] ?? 'Diproses',
                'created_at' => $report->created_at,
            ];
        })->all())->concat($itemReports->map(function ($report) use ($statuses) {
            return [
                'type' => 'Lost & Found',
                'title' => $report->nama_barang,
                'status' => $statuses[$report->status_id] ?? 'Diproses',
                'created_at' => $report->created_at,
            ];
        })->all())->sortByDesc('created_at')->values();

        $isFinished = function ($report) use ($statuses, $finishedStatuses) {
            return in_array(strtolower($statuses[$report->status_id] ?? ''), $finishedStatuses, true);
        };

        return view('user.dashboard', [
            'complaintsCount' => $complaints->count(),
            'itemsCount' => $itemReports->count(),
            'finishedCount' => $complaints->filter($isFinished)->count() + $itemReports->filter($isFinished)->count(),
            'activities' => $activities,
        ]);
    }

    public function userNotifications()
    {
        $userId = Auth::id();
        $statuses = ReportStatuses::query()->pluck('status_name', 'id');

        $notifications = collect(Complaints::query()
            ->where('user_id', $userId)
            ->latest('created_at')
            ->get()
            ->map(function ($report) use ($statuses) {
                return [
                    'category' => 'pengaduan',
                    'label' => 'PENGADUAN',
                    'message' => 'Laporan baru: '.$report->judul,
                    'status' => $statuses[$report->status_id] ?? 'Sedang Diproses',
                    'created_at' => $report->created_at,
                ];
            }))
            ->concat(Item_reports::query()
                ->where('user_id', $userId)
                ->latest('created_at')
                ->get()
                ->map(function ($report) use ($statuses) {
                    return [
                        'category' => 'lostfound',
                        'label' => 'LOST & FOUND',
                        'message' => 'Laporan baru: '.$report->nama_barang,
                        'status' => $statuses[$report->status_id] ?? 'Sedang Diproses',
                        'created_at' => $report->created_at,
                    ];
                }))
            ->sortByDesc('created_at')
            ->values();

        return view('user.notifications', compact('notifications'));
    }

    public function changeRole($id_role)
    {
        $user = Auth::user();

        // get user's role
        $roles = Permission::getRole($user->id);
        if($roles->count() == 0) abort(403);
        $active_role = $roles->where('id', $id_role)->first()->only(['id', 'role']);

        // get user's menu
        $menus = Permission::getMenu($active_role);

        // get user's privilege
        $privileges = Permission::getPrivilege($active_role);
        $privileges = $privileges->mapWithKeys(function ($item, $key) {
                            return [$item['module'] => $item->only(['create', 'read', 'update', 'delete', 'show_menu'])];
                        });

        // store to session
        session(['menus' => $menus]);
        session(['roles' => $roles->pluck('role', 'id')->all()]);
        session(['privileges' => $privileges->all()]);
        session(['active_role' => $active_role]);

        return redirect()->route('dashboard')->with('message_success', 'Berhasil memperbarui role/session sebagai '.$active_role['role']);
    }

    public function forceLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
