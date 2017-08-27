<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;

class UpdateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slug:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill the slug column for all posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Post::all()
            ->each(function($post) {
                $post->slug = str_slug($post->title);
                $post->save();
            });

        $this->info('Slugs Updated Successfully');
    }
}
