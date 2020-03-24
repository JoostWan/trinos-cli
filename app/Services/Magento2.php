<?php
namespace App\Services;

use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Magento2 extends Command {

    /**
     * Clean Magento 2 cache
     */
    public function flushCache() {

        $this->task("Flush cache", function () {

            $process = new Process(['magerun2', 'cache:flush']);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return true;
        });

    }

}
