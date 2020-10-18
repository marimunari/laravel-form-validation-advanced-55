<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Client::class, 5)->states(Client::TYPE_INDIVIDUAL)->create();
        factory(Client::class, 5)->states(Client::TYPE_LEGAL)->create();
    }
}
