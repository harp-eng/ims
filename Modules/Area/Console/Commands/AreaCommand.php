<?php

namespace Modules\Area\Console\Commands;

use Illuminate\Console\Command;

class AreaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AreaCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Area Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
