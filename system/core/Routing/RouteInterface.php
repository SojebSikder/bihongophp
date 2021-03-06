<?php

namespace System\Core\Routing;

interface RouteInterface
{
    /**
     * Add route to map
     *
     * @param string $method
     * @param string $url
     * @param string $controller
     * @param bool   $force
     */
    public function add($method, $url, $controller, $force = false);

    /**
     * Get controller from map of route
     *
     * @param string     $uri
     * @param bool $method
     * @return null|RouteMatch
     */
    public function read($uri, $method = false);

    /**
     * Get id value  from last uri
     * @return int
     */
    public function getRouteId();
}
