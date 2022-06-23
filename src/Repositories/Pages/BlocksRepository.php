<?php

namespace Cms\App\Repositories\Pages;

use App\Repositories\CoreRepository;
use App\Traits\RunTraits;
use Cms\App\Models\Pages\Blocks;

class BlocksRepository extends CoreRepository
{
    use RunTraits;

    public function __construct(){

        $this->model = new Blocks();
    }
}
