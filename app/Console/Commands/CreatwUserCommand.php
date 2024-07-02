<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreatwUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A New User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name=$this->option('name');
        $email=$this->option('email');
        $password=$this->option('password');

        $user = User::updateOrInsert(
            [
                'email' => $email
            ],
            [
                'name' => $name,
                'email' => $email,
                'password' => $password ? \bcrypt($password) : \bcrypt('12345'),
            ]
        );

        if ($user) {
            $this->comment('User created successfully');
        } else {
            $this->error('Failed to create user');
        }
    }
}
