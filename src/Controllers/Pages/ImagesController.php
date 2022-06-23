<?php

namespace Cms\App\Controllers\Pages;

use App\Http\Controllers\Auths\CoreController;
use App\Http\Requests\Users\AdminCreateUserRequest;
use Cms\App\Services\Pages\MediaService;
use Illuminate\Http\Request;

class ImagesController extends CoreController {

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



    public function all()
    {
        try {

            $images = (new MediaService())->read();

            return response()->json($this->statusService::success("Delete", $images));

        }catch(\Exception $e){
            return response()->json($this->statusService::error("Delete"));
        }
    }
}
