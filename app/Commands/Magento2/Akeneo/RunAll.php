<?php

namespace App\Commands\Magento2\Akeneo;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Services\Magento2;

class RunAll extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'akeneo:run';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Run all commands to import data from Akeneo';

    public function Magento2() {
        return new \App\Services\Magento2;
    }

    /**
     * Disable frontend and backend recaptcha and flush cache
     *
     * @return mixed
     */
    public function handle()
    {
        $start = microtime(true);

        $this->task("Import category", function () {

            $process = new Process(['bin/magento', 'akeneo_connector:import', '--code=category']);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Import family", function () {

            $process = new Process(['bin/magento', 'akeneo_connector:import', '--code=family']);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Import attribute", function () {

            $process = new Process(['bin/magento', 'akeneo_connector:import', '--code=attribute']);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Import option", function () {

            $process = new Process(['bin/magento', 'akeneo_connector:import', '--code=option']);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Import product_model", function () {

            $process = new Process(['bin/magento', 'akeneo_connector:import', '--code=product_model']);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Import family_variant", function () {

            $process = new Process(['bin/magento', 'akeneo_connector:import', '--code=family_variant']);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Import product", function () {

            $process = new Process(['bin/magento', 'akeneo_connector:import', '--code=product']);
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $time_elapsed_secs = microtime(true) - $start;

        $this->info("Import done in " . intval($time_elapsed_secs) . " seconds.");
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
