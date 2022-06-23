<?php

namespace Cms\App\Services\Pages;

use App\Services\Service;
use Cms\App\Repositories\Pages\ElementsRepository;

class ElementsService extends Service
{

    public function __construct(){

        $this->repository = new ElementsRepository();
    }
}
