<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Database\Seeders\ProjectSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     * Supports ?division=recruitment or ?division=adm
     */
    public function index(Request $request)
    {
        $division = $request->query('division');

        if ($division) {
            $projects = Project::where('division', $division)->orderBy('no')->get();
            return response()->json([
                'status' => 'success',
                'division' => $division,
                'count' => $projects->count(),
                'data' => $projects
            ]);
        }

        $recruitment = Project::where('division', 'recruitment')->orderBy('no')->get();
        $adm = Project::where('division', 'adm')->orderBy('no')->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'recruitment' => $recruitment,
                'adm' => $adm
            ]
        ]);
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'division' => 'nullable|in:recruitment,adm',
            'date' => 'nullable|string',
            'principal' => 'nullable|string',
            'pic' => 'nullable|string',
            'activities' => 'nullable|string',
            'stages' => 'nullable|array',
            'remark' => 'nullable|string',
            'no' => 'nullable|integer',
        ]);

        $division = $validated['division'] ?? 'recruitment';
        $maxNo = Project::where('division', $division)->max('no') ?? 0;
        $no = $validated['no'] ?? ($maxNo + 1);

        $defaultStages = array_fill(0, 7, 0);
        $stages = isset($validated['stages']) && is_array($validated['stages']) 
            ? array_slice(array_pad($validated['stages'], 7, 0), 0, 7)
            : $defaultStages;

        $projectId = ($division === 'recruitment' ? 'rec-' : 'adm-') . (time() . '-' . rand(100, 999));

        $project = Project::create([
            'project_id' => $projectId,
            'division' => $division,
            'no' => $no,
            'date' => $validated['date'] ?? '2026-11-11',
            'name' => $validated['name'],
            'principal' => $validated['principal'] ?? '',
            'pic' => $validated['pic'] ?? '',
            'activities' => $validated['activities'] ?? '',
            'stages' => $stages,
            'remark' => $validated['remark'] ?? '',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }

    /**
     * Display the specified project.
     */
    public function show($id)
    {
        $project = Project::where('id', $id)
            ->orWhere('project_id', $id)
            ->first();

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $project
        ]);
    }

    /**
     * Update the specified project.
     */
    public function update(Request $request, $id)
    {
        $project = Project::where('id', $id)
            ->orWhere('project_id', $id)
            ->first();

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'date' => 'nullable|string',
            'principal' => 'nullable|string',
            'pic' => 'nullable|string',
            'activities' => 'nullable|string',
            'stages' => 'nullable|array',
            'remark' => 'nullable|string',
            'no' => 'nullable|integer',
        ]);

        if (isset($validated['stages']) && is_array($validated['stages'])) {
            $validated['stages'] = array_slice(array_pad($validated['stages'], 7, 0), 0, 7);
        }

        $project->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Project updated successfully',
            'data' => $project
        ]);
    }

    /**
     * Toggle a specific stage on a project.
     */
    public function toggleStage(Request $request, $id)
    {
        $project = Project::where('id', $id)
            ->orWhere('project_id', $id)
            ->first();

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        $stageIdx = (int) $request->input('stage_idx', 0);
        if ($stageIdx < 0 || $stageIdx > 6) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid stage index (must be 0-6)'
            ], 422);
        }

        $stages = $project->stages ?? array_fill(0, 7, 0);
        $stages[$stageIdx] = $stages[$stageIdx] ? 0 : 1;
        $project->stages = $stages;
        $project->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Stage toggled successfully',
            'data' => $project
        ]);
    }

    /**
     * Remove the specified project.
     */
    public function destroy($id)
    {
        $project = Project::where('id', $id)
            ->orWhere('project_id', $id)
            ->first();

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        $project->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Project deleted successfully'
        ]);
    }

    /**
     * Bulk sync full dashboard state (Recruitment & ADM).
     */
    public function bulkSync(Request $request)
    {
        $payload = $request->all();

        if (!isset($payload['recruitment']) && !isset($payload['adm'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid payload, expected recruitment and/or adm lists'
            ], 422);
        }

        DB::transaction(function () use ($payload) {
            if (isset($payload['recruitment']) && is_array($payload['recruitment'])) {
                Project::where('division', 'recruitment')->delete();
                foreach ($payload['recruitment'] as $p) {
                    Project::create([
                        'project_id' => $p['id'] ?? ('rec-' . ($p['no'] ?? rand(1, 999))),
                        'division' => 'recruitment',
                        'no' => $p['no'] ?? 1,
                        'date' => $p['date'] ?? '2026-11-11',
                        'name' => $p['name'] ?? '',
                        'principal' => $p['principal'] ?? '',
                        'pic' => $p['pic'] ?? '',
                        'activities' => $p['activities'] ?? '',
                        'stages' => $p['stages'] ?? array_fill(0, 7, 0),
                        'remark' => $p['remark'] ?? '',
                    ]);
                }
            }

            if (isset($payload['adm']) && is_array($payload['adm'])) {
                Project::where('division', 'adm')->delete();
                foreach ($payload['adm'] as $p) {
                    Project::create([
                        'project_id' => $p['id'] ?? ('adm-' . ($p['no'] ?? rand(1, 999))),
                        'division' => 'adm',
                        'no' => $p['no'] ?? 1,
                        'date' => $p['date'] ?? '2026-11-11',
                        'name' => $p['name'] ?? '',
                        'principal' => $p['principal'] ?? '',
                        'pic' => $p['pic'] ?? '',
                        'activities' => $p['activities'] ?? '',
                        'stages' => $p['stages'] ?? array_fill(0, 7, 0),
                        'remark' => $p['remark'] ?? '',
                    ]);
                }
            }
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Bulk data synced successfully'
        ]);
    }

    /**
     * Reset projects to initial grounded Excel data.
     */
    public function reset()
    {
        $seeder = new ProjectSeeder();
        $seeder->run();

        return response()->json([
            'status' => 'success',
            'message' => 'Database successfully reset to initial Excel data'
        ]);
    }

    /**
     * Health check endpoint.
     */
    public function health()
    {
        $dbConnected = false;
        try {
            DB::connection()->getPdo();
            $dbConnected = true;
        } catch (\Exception $e) {
            $dbConnected = false;
        }

        return response()->json([
            'status' => 'ok',
            'service' => 'PT SOSM Project Tracking API',
            'version' => '1.0.0',
            'laravel' => app()->version(),
            'database_connected' => $dbConnected,
            'timestamp' => now()->toIso8601String()
        ]);
    }
}
