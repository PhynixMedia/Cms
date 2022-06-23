<?php

namespace Cms\App\Services\Blogs;

use App\Services\Service;
use Cms\App\Repositories\Blogs\ComponentsRepository;

class ComponentsService extends Service
{
    public function __construct(){

        $this->repository = new ComponentsRepository();
    }
}
