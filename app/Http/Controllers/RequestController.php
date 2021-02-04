<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Models\Request as RequestModel;

class RequestController extends Controller
{
    public function list(Request $request, $id)
    {
        $requestModels = RequestModel::where('project_id', $id)->get();

        return [
            "action" => "requests",
            "requests" => $requestModels,
        ];
    }

    public function view(Request $request, $id)
    {
        $requestModel = RequestModel::find($id);

        if($requestModel === null) {
            return [
                "action" => "requestNotFound"
            ];
        }

        return [
            "action" => "request",
            "request" => $requestModel,
        ];
    }

    public function insert(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'url' => 'required',
            'method' => 'required',
            'params' => 'required',
            'project_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                "action" => "requestNotValid",
                "errors" => $validator->errors(),
            ];
        }

        $requestModel = new RequestModel($request->all());
        $requestModel->save();

        return [
            "action" => "requestCreated",
            "request" => $requestModel,
        ];
    }

    public function update(Request $request, $id)
    {
        $requestModel = RequestModel::find($id);

        if($requestModel === null) {
            return [
                "action" => "requestNotFound"
            ];
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'url' => 'required',
            'method' => 'required',
            'params' => 'required',
            'project_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                "action" => "requestNotValid",
                "errors" => $validator->errors(),
            ];
        }

        $requestModel->update($request->all());
        $requestModel->save();

        return [
            "action" => "requestUpdated"
        ];
    }

    public function delete(Request $request, $id)
    {
        $requestModel = RequestModel::find($id);

        if($requestModel === null) {
            return [
                "action" => "requestNotFound"
            ];
        }

        $requestModel->delete();

        return [
            "action" => "requestDeleted"
        ];
    }
}
