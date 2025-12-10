<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MasterDepartemenRepository;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        private MasterDepartemenRepository $departemenRepository
    ) {}

    public function index(): View
    {
        $departemens = $this->departemenRepository->getAllWithLowonganStats();

        $reportData = $departemens->map(function ($departemen) {
            $totalQuota = 0;
            $totalPendaftar = 0;
            $totalDiterima = 0;
            $totalDitolak = 0;
            $totalPending = 0;

            foreach ($departemen->lowongans as $lowongan) {
                $totalQuota += $lowongan->quota;
                $totalPendaftar += $lowongan->pendaftarans_count;
                $totalDiterima += $lowongan->accepted_count;
                $totalDitolak += $lowongan->rejected_count;
                $totalPending += $lowongan->pending_count;
            }

            $sisaQuota = $totalQuota - $totalDiterima;

            return [
                'departemen' => $departemen->name,
                'total_quota' => $totalQuota,
                'total_pendaftar' => $totalPendaftar,
                'diterima' => $totalDiterima,
                'ditolak' => $totalDitolak,
                'pending' => $totalPending,
                'sisa_quota' => $sisaQuota,
                'lowongans' => $departemen->lowongans
            ];
        });

        return view('pages.admin.report.index', compact('reportData'));
    }
}
