<?php

namespace App\Console\Commands;

use App\Models\Credential;
use Illuminate\Console\Command;

class GenerateCredentialHashes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credentials:generate-hashes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate cryptographic hashes for existing credentials that don\'t have them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating hashes for credentials without hashes...');

        $credentialsWithoutHash = Credential::whereNull('credential_hash')
            ->orWhere('credential_hash', '')
            ->get();

        if ($credentialsWithoutHash->isEmpty()) {
            $this->info('All credentials already have hashes generated.');
            return;
        }

        $count = 0;
        foreach ($credentialsWithoutHash as $credential) {
            // Set issued_at if not set
            if (!$credential->issued_at) {
                $credential->issued_at = $credential->created_at;
            }
            
            // Generate hash using the model method
            $credential->credential_hash = $credential->generateCredentialHash();
            $credential->save();
            
            $count++;
            $this->line("Generated hash for credential ID {$credential->id}: {$credential->credential_name}");
        }

        $this->info("Successfully generated hashes for {$count} credentials.");
    }
}
