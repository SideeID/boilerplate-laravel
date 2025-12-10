<?php

namespace App\Repositories;

use App\Models\TransaksiPendaftaran;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TransaksiPendaftaranRepository
{
    public function __construct(
        private TransaksiPendaftaran $model
    ) {}

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model
            ->with('lowongan.departemen')
            ->latest()
            ->paginate($perPage);
    }

    public function getAll(): Collection
    {
        return $this->model
            ->with('lowongan.departemen')
            ->latest()
            ->get();
    }

    public function findById(int $id): ?TransaksiPendaftaran
    {
        return $this->model
            ->with('lowongan.departemen')
            ->find($id);
    }

    public function create(array $data): TransaksiPendaftaran
    {
        return $this->model->create($data);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $pendaftaran = $this->findById($id);
        return $pendaftaran ? $pendaftaran->update(['status' => $status]) : false;
    }

    public function getByStatus(string $status): Collection
    {
        return $this->model
            ->byStatus($status)
            ->with('lowongan.departemen')
            ->latest()
            ->get();
    }

    public function getPending(): Collection
    {
        return $this->model
            ->pending()
            ->with('lowongan.departemen')
            ->latest()
            ->get();
    }

    public function getAccepted(): Collection
    {
        return $this->model
            ->accepted()
            ->with('lowongan.departemen')
            ->latest()
            ->get();
    }

    public function getRejected(): Collection
    {
        return $this->model
            ->rejected()
            ->with('lowongan.departemen')
            ->latest()
            ->get();
    }

    public function getByLowongan(int $lowonganId): Collection
    {
        return $this->model
            ->where('id_lowongan', $lowonganId)
            ->with('lowongan.departemen')
            ->latest()
            ->get();
    }

    public function getByUserIdPaginated(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model
            ->where('id_user', $userId)
            ->with('lowongan.departemen')
            ->latest()
            ->paginate($perPage);
    }

    public function countAcceptedByLowongan(int $lowonganId): int
    {
        return $this->model
            ->where('id_lowongan', $lowonganId)
            ->where('status', 'A')
            ->count();
    }
}
