<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Site;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DemoAccountController extends Controller
{
    public function index(Request $request, $token = null)
    {
        return view('slimer-tenancy::site.demo.index', [
            'token' => $token,
        ]);
    }
}
