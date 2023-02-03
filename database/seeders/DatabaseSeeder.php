<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Restore;
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

            $bookIds = Book::factory(6)->create()->pluck('id');

            $borrowCount = count($bookIds);
            foreach ($bookIds as $bookId) {
                $borrows = Borrow::factory($borrowCount)->create([
                    'book_id' => $bookId,
                    'user_id' => $member->id,
                    'confirmation' => true,
                ]);

                if ($borrowCount >= 4) {
                    Restore::factory()->create([
                        'returned_at' => now()->addDays($borrows[0]->duration + 1),
                        'fine' => 10000,
                        'confirmation' => false,
                        'status' => Restore::STATUSES['Fine not paid'],
                        'book_id' => $bookId,
                        'user_id' => $member->id,
                        'borrow_id' => $borrows[0]->id,
                    ]);

                    Restore::factory()->create([
                        'confirmation' => true,
                        'status' => Restore::STATUSES['Returned'],
                        'book_id' => $bookId,
                        'user_id' => $member->id,
                        'borrow_id' => $borrows[1]->id,
                    ]);

                    Restore::factory()->create([
                        'returned_at' => now()->addDays($borrows[0]->duration + 1),
                        'confirmation' => false,
                        'status' => Restore::STATUSES['Past due'],
                        'book_id' => $bookId,
                        'user_id' => $member->id,
                        'borrow_id' => $borrows[2]->id,
                    ]);

                    Restore::factory()->create([
                        'confirmation' => false,
                        'status' => Restore::STATUSES['Not confirmed'],
                        'book_id' => $bookId,
                        'user_id' => $member->id,
                        'borrow_id' => $borrows[3]->id,
                    ]);
                }

                Borrow::factory()->create([
                    'book_id' => $bookId,
                    'user_id' => $member->id,
                    'confirmation' => false,
                ]);

                $borrowCount--;
            }
        }
    }
}
