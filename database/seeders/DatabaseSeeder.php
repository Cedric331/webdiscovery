<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Prospect;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer des utilisateurs administrateurs
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'test@test.fr',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Créer des utilisateurs normaux
        $users = User::factory()
            ->count(5)
            ->create();

        // Créer des clients avec leurs contacts
        $customers = Customer::factory()
            ->count(15)
            ->create()
            ->each(function ($customer) {
                // Créer 1-3 contacts par client
                $contactsCount = rand(1, 3);
                Contact::factory()
                    ->count($contactsCount)
                    ->for($customer)
                    ->create();

                // Le premier contact est toujours le contact principal
                $customer->contacts()->first()?->update(['is_primary' => true]);
            });

        // Créer des prospects (certains liés à des clients existants)
        $prospects = Prospect::factory()
            ->count(10)
            ->create()
            ->each(function ($prospect) use ($customers) {
                // 70% des prospects sont liés à un client existant
                if (rand(1, 10) <= 7 && $customers->isNotEmpty()) {
                    $prospect->update([
                        'customer_id' => $customers->random()->id,
                    ]);
                }
            });

        // Créer des projets (tous liés à des clients)
        $projects = Project::factory()
            ->count(20)
            ->create()
            ->each(function ($project) use ($customers, $users) {
                // Assigner un client aléatoire
                $project->update([
                    'customer_id' => $customers->random()->id,
                ]);

                // 80% des projets ont un responsable assigné
                if (rand(1, 10) <= 8 && $users->isNotEmpty()) {
                    $project->update([
                        'user_id' => $users->random()->id,
                    ]);
                }
            });

        // Créer des tâches (liées aux projets, clients et utilisateurs)
        Task::factory()
            ->count(50)
            ->create()
            ->each(function ($task) use ($projects, $customers, $users) {
                // 60% des tâches sont liées à un projet
                if (rand(1, 10) <= 6 && $projects->isNotEmpty()) {
                    $project = $projects->random();
                    $task->update([
                        'project_id' => $project->id,
                        'customer_id' => $project->customer_id,
                    ]);
                } elseif ($customers->isNotEmpty()) {
                    // Sinon, lier à un client aléatoire
                    $task->update([
                        'customer_id' => $customers->random()->id,
                    ]);
                }

                // 70% des tâches ont un utilisateur assigné
                if (rand(1, 10) <= 7 && $users->isNotEmpty()) {
                    $task->update([
                        'user_id' => $users->random()->id,
                    ]);
                }
            });

        // Créer des réunions (liées aux clients, prospects et utilisateurs)
        Meeting::factory()
            ->count(30)
            ->create()
            ->each(function ($meeting) use ($customers, $prospects, $users) {
                // 60% des réunions sont liées à un client
                if (rand(1, 10) <= 6 && $customers->isNotEmpty()) {
                    $meeting->update([
                        'customer_id' => $customers->random()->id,
                    ]);
                }

                // 30% des réunions sont liées à un prospect
                if (rand(1, 10) <= 3 && $prospects->isNotEmpty()) {
                    $prospect = $prospects->random();
                    $meeting->update([
                        'prospect_id' => $prospect->id,
                        // Si le prospect a un client, lier aussi la réunion au client
                        'customer_id' => $prospect->customer_id ?? $meeting->customer_id,
                    ]);
                }

                // 80% des réunions ont un organisateur
                if (rand(1, 10) <= 8 && $users->isNotEmpty()) {
                    $meeting->update([
                        'user_id' => $users->random()->id,
                    ]);
                }
            });

        $this->command->info('✅ Seeders terminés avec succès !');
        $this->command->info('📊 Statistiques :');
        $this->command->info('   - Utilisateurs : '.User::count());
        $this->command->info('   - Clients : '.Customer::count());
        $this->command->info('   - Contacts : '.Contact::count());
        $this->command->info('   - Prospects : '.Prospect::count());
        $this->command->info('   - Projets : '.Project::count());
        $this->command->info('   - Tâches : '.Task::count());
        $this->command->info('   - Réunions : '.Meeting::count());
        $this->command->info('');
        $this->command->info('🔐 Connexion admin :');
        $this->command->info('   Email: admin@example.com');
        $this->command->info('   Password: password');
    }
}
