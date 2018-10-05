<?php

namespace DevA7mad\Annotations\Console;

use Illuminate\Console\Command;
use DevA7mad\Annotations\Metadata\ClassFinder;
use DevA7mad\Annotations\Metadata\RouteScanner;
use DevA7mad\Annotations\Routing\Generator;

class RouteScanCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan all routes with route annotations.';

    /**
     * The class finder instance.
     *
     * @var \DevA7mad\Annotations\Metadata\ClassFinder
     */
    protected $finder;

    /**
     * The route scanner instance.
     *
     * @var \DevA7mad\Annotations\Metadata\RouteScanner
     */
    protected $scanner;

    /**
     * The routes generator instance.
     *
     * @var \DevA7mad\Annotations\Routing\Generator
     */
    protected $generator;

    /**
     * The config of the route annotations package.
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new migration install command instance.
     *
     * @param \DevA7mad\Annotations\Metadata\ClassFinder $finder
     * @param \DevA7mad\Annotations\Metadata\RouteScanner $scanner
     * @param \DevA7mad\Annotations\Routing\Generator $generator
     * @param array $config
     * @return void
     */
    public function __construct(ClassFinder $finder, RouteScanner $scanner, Generator $generator, $config)
    {
        parent::__construct();

        $this->finder = $finder;
        $this->scanner = $scanner;
        $this->generator = $generator;
        $this->config = $config;
    }
    public function handle() { $this->fire(); }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // get classes
        $classes = $this->finder->getClassesFromNamespace($this->config['routes_namespace']);

        // build metadata
        $routes = $this->scanner->scan($classes);

        // generate routes.php file for scanned routes
        $this->generator->generate($routes);

        $this->info('Routes registered successfully!');
    }
}
