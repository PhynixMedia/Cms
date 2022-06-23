<?php

namespace Cms\App\Services\Pages;

use App\Services\Service;
use Cms\App\Repositories\Pages\LayoutsRepository;

class LayoutsService extends Service
{

    public function __construct(){

        $this->repository = new LayoutsRepository();
    }
}
