<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Models\Call;

class CallController extends Controller
{
    public function list(Request $request, $id)
    {
        $calls = Call::where('request_id', $id)->get();

        return [
            "action" => "calls",
            "calls" => $calls,
        ];
    }

    public function view(Request $request, $id)
    {
        $call = Call::find($id);

        if($call === null) {
            return [
                "action" => "callNotFound"
            ];
        }

        return [
            "action" => "call",
            "call" => $call,
        ];
    }

    public function insert(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'url' => 'required',
            'method' => 'required',
            'params' => 'required',
            'response' => 'required',
            'request_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                "action" => "callNotValid",
                "errors" => $validator->errors(),
            ];
        }

        $call = new Call($request->all());
        $call->save();

        return [
            "action" => "callCreated",
            "call" => $call,
        ];
    }

    public function update(Request $request, $id)
    {
        $call = Call::find($id);

        if($call === null) {
            return [
                "action" => "callNotFound"
            ];
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'url' => 'required',
            'method' => 'required',
            'params' => 'required',
            'response' => 'required',
            'request_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                "action" => "callNotValid",
                "errors" => $validator->errors(),
            ];
        }

        $call->update($request->all());
        $call->save();

        return [
            "action" => "projectUpdated",
            "call" => $call,
        ];
    }

    public function delete(Request $request, $id)
    {
        $call = Call::find($id);

        if($project === null) {
            return [
                "action" => "callNotFound"
            ];
        }

        $call->delete();

        return [
            "action" => "callDeleted"
        ];
    }
}
