<?php
use App\Middleware\MaintenanceMiddleware;

return [
    '/' => [MaintenanceMiddleware::class]
];