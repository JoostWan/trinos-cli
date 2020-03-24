<?php

namespace App\Commands\Magento2\Dev;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class WatchLog extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'dev:log';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Watch for log file changes from Magento and PHP errors';

    /**
     * Function for compile less files with Gulp
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Run the following command manual:");
        $this->warn("tail -f var/log/system.log -f var/log/debug.log -f -f var/log/exception.log \$HOME/.valet/Log/php.log");
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
