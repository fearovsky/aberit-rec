<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use App\Enums\Cache\ProjectCacheEnum;
use App\Repositories\ProjectRepositoryI;

class ProjectService implements ProjectServiceI
{
    public function __construct(
        private ProjectRepositoryI $projectRepository,
    ) {
    }

    public function getAll(): Collection
    {
        return Cache::remember(ProjectCacheEnum::PROJECTS_ALL->key(), 1800, function () {
            return $this->projectRepository->getAll();
        });
    }

    public function getById(int $id): ?Project
    {
        return Cache::remember(ProjectCacheEnum::PROJECT_BY_ID->key($id), 1800, function () use ($id) {
            return $this->projectRepository->getById($id);
        });
    }

    public function create(array $data): Project
    {
        $project = $this->projectRepository->create($data);

        Cache::forget(ProjectCacheEnum::PROJECTS_ALL->key());

        return $project;
    }

    public function update(Project $project, array $data): bool
    {
        $result = $this->projectRepository->update($project, $data);

        if ($result) {
            Cache::forget(ProjectCacheEnum::PROJECT_BY_ID->key($project->id));
            Cache::forget(ProjectCacheEnum::PROJECTS_ALL->key());
        }

        return $result;
    }

    public function delete(Project $project): bool
    {
        $result = $this->projectRepository->delete($project);

        if ($result) {
            Cache::forget(ProjectCacheEnum::PROJECT_BY_ID->key($project->id));
            Cache::forget(ProjectCacheEnum::PROJECTS_ALL->key());
        }

        return $result;
    }
}
