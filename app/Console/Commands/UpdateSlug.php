<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Ads;

class UpdateSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all field slug table ads';

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
     * @return int
     */
    public function handle()
    {
        /* $adsis = Ads::all();
        $adsis->each(function(Ads $ads){
            $ads->slug = SlugService::createSlug(Ads::class, 'slug', $ads->title);
            $ads->save();  
        });
        return Command::SUCCESS;
         */
    }
}
