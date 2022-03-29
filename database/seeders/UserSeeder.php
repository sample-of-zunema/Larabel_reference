<?php
// 6.2.2.1. UserSeederクラス

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\DatabaseManager;
use Illuminate\Contracts\Str;


final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(DatabaseManager $manager, Hasher $hasher): void
    {
        $datetime = Carbon::now()->toDateTimeString();

        $userId = $manager->table('users')
            ->insertGetId(
                [
                    'name' => 'Laravel user',
                    'email' => 'mail@example.com',
                    'password' => $hasher->make('password'),
                    'created_at' => $datetime
                ]
            );
        $manager->table('user_tokens')
            ->insert(
                [
                    'user_id' => $userId,
                    'api_token' => Str::random(60),
                    'created_at' => $datetime
                 ]
            )
    }
}
