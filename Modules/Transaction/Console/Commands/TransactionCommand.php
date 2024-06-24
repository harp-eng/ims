<?php

namespace Modules\Transaction\Console\Commands;

use Illuminate\Console\Command;

class TransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:TransactionCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transaction Command description';

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
