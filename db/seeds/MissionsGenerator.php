<?php

use Phinx\Seed\AbstractSeed;

class MissionsGenerator extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $fakeMissions = [];
        for ($i = 0; $i < 10; $i++) {
            $fakeMissions[] = $this->getFakeMission();
        }

        $this->insert('filegame_booth_missions', $fakeMissions);
    }

    private function getFakeMission()
    {
        $faker = Faker\Factory::create();

        $misison = [
            'passwd' => rand(10000000, 99999999),
            'mission' => $faker->realText(30),
            'mission_info' => $faker->realText(100),
            'reward' => $faker->randomFloat(),
            'booth_name' => $faker->bs,
            'booth_info' => $faker->realText(100),
            'expired_at' => $faker->dateTimeInInterval('', '+ 7 days')->format('Y-m-d H:i:s'),
        ];

        return $misison;
    }
}
