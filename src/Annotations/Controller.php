<?php

namespace DevA7mad\Annotations\Annotations;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class Controller implements Annotation
{
    /**
     * @var string
     */
    public $prefix;

    /**
     * @var mixed
     */
    public $middleware;
}
