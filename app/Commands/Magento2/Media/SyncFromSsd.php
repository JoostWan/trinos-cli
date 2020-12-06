<?php

namespace App\Commands\Magento2\Media;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SyncfromSsd extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'media:copy-ssd:from';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Copy media folder from external SSD to project folder on Mac';


    /**
     * Copy data from external SSD to internal SSD
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Media folder size on External SSD: ' . $this->calculateFolderSizeOnExternalSsd());

        $this->task("Copy media from external SSD to internal SSD", function () {

            $process = Process::fromShellCommandline('cp -R /Volumes/SSDEXTERN/Sites/media/$FOLDER_NAME/media/ /Users/joost/Sites/$FOLDER_NAME/pub/media/');
            $process->run(null,
                [
                    'FOLDER_NAME' => $this->getCurrentProjectFolderName()
                ]
            );

			if (!$process->isSuccessful()) {
				echo $process->getErrorOutput();
			}

            return true;
        });

        $this->line('Data size copied: ' . $this->calculateFolderSizeOnInternalSsd());

    }

    /**
     * Get current folder
     */
    public function getCurrentFolder()
    {
        $process = new Process(["pwd"]);
        $process->run();

        if ($process->isSuccessful()) {
            return $process->getOutput();
        }
    }

    /**
     * Get current project folder name
     */
    public function getCurrentProjectFolderName()
    {
        // Get project name from folder structure
        $projectName = basename($this->getCurrentFolder());

        // Strip out all white space etc
        $projectName = preg_replace('/\s+/', '', $projectName);

        return $projectName;
    }

    /**
     * Calculate media folder size on External SSD
     */
    private function calculateFolderSizeOnExternalSsd()
    {

        $process = Process::fromShellCommandline('du -sh /Volumes/SSDEXTERN/Sites/media/$FOLDER_NAME/media/ | cut -f1');

        $process->run(null,
            [
                'FOLDER_NAME' => $this->getCurrentProjectFolderName()
            ]
        );

        if ($process->isSuccessful()) {
            return $process->getOutput();
        } else {
            echo $process->getErrorOutput();
        }

    }

    /**
     * Calculate media folder size on Internal SSD
     */
    private function calculateFolderSizeOnInternalSsd()
    {

        $process = Process::fromShellCommandline('du -sh /Users/joost/Sites/$FOLDER_NAME/pub/media/ | cut -f1');

        $process->run(null,
            [
                'FOLDER_NAME' => $this->getCurrentProjectFolderName()
            ]
        );

        if ($process->isSuccessful()) {
            return $process->getOutput();
        } else {
            echo $process->getErrorOutput();
        }

    }
}
