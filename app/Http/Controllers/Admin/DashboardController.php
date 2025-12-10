<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TransaksiPendaftaranService;
use App\Services\MasterLowonganService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private TransaksiPendaftaranService $pendaftaranService,
        private MasterLowonganService $lowonganService
    ) {}

    public function index(): View
    {
        $statistics = $this->pendaftaranService->getStatistics();
        $lowongans = $this->lowonganService->getAll();
        $recentPendaftarans = $this->pendaftaranService->getPending();

        return view('pages.admin.dashboard', compact('statistics', 'lowongans', 'recentPendaftarans'));
    }
}
