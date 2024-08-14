<?php

namespace Modules\Address\Console\Commands;

use Illuminate\Console\Command;

class AddressCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AddressCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Address Command description';

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
