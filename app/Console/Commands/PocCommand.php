<?php

namespace App\Console\Commands;

use App\Jobs\ProcessRecord;
use App\Models\Record;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redis;

class PocCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:poc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShouldBeUnique issue reproduction command.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Redis::flushdb();
        Record::truncate();

        $r = Record::create(['name' => 'test']);

        ProcessRecord::dispatch($r);
        $r->delete();
        Artisan::call('queue:work', ['--once' => true]);

        $keys = Redis::keys('*');
        if (!$keys) {
            $this->info('No keys found in Redis, lock removed');
        } else {
            $this->error('Keys found in Redis, lock not removed');
            dump($keys);
        }
    }
}
