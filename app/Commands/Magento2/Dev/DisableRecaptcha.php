<?php

namespace App\Commands\Magento2\Dev;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Services\Magento2;

class DisableRecaptcha extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'dev:disable:recaptcha';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Disable default Magento 2 Recaptcha function';

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

        $this->task("Disable Magento 2 default Recaptcha backend", function () {

            $process = new Process(['magerun2', 'config:store:set', 'msp_securitysuite_recaptcha/backend/enabled', 0]);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Disable Magento 2 default Recaptcha frontend", function () {

            $process = new Process(['magerun2', 'config:store:set', 'msp_securitysuite_recaptcha/backend/enabled', 0]);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

        $this->task("Flush Magento 2 cache", function () {

            $process = new Process(['magerun2', 'cache:flush']);
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
