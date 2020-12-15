<?php

namespace Tepuilabs\LaravelInstapago\Commands;

use Illuminate\Console\Command;

class LaravelInstapagoCommand extends Command
{
    public $signature = 'laravel-instapago';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
