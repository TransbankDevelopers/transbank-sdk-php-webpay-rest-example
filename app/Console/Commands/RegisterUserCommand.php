<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterUserCommand extends Command
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
    protected $description = 'Register a new user via the command line';

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
        $name = $this->ask('¿Cuál es el nombre del usuario?');
        $email = $this->ask('¿Cuál es el correo electrónico del usuario?');
        $password = $this->secret('¿Cuál es la contraseña del usuario?');

        if (User::where('email', $email)->exists()) {
            $this->error('Ya existe un usuario con ese correo electrónico.');
            return 1;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("¡El usuario {$name} ha sido registrado exitosamente!");

        return 0;
    }
}
