<?php

namespace Modules\Supplier\Console\Commands;

use Illuminate\Console\Command;

class SupplierCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SupplierCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Supplier Command description';

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
