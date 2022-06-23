<?php

namespace Cms\App\Services\Blogs;

use App\Services\Service;
use Cms\App\Repositories\Blogs\CategoryRepository;

class CategoryService extends Service
{

    public function __construct(){

        $this->repository = new CategoryRepository();
    }
}
