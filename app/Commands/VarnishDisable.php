<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class VarnishDisable extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'varnish:disable';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Disable varnish settings and use Magento full front page cache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->task("Flush Magento 2 cache", function () {

            $process = new Process(['bin/magento', 'cache:flush']);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                return false;
                throw new ProcessFailedException($process);
            }

            return true;
        });

        //$this->info('Done. Shop now uses Magento Fpc');
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
