<?php

namespace DevA7mad\Annotations\Console;

use Illuminate\Console\Command;
use DevA7mad\Annotations\Metadata\ClassFinder;
use DevA7mad\Annotations\Metadata\EventScanner;
use DevA7mad\Annotations\Events\Generator;

class EventScanCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'event:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan all events with event annotations.';

    /**
     * The class finder instance.
     *
     * @var \DevA7mad\Annotations\Metadata\ClassFinder
     */
    protected $finder;

    /**
     * The event scanner instance.
     *
     * @var \DevA7mad\Annotations\Metadata\EventScanner
     */
    protected $scanner;

    /**
     * The events generator instance.
     *
     * @var \DevA7mad\Annotations\Events\Generator
     */
    protected $generator;

    /**
     * The config of the event annotations package.
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new migration install command instance.
     *
     * @param \DevA7mad\Annotations\Metadata\ClassFinder $finder
     * @param \DevA7mad\Annotations\Metadata\EventScanner $scanner
     * @param \DevA7mad\Annotations\Events\Generator $generator
     * @param array $config
     * @return void
     */
    public function __construct(ClassFinder $finder, EventScanner $scanner, Generator $generator, $config)
    {
        parent::__construct();

        $this->finder = $finder;
        $this->scanner = $scanner;
        $this->generator = $generator;
        $this->config = $config;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // get classes
        $classes = $this->finder->getClassesFromNamespace($this->config['events_namespace']);

        // build metadata
        $events = $this->scanner->scan($classes);

        // generate events.php file for scanned events
        $this->generator->generate($events);

        $this->info('Events registered successfully!');
    }
}
