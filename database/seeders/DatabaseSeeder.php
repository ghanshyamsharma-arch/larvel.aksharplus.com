<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Company;
use App\Models\Message;
use App\Models\PinnedMessage;
use App\Models\ScheduledMessage;
use App\Models\SharedFile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Roles ──────────────────────────────────────────────
        $adminRole  = Role::firstOrCreate(['name' => 'admin']);
        $userRole   = Role::firstOrCreate(['name' => 'user']);

        // ── Permissions ────────────────────────────────────────
        $permissions = [
            'manage_users', 'manage_companies', 'manage_channels',
            'manage_messages', 'manage_files', 'view_analytics',
        ];
        foreach ($permissions as $perm) {
            $p = Permission::firstOrCreate(['name' => $perm]);
            $adminRole->givePermissionTo($p);
        }

        // ── Admin User ─────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@aksharplus.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('password'),
                'status'   => 'active',
            ]
        );
        $admin->assignRole($adminRole);

        // ── Demo Users ─────────────────────────────────────────
        $users = [
            ['name' => 'Sonia Rao',    'email' => 'sonia@aksharplus.com'],
            ['name' => 'Arjun Mehta',  'email' => 'arjun@aksharplus.com'],
            ['name' => 'Priya Kapoor', 'email' => 'priya@aksharplus.com'],
            ['name' => 'Vikram Bose',  'email' => 'vikram@aksharplus.com'],
        ];

        $createdUsers = [];
        foreach ($users as $u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => Hash::make('password'), 'status' => 'active']
            );
            $user->assignRole($userRole);
            $createdUsers[] = $user;
        }

        // ── Companies ──────────────────────────────────────────
        $company1 = Company::firstOrCreate(['slug' => 'akshar-plus-hq'], [
            'name'        => 'Akshar Plus HQ',
            'description' => 'The main Akshar Plus workspace',
            'owner_id'    => $admin->id,
            'plan'        => 'enterprise',
            'status'      => 'active',
        ]);

        $company2 = Company::firstOrCreate(['slug' => 'novabyte-corp'], [
            'name'        => 'NovaByte Corp',
            'description' => 'Technology consulting firm',
            'owner_id'    => $createdUsers[1]->id,
            'plan'        => 'pro',
            'status'      => 'active',
        ]);

        $company3 = Company::firstOrCreate(['slug' => 'pixelcraft-studio'], [
            'name'        => 'Pixelcraft Studio',
            'description' => 'Creative design studio',
            'owner_id'    => $createdUsers[0]->id,
            'plan'        => 'free',
            'status'      => 'active',
        ]);

        // Attach members
        $company1->members()->syncWithoutDetaching([
            $admin->id => ['role' => 'owner', 'joined_at' => now()],
            $createdUsers[0]->id => ['role' => 'admin', 'joined_at' => now()],
            $createdUsers[1]->id => ['role' => 'member', 'joined_at' => now()],
            $createdUsers[2]->id => ['role' => 'member', 'joined_at' => now()],
            $createdUsers[3]->id => ['role' => 'member', 'joined_at' => now()],
        ]);

        // ── Channels ──────────────────────────────────────────
        $channels = [
            ['name' => 'general',      'slug' => 'general',      'type' => 'general',  'is_private' => false],
            ['name' => 'design',       'slug' => 'design',        'type' => 'general',  'is_private' => false],
            ['name' => 'engineering',  'slug' => 'engineering',   'type' => 'general',  'is_private' => false],
            ['name' => 'management',   'slug' => 'management',    'type' => 'private',  'is_private' => true],
            ['name' => 'announcements','slug' => 'announcements', 'type' => 'general',  'is_private' => false],
        ];

        foreach ($channels as $ch) {
            Channel::firstOrCreate(
                ['company_id' => $company1->id, 'slug' => $ch['slug']],
                array_merge($ch, ['company_id' => $company1->id, 'created_by' => $admin->id])
            );
        }

        // ── Sample Messages ────────────────────────────────────
        $general = Channel::where('slug', 'general')->where('company_id', $company1->id)->first();
        if ($general && $general->messages()->count() === 0) {
            $m1 = Message::create([
                'channel_id' => $general->id,
                'sender_id'  => $createdUsers[0]->id,
                'body'       => 'Sprint kickoff notes are now pinned above ☝️',
                'type'       => 'text',
            ]);
            $m2 = Message::create([
                'channel_id' => $general->id,
                'sender_id'  => $createdUsers[1]->id,
                'body'       => 'Video review scheduled for tomorrow 3 PM 🗓️',
                'type'       => 'text',
            ]);
            Message::create([
                'channel_id' => $general->id,
                'sender_id'  => $admin->id,
                'body'       => 'Sounds great! I\'ll share the mockup files 🎨',
                'type'       => 'text',
            ]);

            // Pin a message
            PinnedMessage::firstOrCreate([
                'channel_id' => $general->id,
                'message_id' => $m1->id,
                'pinned_by'  => $admin->id,
            ]);

            // Schedule a message
            ScheduledMessage::create([
                'channel_id'   => $general->id,
                'sender_id'    => $admin->id,
                'body'         => 'Good morning team! 🌟 Sprint 12 begins today. Let\'s make it count!',
                'scheduled_at' => now()->addDay()->setTime(9, 0),
                'status'       => 'pending',
            ]);

            // Sample shared files
            SharedFile::create([
                'company_id'    => $company1->id,
                'channel_id'    => $general->id,
                'message_id'    => $m2->id,
                'uploaded_by'   => $createdUsers[1]->id,
                'original_name' => 'brand-kit-2025.pdf',
                'file_path'     => 'files/sample.pdf',
                'file_type'     => 'document',
                'mime_type'     => 'application/pdf',
                'file_size'     => 5242880,
            ]);
        }

        // Update current company for admin
        $admin->update(['current_company_id' => $company1->id]);

        $this->command->info('✅ Akshar Plus seeded successfully!');
        $this->command->info('📧 Admin: admin@aksharplus.com / password');
    }
}
