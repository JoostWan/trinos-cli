<?php

namespace App\Commands\Magento2\Frontend;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class WatchLess extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'webme:style';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Clean cache files and Watch for *.less files inside Webme theme';

    /**
     * Function for compile less files with Gulp
     *
     * @return mixed
     */
    public function handle()
    {
        $this->task("Remove cached files", function () {

            $process = new Process(['gulp', 'clean']);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Republishes symlinks to the source files for webme theme", function () {

            $process = new Process(['gulp', 'exec', '--trinos']);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->info("Run the following command manual:");
        $this->warn("gulp watch-styles --trinos --live --map");
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
