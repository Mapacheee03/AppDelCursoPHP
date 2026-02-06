protected $routeMiddleware = [
    // ... otros middleware
    'admin' => \App\Http\Middleware\CheckAdmin::class,
];
