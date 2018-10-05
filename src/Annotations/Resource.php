<?php

namespace DevA7mad\Annotations\Annotations;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class Resource implements Annotation
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var array
     */
    public $only;

    /**
     * @var array
     */
    public $except;
}
