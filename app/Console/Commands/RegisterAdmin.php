<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register admin user to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $credentials = [
            'name' => $this->ask('Nama'),
            'number_type' => $this->choice(
                'Tipe Nomor',
                User::NUMBER_TYPES,
            ),
            'number' => $this->ask('Nomor'),
            'address' => $this->ask('Alamat'),
            'telephone' => $this->ask('Nomor Telepon'),
            'gender' => $this->choice(
                'Jenis Kelamin',
                ['Laki-laki', 'Perempuan'],
            ),
            'password' => $this->secret('Password'),
            'role' => User::ROLES['Admin'],  
        ];

        $password = $credentials['password'];
        $credentials['password'] = Hash::make($password);

        $user = User::create($credentials);

        $this->table(
            ['Nomor', 'Password'],
            [[$user->number, $password]],
        );

        return Command::SUCCESS;
    }
}
