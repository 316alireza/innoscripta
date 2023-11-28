<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\GuardianService;
use App\Statics\NewsAgencies;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GuardianArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:guardian-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $articles = new GuardianService();
        $articles->setURL();
        $articles->setAPIKey();
        $articles = $articles->fetchData()->json()['response']['results'];

        $data = [];
        foreach ($articles as $article) {
            if (!Article::where('source_id', $article['id'])->exists()) {
                $data[] = [
                    'source' => NewsAgencies::GUARDIAN,
                    'source_id' => $article['id'],
                    'section' => $article['sectionName'],
                    'published_at' => Carbon::parse($article['webPublicationDate']),
                    'title' => $article['webTitle'],
                    'web_url' => $article['webUrl'],
                    'api_url' => $article['apiUrl'],
                    'created_at' => now(),
                ];
            }
        }
        DB::table('articles')->insert($data);

        $this->info('The command was successful!');
    }
}
