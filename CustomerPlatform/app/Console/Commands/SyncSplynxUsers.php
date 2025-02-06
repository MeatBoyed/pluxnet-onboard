<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;
use App\Models\User;


class SyncSplynxUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-splynx-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync user data from Splynx CSV to Laravel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $csvPath = storage_path('splynx_users.csv'); // Adjust the path

        if (!file_exists($csvPath)) {
            $this->error("CSV file not found: $csvPath");
            return;
        }

        // Read CSV File
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // Assume first row contains headers

        foreach ($csv as $record) {
            $this->syncUser($record);
        }

        $this->info("Splynx CSV sync completed.");
    }

    private function syncUser(array $record)
    {
        $user = User::updateOrCreate(
            ['email' => $record['email']], // Find user by email
            [
                'name' => $record['name'],
                'password' => Hash::make($record['password']), // Rehash password
                'splynx_id' => $record['splynx_id'], // Track original Splynx ID
            ]
        );

        $this->info("Synced user: {$user->email}");
    }
}
