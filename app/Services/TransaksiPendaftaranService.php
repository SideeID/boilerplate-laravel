<?php

namespace App\Services;

use App\Repositories\TransaksiPendaftaranRepository;
use App\Repositories\MasterLowonganRepository;
use App\Models\TransaksiPendaftaran;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class TransaksiPendaftaranService
{
    public function __construct(
        private TransaksiPendaftaranRepository $repository,
        private MasterLowonganRepository $lowonganRepository
    ) {}

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->getAllPaginated($perPage);
    }

    public function getByUserIdPaginated(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->getByUserIdPaginated($userId, $perPage);
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function findById(int $id): ?TransaksiPendaftaran
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): TransaksiPendaftaran
    {
        if ($data['ipk'] < 0 || $data['ipk'] > 4.00) {
            throw new \Exception('IPK harus antara 0.00 - 4.00');
        }

        $lowongan = $this->lowonganRepository->findById($data['id_lowongan']);
        if (!$lowongan) {
            throw new \Exception('Lowongan tidak ditemukan');
        }

        if (isset($data['cv_file'])) {
            $file = $data['cv_file'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('cv', $filename, 'public');
            $data['path_cv'] = $path;
            unset($data['cv_file']);
        }

        $data['status'] = 'P';

        return $this->repository->create($data);
    }

    public function approve(int $id): bool
    {
        $pendaftaran = $this->repository->findById($id);

        if (!$pendaftaran) {
            throw new \Exception('Pendaftaran tidak ditemukan');
        }

        if (!$this->lowonganRepository->checkQuotaAvailable($pendaftaran->id_lowongan)) {
            throw new \Exception('Kuota lowongan sudah penuh');
        }

        return $this->repository->updateStatus($id, 'A');
    }

    public function reject(int $id): bool
    {
        $pendaftaran = $this->repository->findById($id);

        if (!$pendaftaran) {
            throw new \Exception('Pendaftaran tidak ditemukan');
        }

        return $this->repository->updateStatus($id, 'R');
    }

    public function getPending(): Collection
    {
        return $this->repository->getPending();
    }

    public function getAccepted(): Collection
    {
        return $this->repository->getAccepted();
    }

    public function getRejected(): Collection
    {
        return $this->repository->getRejected();
    }

    public function getByStatus(string $status): Collection
    {
        return $this->repository->getByStatus($status);
    }

    public function getStatistics(): array
    {
        return [
            'total' => $this->repository->getAll()->count(),
            'pending' => $this->repository->getPending()->count(),
            'accepted' => $this->repository->getAccepted()->count(),
            'rejected' => $this->repository->getRejected()->count(),
        ];
    }
}
