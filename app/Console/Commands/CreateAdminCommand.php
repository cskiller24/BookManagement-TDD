<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email=admin@example.com} {password=password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin account as first user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(DB::table('users')->count() > 0) {
            $this->error('Cannot create admin if the database has rows');
            return 1;
        }

        try {
            Validator::make($this->arguments(), [
                'email' => 'required|email',
            ])->validate();
        } catch(ValidationException $e) {
            $this->error($e->getMessage());
            return 1;
        }

        $credentials = [
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
            'is_admin' => true
        ];
        User::factory()->create($credentials);
        $this->info("Created user with email of {$this->argument('email')} and password of \"{$this->argument('password')}\"");
        return 0;
    }
}
