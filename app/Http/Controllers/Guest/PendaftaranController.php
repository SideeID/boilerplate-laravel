<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendaftaranRequest;
use App\Services\TransaksiPendaftaranService;
use App\Services\MasterLowonganService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function __construct(
        private TransaksiPendaftaranService $service,
        private MasterLowonganService $lowonganService
    ) {}

    public function create(int $lowonganId): View
    {
        $lowongan = $this->lowonganService->findById($lowonganId);
        return view('pages.guest.pendaftaran.create', compact('lowongan'));
    }

    public function store(StorePendaftaranRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['id_user'] = Auth::id();

            $this->service->create($data);
            return redirect()
                ->route('guest.lowongan.index')
                ->with('success', 'Pendaftaran berhasil dikirim. Silakan tunggu proses seleksi.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function myPendaftaran(): View
    {
        $pendaftarans = $this->service->getByUserIdPaginated(Auth::id(), 10);
        return view('pages.guest.pendaftaran.history', compact('pendaftarans'));
    }
}
