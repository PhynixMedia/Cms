<?php

namespace Cms\App\Repositories\Blogs;

use App\Repositories\CoreRepository;
use App\Traits\RunTraits;
use Cms\App\Models\Blogs\Components;

class ComponentsRepository extends CoreRepository
{
    use RunTraits;

    public function __construct(){

        $this->model = new Components();
    }
}
