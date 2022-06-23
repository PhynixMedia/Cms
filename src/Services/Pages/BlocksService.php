<?php

namespace Cms\App\Services\Pages;

use App\Services\Service;
use Cms\App\Repositories\Pages\BlocksRepository;

class BlocksService extends Service
{

    public function __construct(){

        $this->repository = new BlocksRepository();
    }
}
