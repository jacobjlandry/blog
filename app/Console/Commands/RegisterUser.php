<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome to the new user wizard.  My name is Rudolphio and I am here to help you today.');

        $this->info('First, let me ask you a few simple questions.');

        $firstName = $this->ask('What is your first name?');
        $lastName = $this->ask('What is your last name?');
        $email = $this->ask('What is your email?');

        $this->info('Great! Now comes the hard one...');

        $password = Hash::make($this->ask('Enter a password'));

        $this->info('Thanks! I will go ahead and submit this request. Wait right here...');

        $user = new User();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->password = $password;
        $user->role = 'admin';
        $user->save();

        $this->info('Good news! User ' . $firstName . ' ' . $lastName . '(' . $email . ') has been created! Happy blogging!');
    }
}
