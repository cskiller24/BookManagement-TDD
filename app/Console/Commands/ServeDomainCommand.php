<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeDomainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the project in different domain';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('serve', [
            '--host' => config('app.test_domain', 'api.book-management.test'),
            '--port' => config('app.test_port', 8000)
        ]);
        return 0;
    }
}
