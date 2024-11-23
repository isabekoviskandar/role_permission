<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class UserStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Create the user with the provided data
        for ($i=0; $i < 3000; $i++) { 
            $user = User::create([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'password' => Hash::make($this->data['password']),
            ]);
    
            if (isset($this->data['roles'])) {
                $user->roles()->sync($this->data['roles']);
            }
        }
    }
}
