<?php

namespace Modules\Ingredient\Console\Commands;

use Illuminate\Console\Command;

class IngredientCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:IngredientCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingredient Command description';

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
