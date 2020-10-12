<?php

namespace App\Commands\Magento2\Dev;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DisableModulesByVendorName extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'dev:module:disable';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Disable all modules for specific vendor';

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
        $this->task("Disable all modules for specific vendor", function () {

            $vendorName = $this->ask('Enter the vendor name for which you want to disable all module');

            $process = Process::fromShellCommandline('bin/magento module:status | grep "$VENDOR" | grep -v List | grep -v None | grep -v -e "^$" | xargs bin/magento module:disable -f');
            $process->run(null, ['VENDOR' => $vendorName]);

            if ($process->isSuccessful()) {
                echo $process->getOutput();
            }

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });
    }
}
