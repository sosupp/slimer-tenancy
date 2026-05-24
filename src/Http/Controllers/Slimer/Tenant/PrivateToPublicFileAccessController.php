<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Tenant;

use Illuminate\Routing\Controller;

class PrivateToPublicFileAccessController extends Controller
{
    public function image(string $path)
    {
        if (str_contains($path, '..')) {
            abort(403);
        }

        $base = "app/private/";

        // dd($path);
        $fullPath = "{$base}/{$path}";
        return response()->file(storage_path($fullPath));
    }

    public function document(string $path)
    {
        if (str_contains($path, '..')) {
            abort(403);
        }

        $base = "app/private/";

        // dd($path);
        $fullPath = "{$base}/{$path}";
        return response()->file(storage_path($fullPath));
    }

}