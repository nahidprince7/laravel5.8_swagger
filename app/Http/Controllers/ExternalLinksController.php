<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExternalLinksController extends Controller
{
    public function index(){

        return view('externalLink.index');

    }
}
