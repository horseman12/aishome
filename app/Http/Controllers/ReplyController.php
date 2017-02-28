<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
class ReplyController extends Controller
{
    public function index()
    {
        return view('reply');
    }
}