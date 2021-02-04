<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function list(Request $request)
    {
        $projects = Project::all();

        return [
            "action" => "projects",
            "projects" => $projects,
        ];
    }

    public function view(Request $request, $id)
    {
        $project = Project::find($id);

        if($project === null) {
            return [
                "action" => "projectNotFound"
            ];
        }

        return [
            "action" => "project",
            "project" => $project,
        ];
    }

    public function insert(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                "action" => "projectNotValid"
            ];
        }

        $project = new Project($request->all());
        $project->save();

        return [
            "action" => "projectCreated",
            "project" => $project,
        ];
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if($project === null) {
            return [
                "action" => "projectNotFound"
            ];
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                "action" => "projectNotValid"
            ];
        }

        $project->update($request->all());
        $project->save();

        return [
            "action" => "projectUpdated"
        ];
    }

    public function delete(Request $request, $id)
    {
        $project = Project::find($id);

        if($project === null) {
            return [
                "action" => "projectNotFound"
            ];
        }

        $project->delete();

        return [
            "action" => "projectDeleted"
        ];
    }
}
