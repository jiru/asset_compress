<?php
declare(strict_types=1);

namespace AssetCompress;

use AssetCompress\Middleware\AssetCompressMiddleware;
use AssetCompress\Command\BuildCommand;
use AssetCompress\Command\ClearCommand;
use Cake\Console\CommandCollection;
use Cake\Core\BasePlugin;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\MiddlewareQueue;

/**
 * Plugin class defining framework hooks.
 */
class Plugin extends BasePlugin
{
    protected $bootstrapEnabled = false;
    protected $routesEnabled = false;

    /**
     * Add middleware
     *
     * @param  \Cake\Http\MiddlewareQueue $middlewareQueue The queue
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middleware = new AssetCompressMiddleware();
        $middlewareQueue->insertAfter(ErrorHandlerMiddleware::class, $middleware);

        return $middlewareQueue;
    }

    public function console(CommandCollection $commands): CommandCollection
    {
        $commands->add('asset_compress build', BuildCommand::class);
        $commands->add('asset_compress clear', ClearCommand::class);

        return $commands;
    }
}
