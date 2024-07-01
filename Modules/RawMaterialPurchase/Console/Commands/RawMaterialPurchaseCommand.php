<?php

namespace Modules\RawMaterialPurchase\Console\Commands;

use Illuminate\Console\Command;

class RawMaterialPurchaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:RawMaterialPurchaseCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RawMaterialPurchase Command description';

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
