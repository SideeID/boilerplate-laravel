<?php

namespace App\Repositories;

use App\Models\MasterDepartemen;
use Illuminate\Database\Eloquent\Collection;

class MasterDepartemenRepository
{
    public function __construct(
        private MasterDepartemen $model
    ) {}

    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }

    public function findById(int $id): ?MasterDepartemen
    {
        return $this->model->find($id);
    }

    public function getAllWithLowonganStats(): Collection
    {
        return $this->model
            ->with(['lowongans' => function ($query) {
                $query->withCount([
                    'pendaftarans',
                    'pendaftarans as accepted_count' => function ($q) {
                        $q->where('status', 'A');
                    },
                    'pendaftarans as rejected_count' => function ($q) {
                        $q->where('status', 'R');
                    },
                    'pendaftarans as pending_count' => function ($q) {
                        $q->where('status', 'P');
                    }
                ]);
            }])
            ->get();
    }
}
