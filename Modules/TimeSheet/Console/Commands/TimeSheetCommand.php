<?php

namespace Modules\TimeSheet\Console\Commands;

use Illuminate\Console\Command;

class TimeSheetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:TimeSheetCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TimeSheet Command description';

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
