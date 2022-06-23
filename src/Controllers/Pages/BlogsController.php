<?php

namespace Cms\App\Controllers\Pages;

use Cms\App\Controllers\BaseController;
use Cms\App\Models\Pages\Relations\BlogRelations;

class BlogsController extends BaseController {

    public function __construct(){

        parent::__construct();
    }

    public function all(){

        if(! $record =  $this->webService->blogs()->fetch([], BlogRelations::CATEGORY) ){

            return response()->json($this->statusService::error("Fetch Blog"));
        }

        return response()->json($this->statusService::success("Fetch Blog", $record->toArray()));
    }

    public function get($identifier){

        if(! $record =  $this->webService->blogs()->findOne(["id"=>$identifier]) ){

            return response()->json($this->statusService::error("Fetch Blog"));
        }

        return response()->json($this->statusService::success("Fetch Blog", $record->toArray()));
    }


    public function store(Request $request)
    {
        $payload = $this->webService->blogs()->prepare($request, true);
        $payload["category"] = 1;
        $payload["url"] = self::toAscii($request->get("title"));
        $payload["status"] = 1;

        \Log::info("Data-> " . json_encode($payload));

        if($id = $request->get("id")){

            $target = ["id" => $id];
            if(! $this->webService->blogs()->update($payload, $target)){
                return response()->json($this->statusService::error("Update Blog"));
            }
            return response()->json($this->statusService::success("Update Blog"));
        }

        if(! $this->webService->blogs()->set(map_request($payload))){
            return response()->json($this->statusService::error("Update Blog"));
        }
        return response()->json($this->statusService::success("Update Blog"));
    }

    private static function toAscii($str, $replace=array(), $delimiter='-') {

        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    public function update(Request $request)
    {
        try {
            $target = $request->get("target") ?? [];
            $data = $request->get("data") ?? [];

            if (!$records = $this->webService->blogs()->update($data, $target)) {
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

            if (!$this->webService->blogs()->delete($where)) {

                return response()->json($this->statusService::error("Delete"));
            }

            return response()->json($this->statusService::success("Delete"));

        }catch(\Exception $e){
            return response()->json($this->statusService::error("Delete"));
        }
    }
}
