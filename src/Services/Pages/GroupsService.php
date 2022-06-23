<?php

namespace Cms\App\Services\Pages;

use App\Services\Service;
use Cms\App\Repositories\Pages\GroupsRepository;

class GroupsService extends Service
{

    public function __construct(){

        $this->repository = new GroupsRepository();
    }
}
