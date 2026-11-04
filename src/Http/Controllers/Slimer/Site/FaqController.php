<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Site;

use Illuminate\Routing\Controller;
use Sosupp\SlimerTenancy\Services\Landlord\FaqCrudService;

class FaqController extends Controller
{
    public function index()
    {
        return view('slimer-tenancy::faqs.index', [
            'faqs' => (new FaqCrudService)->list(),
        ]);
    }
}
