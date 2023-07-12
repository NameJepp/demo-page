<?php

namespace Core\Middleware;

class Middleware
{
    const MAP = [
        'guets' => Guest::class,
        'auth' => Auth::class,
    ];
}
