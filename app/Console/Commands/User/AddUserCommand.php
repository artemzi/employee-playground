<?php

namespace EmployeeDirectory\Console\Commands\User;

use EmployeeDirectory\Entity\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddUserCommand extends Command
{
    protected $signature = 'user:add {name} {email} {password}';

    protected $description = 'Create new user.';

    public function handle(): bool
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->argument('password');
        try {
            $user = new User();
            $user->password = Hash::make($password);
            $user->name = $name;
            $user->email = $email;
            $user->save();
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }
        $this->info("User {$name} is successfully created");
        return true;
    }
}
