<?php

namespace DevA7mad\Annotations\Console;

use Illuminate\Console\Command;
use DevA7mad\Annotations\Routing\Generator;

class RouteClearCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all registered routes.';

    /**
     * The routes generator instance.
     *
     * @var \DevA7mad\Annotations\Routing\Generator
     */
    protected $generator;

    /**
     * Create a new migration install command instance.
     *
     * @param \DevA7mad\Annotations\Routing\Generator $generator
     * @return void
     */
    public function __construct(Generator $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // delete routes.php file
        $this->generator->clean();

        $this->info('Routes cleared successfully!');
    }
}
