<?php namespace Ill\System\Base;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Ill\Core\CommandBus\DefaultCommandBus;

class BaseResourceController extends Controller
{

    protected $bus;
    public $response;

    public function __construct(DefaultCommandBus $bus,
                                Response $response)
    {
        $this->bus = $bus;
        $this->response = $response;
    }


}

