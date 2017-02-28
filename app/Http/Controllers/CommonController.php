<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Session\Session;

class CommonController extends Controller
{
    public function __construct()
    {
//        parent::__construct();
        $session = new Session;
        if($session->has('session_key'))
        {
//            return $session->get('session_key');
            return true;
        }
        else
        {
            return false;
        }
    }
}