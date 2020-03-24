<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Welcome extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'welcome';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Print some text for testing application';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is your name?');

        $this->info('Welcome ' . $name . ' to Trinos CLI.');
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
