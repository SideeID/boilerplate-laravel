<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLowonganRequest;
use App\Http\Requests\UpdateLowonganRequest;
use App\Services\MasterLowonganService;
use App\Repositories\MasterDepartemenRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function __construct(
        private MasterLowonganService $service,
        private MasterDepartemenRepository $departemenRepository
    ) {}

    public function index(): View
    {
        $lowongans = $this->service->getAllPaginated(10);
        $departemens = $this->departemenRepository->getAll();
        return view('pages.admin.lowongan.index', compact('lowongans', 'departemens'));
    }

    public function create(): View
    {
        $departemens = $this->departemenRepository->getAll();
        return view('pages.admin.lowongan.create', compact('departemens'));
    }

    public function store(StoreLowonganRequest $request): RedirectResponse
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route('admin.lowongan.index')
                ->with('success', 'Lowongan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit(int $id): View
    {
        $lowongan = $this->service->findById($id);
        $departemens = $this->departemenRepository->getAll();
        return view('pages.admin.lowongan.edit', compact('lowongan', 'departemens'));
    }

    public function update(UpdateLowonganRequest $request, int $id): RedirectResponse
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()
                ->route('admin.lowongan.index')
                ->with('success', 'Lowongan berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()
                ->route('admin.lowongan.index')
                ->with('success', 'Lowongan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
