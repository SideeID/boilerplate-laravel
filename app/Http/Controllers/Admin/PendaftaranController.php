<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TransaksiPendaftaranService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function __construct(
        private TransaksiPendaftaranService $service
    ) {}

    public function index(): View
    {
        $pendaftarans = $this->service->getAllPaginated(15);
        $statistics = $this->service->getStatistics();
        return view('pages.admin.pendaftaran.index', compact('pendaftarans', 'statistics'));
    }

    public function approve(int $id): RedirectResponse
    {
        try {
            $this->service->approve($id);
            return redirect()
                ->back()
                ->with('success', 'Pendaftaran berhasil di-approve');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function reject(int $id): RedirectResponse
    {
        try {
            $this->service->reject($id);
            return redirect()
                ->back()
                ->with('success', 'Pendaftaran berhasil di-reject');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function show(int $id): View
    {
        $pendaftaran = $this->service->findById($id);
        return view('pages.admin.pendaftaran.show', compact('pendaftaran'));
    }
}
