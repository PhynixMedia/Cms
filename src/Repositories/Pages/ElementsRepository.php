<?php

namespace Cms\App\Repositories\Pages;

use App\Repositories\CoreRepository;
use Cms\App\Models\Pages\Elements;

class ElementsRepository extends CoreRepository
{
    public function __construct(){

        $this->model = new Elements();
    }
}
