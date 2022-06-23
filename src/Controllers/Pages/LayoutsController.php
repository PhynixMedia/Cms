<?php

namespace Cms\App\Controllers\Pages;

use Cms\App\Controllers\BaseController;
use Illuminate\Http\Request;

class LayoutsController extends BaseController {

    public function __construct(){

        parent::__construct();
    }

    public function store(Request $request)
    {
        $payload = $this->webService->layouts()->prepare($request, true);
        $payload["status"] = 1;

        if(! $this->webService->layouts()->set(map_request($payload))){

            return response()->json($this->statusService::error("Create Job Activity"));
        }

        return response()->json($this->statusService::success("Create Job Activity"));
    }

    public function update(Request $request)
    {
        try {
            $target = $request->get("target") ?? [];
            $data = $request->get("data") ?? [];

            if (!$records = $this->webService->layouts()->update($data, $target)) {
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

            if (!$this->webService->layouts()->delete($where)) {

                return response()->json($this->statusService::error("Delete"));
            }

            return response()->json($this->statusService::success("Delete"));

        }catch(\Exception $e){
            return response()->json($this->statusService::error("Delete"));
        }
    }
}
