<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncFromPluginStore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'util:sync-from-plugin-store {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync categories and plugins from plugin store now.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        ray($this->option('force'));
        if (! $this->option('force')) {
            if (! $this->confirm('Make sure to have a queue worker already running or run it afterwards to rebuild search index. Proceed?')) {
                $this->info('Aborting...');

                return 1;
            }
        }

        $this->info('Syncing...');
        (new \App\Actions\SyncFromPluginStore())->sync();
        $this->info('Syncing done.');

        return 0;
    }
}
