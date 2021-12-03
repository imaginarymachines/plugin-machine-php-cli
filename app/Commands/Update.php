<?php
namespace App\Commands;

use App\Updater;
use LaravelZero\Framework\Commands\Command;

class SelfUpdateCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'update';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Self update the Plugin Machine cli';

    /**
     * {@inheritdoc}
     */
    public function handle(Updater $updater)
    {
        $this->output->title('Checking for a new version...');

        $updater->update($this->output);
    }
}
