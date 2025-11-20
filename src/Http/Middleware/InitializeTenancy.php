<?php

namespace Sosupp\SlimerTenancy\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Sosupp\SlimerTenancy\Services\Tenant\TenantManagerService;
use Sosupp\SlimerTenancy\Services\Tenant\TenantResolverService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InitializeTenancy
{
    public function __construct(
        protected TenantResolverService $resolver,
        protected TenantManagerService $manager
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = $this->resolver->resolve($request);

        // dd($tenant);
        if (!$tenant) {
            $root = config('slimer.tenancy.root_domain');
            if ($request->getHost() === $root || $request->getHost() === 'www.'.$root) {
                return $next($request);
            }

            $mainDomain = $this->getMainDomain();
            // dd("not tenant", $this->getMainDomain(), $request->getScheme());
            // return route('site.landing');
            return redirect()->away($request->getScheme() . "://{$mainDomain}");
            throw new NotFoundHttpException('Tenant not found.');
        }

        $this->manager->setTenant($tenant);

        return $next($request);
    }

    private function getMainDomain(): string
    {
        // Get the app domain from config or env
        return config('app.root_domain', parse_url(config('app.url'), PHP_URL_HOST));
    }
}
