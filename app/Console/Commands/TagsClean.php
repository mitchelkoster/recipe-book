<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagsClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tags:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove any unused or duplicate tags from the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info("Converting tags to lower case...");
        Tag::all()->each(function($tag) {
            $lowerCase = Str::of($tag->name)->lower();

            if ($tag->name !== $lowerCase) {
                $tag->name = $lowerCase;
                $tag->save();
            }
        });

        $this->info("Removing un-used tags...");
        Tag::doesntHave('recipes')->each(function($tag) {
            $tag->delete();
        });
    }
}
