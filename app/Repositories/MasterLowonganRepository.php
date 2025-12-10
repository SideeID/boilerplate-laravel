<?php

namespace App\Repositories;

use App\Models\MasterLowongan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MasterLowonganRepository
{
    public function __construct(
        private MasterLowongan $model
    ) {}

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model
            ->with('departemen')
            ->withCount(['pendaftarans as accepted_count' => function ($query) {
                $query->where('status', 'A');
            }])
            ->latest()
            ->paginate($perPage);
    }

    public function getAll(): Collection
    {
        return $this->model
            ->with('departemen')
            ->latest()
            ->get();
    }

    public function findById(int $id): ?MasterLowongan
    {
        return $this->model
            ->with('departemen')
            ->withCount(['pendaftarans as accepted_count' => function ($query) {
                $query->where('status', 'A');
            }])
            ->find($id);
    }

    public function create(array $data): MasterLowongan
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $lowongan = $this->findById($id);
        return $lowongan ? $lowongan->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $lowongan = $this->findById($id);
        return $lowongan ? $lowongan->delete() : false;
    }

    public function getByDepartment(int $deptId): Collection
    {
        return $this->model
            ->where('dept_id', $deptId)
            ->with('departemen')
            ->get();
    }

    public function checkQuotaAvailable(int $id): bool
    {
        $lowongan = $this->findById($id);
        if (!$lowongan) {
            return false;
        }

        $acceptedCount = $lowongan->pendaftarans()
            ->where('status', 'A')
            ->count();

        return $acceptedCount < $lowongan->quota;
    }
}
