<?php

namespace Cms\App\Controllers\Pages;

use App\Http\Controllers\Auths\CoreController;
use App\Http\Requests\Users\AdminCreateUserRequest;
use Illuminate\Http\Request;

class LayoutsController extends CoreController {

    public function __construct(){

        parent::__construct();
    }

    public function store(Request $request)
    {
        $payload = $this->webService->layouts()->prepare($request, true);
        $payload["status"] = 1;

        if(! $this->jobService->layouts()->set(map_request($payload))){

            return response()->json($this->statusService::error("Create Job Activity"));
        }

        return response()->json($this->statusService::success("Create Job Activity"));
    }

    public function update(Request $request)
    {
        try {
            $target = $request->get("target") ?? [];
            $data = $request->get("data") ?? [];

            if (!$records = $this->jobService->layouts()->update($data, $target)) {
                return response()->json($this->statusService::error("Update Job"));
            }

            return response()->json($this->statusService::success("Update Job", $records->toArray()));
        }catch (\Exception $e){
            return response()->json($this->statusService::error("Update Job"));
        }
    }

    public function delete($identifier)
    {
        try {

            $where = ["id" => $identifier];

            if (!$this->jobService->layouts()->delete($where)) {

                return response()->json($this->statusService::error("Delete"));
            }

            return response()->json($this->statusService::success("Delete"));

        }catch(\Exception $e){
            return response()->json($this->statusService::error("Delete"));
        }
    }
}
