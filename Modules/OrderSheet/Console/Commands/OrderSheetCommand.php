<?php

namespace Modules\OrderSheet\Console\Commands;

use Illuminate\Console\Command;

class OrderSheetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:OrderSheetCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'OrderSheet Command description';

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
