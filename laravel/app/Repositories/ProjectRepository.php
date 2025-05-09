<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ProjectRepositoryI;

class ProjectRepository implements ProjectRepositoryI
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Project::all();
    }

    /**
     * @param int $id
     * @return Project|null
     */
    public function getById(int $id): ?Project
    {
        return Project::findOrFail($id);
    }

    /**
     * @param array $data
     * @return Project
     */
    public function create(array $data): Project
    {
        return Project::create($data);
    }

    /**
     * @param Project $project
     * @param array $data
     * @return bool
     */
    public function update(Project $project, array $data): bool
    {
        return $project->update($data);
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function delete(Project $project): bool
    {
        return $project->deleteOrFail();
    }
}
