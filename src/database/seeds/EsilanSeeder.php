<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;


class EsilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Esilan with two ticket types
        factory(App\Esilan::class, 1)->create()->each(function($e){
            $e->ticketTypes()->save(factory(App\TicketType::class)->make());
            $e->ticketTypes()->save(factory(App\TicketType::class)->make());
        });

        // Create Lambda user
        factory(App\User::class, 2)->create();

        // Create game
        factory(App\Game::class, 2)->create();

        // Users buy ticket
        DB::table('tickets')->insert([
            'idGamer' => 1,
            'idTicketType' => 1,
            'dateCreation' => new DateTime()
        ]);
        DB::table('tickets')->insert([
            'idGamer' => 2,
            'idTicketType' => 2,
            'dateCreation' => new DateTime()
        ]);

        // Create tournament
        $dateTour1 = new DateTime("2018-07-03 20:00:00");
        $dateTour15 = new DateTime("2018-07-03 21:00:00");
        DB::table('tournaments')->insert([
            'idEsilan' => 1,
            'idGame' => 1,
            'name' => "Tournois 1",
            'beginDate' => $dateTour1,
            'endDate' => $dateTour15
        ]);
        $dateTour2 = new DateTime("2018-07-03 22:00:00");
        $dateTour25 = new DateTime("2018-07-03 23:00:00");
        DB::table('tournaments')->insert([
            'idEsilan' => 1,
            'idGame' => 2,
            'name' => "Tournois 2",
            'beginDate' => $dateTour2,
            'endDate' => $dateTour25
        ]);

        // Association tournament with TicketType
        DB::table('tick_tour_compatibilities')->insert([
            'idTournament' => 1,
            'idTicketType' => 1,
        ]);
        DB::table('tick_tour_compatibilities')->insert([
            'idTournament' => 2,
            'idTicketType' => 2,
        ]);

        factory(App\Esilan::class, 10)->create()->each(function($e){
            $e->ticketTypes()->save(factory(App\TicketType::class)->make());
            $e->ticketTypes()->save(factory(App\TicketType::class)->make());
        });
    }
}
