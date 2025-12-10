<?php

namespace App\Services;

use App\Repositories\MasterLowonganRepository;
use App\Models\MasterLowongan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class MasterLowonganService
{
    public function __construct(
        private MasterLowonganRepository $repository
    ) {}

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->getAllPaginated($perPage);
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function findById(int $id): ?MasterLowongan
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): MasterLowongan
    {
        $data['user_create'] = Auth::user()?->name ?? 'System';

        return $this->repository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['user_update'] = Auth::user()?->name ?? 'System';

        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $lowongan = $this->repository->findById($id);

        if (!$lowongan) {
            throw new \Exception('Lowongan tidak ditemukan');
        }

        if ($lowongan->pendaftarans()->count() > 0) {
            throw new \Exception('Tidak dapat menghapus lowongan yang memiliki pendaftaran');
        }

        return $this->repository->delete($id);
    }

    public function getByDepartment(int $deptId): Collection
    {
        return $this->repository->getByDepartment($deptId);
    }

    public function isQuotaAvailable(int $id): bool
    {
        return $this->repository->checkQuotaAvailable($id);
    }
}
