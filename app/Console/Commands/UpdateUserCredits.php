<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\VirtualCurrency;

class UpdateUserCredits extends Command
{
    protected $signature = 'update:user-credits';

    protected $description = 'Update user credits to 120 for all users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (!$user->virtualCurrency) {
                $user->virtualCurrency()->create(['balance' => 120]);
            }
        }
        $this->info('User credits updated successfully.');
    }
}
