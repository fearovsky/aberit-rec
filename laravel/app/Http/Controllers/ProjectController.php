<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\ProjectServiceI;
use Illuminate\Support\Facades\Log;
use App\Enums\Http\ProjectHttpEnum;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\{
    ProjectStoreRequest,
    ProjectUpdateRequest
};

class ProjectController extends Controller
{
    public function __construct(
        private ProjectServiceI $projectService,
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            $projects = $this->projectService->getAll();
        } catch (\Exception $e) {
            Log::error('Error fetching projects: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectHttpEnum::PROJECT_ERROR_GET_ALL->value,
            ], 500);
        }

        return ProjectResource::collection($projects)
            ->response();
    }

    public function store(ProjectStoreRequest $request)
    {
        try {
            $project = $this->projectService->create($request->validated());
        } catch (\Exception $e) {
            Log::error('Error creating project: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectHttpEnum::PROJECT_ERROR_CREATE->value,
            ], 500);
        }

        return ProjectResource::make($project)
            ->response()
            ->setStatusCode(201);
    }

    public function show(Project $project)
    {
        return ProjectResource::make($project)
            ->response();
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        try {
            $project = $this->projectService->update($project, $request->validated());
        } catch (\Exception $e) {
            Log::error('Error updating project: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectHttpEnum::PROJECT_ERROR_UPDATE->value,
            ], 500);
        }

        return response()->json([
            'message' => ProjectHttpEnum::PROJECT_SUCCESS_UPDATE->value,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $this->projectService->delete($project);
        } catch (\Exception $e) {
            Log::error('Error deleting project: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectHttpEnum::PROJECT_ERROR_DELETE->value,
            ], 500);
        }

        return response()->json([
            'message' => ProjectHttpEnum::PROJECT_SUCCESS_DELETE->value,
        ], 200);
    }
}
