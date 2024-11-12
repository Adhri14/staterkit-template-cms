<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    public function rootView(Request $request)
    {
        $prefix = $request->route()->getPrefix();
        if($prefix == '/backend' || $prefix == 'backend/'){
              return $this->rootView = 'app-admin';
        }
        return $this->rootView;
    }

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'navigation' => navigation(),
            'current_path'=> request()->fullUrl(),
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'has_flash' => $request->session()->get('message') ? true : false,
            ],
            'env'=>[
                'app_name'=> env('APP_NAME'),
                'app_url'=> env('APP_URL'),
                'api_url'=> url('/api/v1'),
                'upload_url'=> env('UPLOAD_URL'),
                'map_key'=> env('MAP_KEY'),
            ],
            'languages'=> [
                [
                    'prefix' => 'en',
                    'text' => 'english',
                    'icon' => '',
                ],
                [
                    'prefix' => 'id',
                    'text' => 'bahasa',
                    'icon' => '',
                ],
                [
                    'prefix' => 'sc',
                    'text' => 'mandarin',
                    'icon' => '',
                ],
             ],
            'csrf_token' => csrf_token(),
            // 'ziggy' => function () use ($request) {
            //     return array_merge((new Ziggy)->toArray(), [
            //         'location' => $request->url(),
            //     ]);
            // },
        ];
    }
}
