<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->isLocal()) {
            User::factory()->create([
                'name' => 'Admin',
                'number' => '6969',
                'number_type' => 'NIS',
                'role' => User::ROLES['Admin'],
                'password' => Hash::make('password'),
                'address' => 'America',
                'telephone' => '627878787878',
                'gender' => User::GENDERS['Man'],
            ]);

            User::factory()->create([
                'name' => 'Pustakawan',
                'number' => '9999',
                'number_type' => 'NIS',
                'role' => User::ROLES['Librarian'],
                'password' => Hash::make('password'),
                'address' => 'America',
                'telephone' => '627878787878',
                'gender' => User::GENDERS['Woman'],
            ]);

            $member = User::factory()->create([
                'name' => 'Member',
                'number' => '9696',
                'number_type' => 'NIS',
                'role' => User::ROLES['Member'],
                'password' => Hash::make('password'),
                'address' => 'America',
                'telephone' => '627878787878',
                'gender' => User::GENDERS['Woman'],
            ]);

            $books = Book::factory(10)->create();

            $borrowCount = 10;
            $confirmation = true;
            foreach ($books as $book) {
                Borrow::factory($borrowCount)->create([
                    'confirmation' => $confirmation,
                    'book_id' => $book->id,
                    'user_id' => $member->id,
                ]);

                $borrowCount--;
                $confirmation = !$confirmation;
            }
        }
    }
}
