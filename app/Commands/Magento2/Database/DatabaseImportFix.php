<?php

namespace App\Commands\Magento2\Database;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DatabaseImportFix extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'db:import:fix {file}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Fix for import error M2 database Duplicate store id and definer not exist';

    /**
     * Fix SQL file for import
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("This task take up some time depends on the size of the SQL file");

        $this->task("Add sql_mode NO_AUTO_VALUE_ON_ZERO to start of the SQL file ", function () {

            $file = $this->argument('file');

            $process = new Process(["ex","-sc", "1i|SET sql_mode='NO_AUTO_VALUE_ON_ZERO';" , "-cx", $file]);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Remove DEFINER from SQL file with sed", function () {

            $file = $this->argument('file');

            $process = new Process(["sed", "-i", "" , "s/DEFINER=[^*]*\*/\*/g" , $file]);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

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
