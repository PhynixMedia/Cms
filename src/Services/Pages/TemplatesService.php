<?php

namespace Cms\App\Services\Pages;

use App\Services\Service;
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
}
