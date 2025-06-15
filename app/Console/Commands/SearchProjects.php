<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class SearchProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:search-projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple tool to search projects by name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $optionSelected = select(
            label: 'What do you wanna do?',
            options: [
                'search' => 'Search project by name',
                'quit' => 'Quit'
            ]
        );
        if ($optionSelected == 'search') {
            $search = text('Start searching...');
            $projects = Project::where('name', 'like', '%'.$search.'%')->get();
            if (!$projects->count()) {
                $this->info('No projects found...');
            } else {
                $this->info('This is your results:');
                $this->info('----------------------------------------');
                foreach ($projects as $key => $project) {
                    $this->info($project);
                    $this->info('----------------------------------------');
                }
            }
        } else {
            $this->info('Bye!');
        }
    }
}
