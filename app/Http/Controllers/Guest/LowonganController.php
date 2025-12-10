<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\MasterLowonganService;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function __construct(
        private MasterLowonganService $service
    ) {}

    public function index(): View
    {
        $lowongans = $this->service->getAllPaginated(12);
        return view('pages.guest.lowongan.index', compact('lowongans'));
    }

    public function show(int $id): View
    {
        $lowongan = $this->service->findById($id);
        return view('pages.guest.lowongan.show', compact('lowongan'));
    }
}
