<?php

namespace Cms\App\Services\Pages;

use App\Services\Service;
use Cms\App\Models\Pages\Relations\PageRelations;
use Cms\App\Repositories\Pages\TemplatesRepository;

class TemplatesService extends Service
{

    public function __construct(){

        $this->repository = new TemplatesRepository();
    }

    public function blocks(){

        return new BlocksService();
    }

    public function groups(){

        return new GroupsService();
    }

    public function elements(){

        return new ElementsService();
    }

    public function layouts(){

        return new LayoutsService();
    }

    public function loadPage($url = null){

        if(! $record = $this->repository->fetchOne(["url"=>$url], PageRelations::BLOCKS_GROUPS_ELEMENTS, PageRelations::LAYOUTS)){
            return null;
        }
        return $record;
    }
}
