<?php

namespace Cms\App\Controllers\Pages;

use App\Http\Controllers\Auths\CoreController;
use Cms\App\Requests\SearchWebsiteRequest;
use Cms\App\Models\Pages\Relations\PageRelations;
use Illuminate\Http\Request;

class TemplateController extends CoreController {

    const WEB_TEMPLATE  = "template";
    const WEB_BLOCKS    = "block";
    const WEB_GROUPS    = "group";
    const WEB_ELEMENTS  = "element";
    const WEB_LAYOUT    = "layout";

    public function __construct(){

        parent::__construct();
    }


    public function fetch($target){

        switch ($target){
            case self::WEB_TEMPLATE:

                if($records = $this->webService->template()->find([])){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }

            break;
            case self::WEB_BLOCKS:
                if($records =  $this->webService->template()->blocks()->find([])){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
            break;
            case self::WEB_GROUPS:
                if($records =  $this->webService->template()->groups()->find([])){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
            break;
            case self::WEB_ELEMENTS:
                if($records =  $this->webService->template()->elements()->find([])){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
            break;
            case self::WEB_LAYOUT:
                if($records =  $this->webService->template()->layouts()->find([])){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
            break;
        }

        return response()->json($this->statusService::error("Fetch"));
    }

    public function find(SearchWebsiteRequest $request, $target){

        $where = $request->get('target');
        $fetch = $request->get("total");

        switch ($target){
            case self::WEB_TEMPLATE:

                if($fetch == 1){
                    if ($records = $this->webService->template()->fetchOne($where, PageRelations::BLOCKS_GROUPS_ELEMENTS)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {
                    if ($records = $this->webService->template()->fetch($where, PageRelations::BLOCKS_GROUPS_ELEMENTS)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }

                break;
            case self::WEB_BLOCKS:
                if($fetch == 1) {
                    if ($records = $this->webService->template()->blocks()->fetchOne($where, PageRelations::GROUPS_ELEMENTS)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {

                    \Log::info("Unable to fetch ".json_encode($where));
                    if ($records = $this->webService->template()->blocks()->fetch($where, PageRelations::GROUPS_ELEMENTS)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }
                break;
            case self::WEB_GROUPS:

                \Log::info("Unable to fetch ".json_encode($where));
                if($fetch == 1) {
                    if ($records = $this->webService->template()->groups()->fetchOne($where, PageRelations::ELEMENTS)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {
                    if ($records = $this->webService->template()->groups()->fetch($where, PageRelations::ELEMENTS)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }
                break;
            case self::WEB_ELEMENTS:
                if($fetch == 1) {
                    if ($records = $this->webService->template()->elements()->fetchOne($where)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {
                    if ($records = $this->webService->template()->elements()->fetch($where)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }
                break;
            case self::WEB_LAYOUT:
                if($fetch == 1) {
                    if ($records = $this->webService->template()->layouts()->fetchOne($where)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {
                    if ($records = $this->webService->template()->layouts()->fetch($where)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }
                break;
        }

        return response()->json($this->statusService::error("Fetch"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, $target)
    {

        switch ($target){
            case self::WEB_TEMPLATE:
                $payload = $this->webService->template()->prepare($request, true);
                $payload["status"] = 1;
                $payload["parent"] = $request->get("parent") ?? 0;
                if(! $this->webService->template()->set(map_request($payload))){
                    return response()->json($this->statusService::error("Create"));
                }
                if ($records = $this->webService->template()->fetch([], PageRelations::BLOCKS_GROUPS_ELEMENTS)) {
                    return response()->json($this->statusService::success("Create", $records->toArray()));
                }
            break;
            case self::WEB_BLOCKS:
                $payload = $this->webService->template()->blocks()->prepare($request, true);
                $payload["status"] = 1;
                if(! $this->webService->template()->blocks()->set(map_request($payload))){
                    return response()->json($this->statusService::error("Create"));
                }
                if ($records = $this->webService->template()->blocks()->fetch(["template_id"=>$request->get("template_id")], PageRelations::GROUPS_ELEMENTS)) {
                    return response()->json($this->statusService::success("Create", $records->toArray()));
                }
            break;
            case self::WEB_GROUPS:
                $payload = $this->webService->template()->groups()->prepare($request, true);
                $payload["status"] = 1;
                if(! $this->webService->template()->groups()->set(map_request($payload))){
                    return response()->json($this->statusService::error("Create"));
                }
                if ($records = $this->webService->template()->groups()->fetch(["block_id"=>$request->get("block_id")], PageRelations::ELEMENTS)) {
                    return response()->json($this->statusService::success("Create", $records->toArray()));
                }
            break;
            case self::WEB_ELEMENTS:

                $loop = $request->get("groups") ?? [];
                foreach ($loop as $value) {

                    $payload = $this->webService->template()->elements()->prepare($request, true);
                    $payload["status"] = 1;
                    $payload["group_id"] = $value;
                    if (!$this->webService->template()->elements()->set(map_request($payload))) {
                        return response()->json($this->statusService::error("Create"));
                    }
                }

                if ($records = $this->webService->template()->elements()->fetch(["group_id"=>$request->get("group_id")], PageRelations::ELEMENTS)) {
                    return response()->json($this->statusService::success("Create", $records->toArray()));
                }
            break;
            case self::WEB_LAYOUT:
                $payload = $this->webService->template()->layouts()->prepare($request, true);
                $payload["status"] = 1;
                if(! $this->webService->template()->layouts()->set(map_request($payload))){
                    return response()->json($this->statusService::error("Create"));
                }
            break;
        }

        return response()->json($this->statusService::success("Create"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $target)
    {
        try {

            $where = $request->get("target") ?? [];
            $data = $request->get("data") ?? [];

            \Log::info("Update Payload::: " . json_encode($request->all()));

            switch ($target){
                case self::WEB_TEMPLATE:
                    if (!$records = $this->webService->template()->update($data, $where)) {
                        return response()->json($this->statusService::error("Update Template"));
                    }
                break;
                case self::WEB_BLOCKS:
                    if (!$records = $this->webService->template()->blocks()->update($data, $where)) {
                        return response()->json($this->statusService::error("Update Block"));
                    }
                break;
                case self::WEB_GROUPS:
                    if (!$records = $this->webService->template()->groups()->update($data, $where)) {
                        return response()->json($this->statusService::error("Update Group"));
                    }
                break;
                case self::WEB_ELEMENTS:

                    \Log::info("Update Payload::: " . json_encode($data));
                    \Log::info("Update Payload::: " . json_encode($where));

                    if (!$records = $this->webService->template()->elements()->update($data, $where)) {
                        return response()->json($this->statusService::error("Update Element"));
                    }
                break;
                case self::WEB_LAYOUT:
                    if (!$records = $this->webService->template()->layouts()->update($data, $where)) {
                        return response()->json($this->statusService::error("Update Layout"));
                    }
                break;
            }

            return response()->json($this->statusService::success("Update"));

        }catch (\Exception $e){

            \Log::info("Update Payload Error::: " . json_encode($e->getMessage()));

            return response()->json($this->statusService::error("Update"));
        }
    }

    /**
     * @param $identifier
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($target, $identifier )
    {
        try {

            $where = ["id" => $identifier];

            switch ($target){
                case self::WEB_TEMPLATE:
                    if (!$this->webService->template()->delete($where)) {
                        return response()->json($this->statusService::error("Delete"));
                    }
                break;
                case self::WEB_BLOCKS:
                    if (!$this->webService->template()->blocks()->delete($where)) {
                        return response()->json($this->statusService::error("Delete"));
                    }
                break;
                case self::WEB_GROUPS:
                    if (!$this->webService->template()->groups()->delete($where)) {
                        return response()->json($this->statusService::error("Delete"));
                    }
                break;
                case self::WEB_ELEMENTS:
                    if (!$this->webService->template()->elements()->delete($where)) {
                        return response()->json($this->statusService::error("Delete"));
                    }
                break;
                case self::WEB_LAYOUT:
                    if (!$this->webService->template()->layouts()->delete($where)) {
                        return response()->json($this->statusService::error("Delete"));
                    }
                break;
            }

            return response()->json($this->statusService::success("Delete"));

        }catch(\Exception $e){
            return response()->json($this->statusService::error("Delete"));
        }
    }
}
