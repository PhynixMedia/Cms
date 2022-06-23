<?php

namespace Cms\App\Services\Blogs;

use App\Services\Service;
use Cms\App\Repositories\Blogs\BlogsRepository;

class BlogsService extends Service
{
    public function __construct(){

        $this->repository = new BlogsRepository();
    }

    public function category(){

        return new CategoryService();
    }

    public function components(){

        return new ComponentsService();
    }
}
