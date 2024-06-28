<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Venue;
use App\Models\Fixture;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Transporter\Requests\FixturesRequest;

class FootballApiFetchFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'football-api:fixtures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve the fixtures from the Football API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = FixturesRequest::build()
            ->withQuery([
                'league' => config('services.football-api.league'),
                'season' => config('services.football-api.season'),
            ])
            ->send()
            ->collect();

        collect($data->get('response'))->each(fn ($fixture) => $this->insertOrUpdate($fixture));

        return Command::SUCCESS;
    }

    private function insertOrUpdate(array $fixture): void
    {
        $venue = $this->venue($fixture);

        Fixture::updateOrCreate(
            [
                'id' => $fixture['fixture']['id'],
            ],
            [
                'date' => Carbon::parse($fixture['fixture']['date']),
                'home_team_id' => $fixture['teams']['home']['id'],
                'away_team_id' => $fixture['teams']['away']['id'],
                'venue_id'  => $venue->id,
                'stage' => $this->round($fixture),
            ]
        );
    }

    private function venue(array $fixture): Venue
    {
        return Venue::firstOrCreate([
            'name' => $fixture['fixture']['venue']['name'],
            'city' => $fixture['fixture']['venue']['city'],
        ]);
    }

    private function round(array $fixture): string
    {
        if (Str::startsWith($fixture['league']['round'], 'Group')) {
            return 'Group';
        }

        return $fixture['league']['round'];
    }
}
