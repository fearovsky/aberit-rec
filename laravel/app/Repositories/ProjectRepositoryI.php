<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

interface ProjectRepositoryI
{
    public function getAll(): Collection;

    public function getById(int $id): ?Project;

    public function create(array $data): Project;

    public function update(Project $project, array $data): bool;

    public function delete(Project $project): bool;
}
