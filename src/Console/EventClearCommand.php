<?php

namespace DevA7mad\Annotations\Console;

use Illuminate\Console\Command;
use DevA7mad\Annotations\Events\Generator;

class EventClearCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'event:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all registered events.';

    /**
     * The events generator instance.
     *
     * @var \DevA7mad\Annotations\Events\Generator
     */
    protected $generator;

    /**
     * Create a new migration install command instance.
     *
     * @param \DevA7mad\Annotations\Events\Generator $generator
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
        // delete events.php file
        $this->generator->clean();

        $this->info('Events cleared successfully!');
    }
}
