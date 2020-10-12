<?php

namespace App\Commands\Magento2\Data;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SyncMedia extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'sync:media';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Sync media folder from live to local';


    /**
     * Disable frontend and backend recaptcha and flush cache
     *
     * @return mixed
     */
    public function handle()
    {
        $options = array(
            'port' => '',
            'host' => '',
            'username' => '',
            'password' => '',
            'path' => '',
            'exclude' => 'captcha,css,css_secure,downloadable,import,js,tmp,xmlconnect',
            'ignore-permissions' => ''
        );

        $this->task("Sync media", function () {

            $host = $this->ask('Domain or hostname of webshop');
            $port = $this->ask('SSH Port', '339');
            $username = $this->ask('SSH Username');
            $password = $this->ask('SSH Password');
            $path = $this->ask('Path to Magento 2 install');

            $process = new Process(
                [

                    'rsync',
                    '-azP',
                    '-e',
                    '"ssh -p 339"',
                    $username . '@' . $host . $path . '/ .',
                ]
            );
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
