<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    protected $business, $requestMethod;

    use AuthorizesRequests, ValidatesRequests;

    public function __construct($requestMethod = '')
    {
        $class = '\App\Business\\' . str_replace('App\Http\Controllers\\', '', get_class($this));
        if (class_exists($class)) {
            $this->business = new $class;
        }
        $this->requestMethod = $requestMethod;
    }
}
