<?php

namespace Cms\App\Controllers;

use App\Http\Controllers\Controller;
use Cms\App\Services\StatusService;
use Cms\App\Services\WebService;

class BaseController extends Controller
{

    protected $token;
    protected $id;
    protected $email;

    protected $webService;
    protected $statusService;

    protected $selector = [];

    public function __construct(){

        date_default_timezone_set('Europe/London');

        $this->webService           = new WebService();
        $this->statusService        = new StatusService();
    }
}
