<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;

// Add this call inside DatabaseSeeder::run():
// $this->call(BlogSeeder::class);

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $blogs = [
            [
                'title'        => 'Introducing Akshar Plus — The Future of Team Communication',
                'excerpt'      => 'We built Akshar Plus to replace the chaos of juggling multiple apps. Here\'s why we think it\'s the future of how teams communicate.',
                'body'         => '<p>For years, teams have struggled with the same problem: too many tools, too much context-switching, and too much time lost. Slack for chat, Zoom for calls, Dropbox for files — each with its own login, notification system, and monthly bill.</p><h2>The Problem We Solved</h2><p>Akshar Plus was born from frustration. Our founding team spent an average of 2.5 hours per day switching between communication tools. That\'s 12.5 hours per week — nearly a third of a full workday — wasted on tool overhead rather than actual work.</p><p>We asked ourselves: what if everything lived in one place? What if your chat, calls, files, and scheduled messages all worked together seamlessly?</p><h2>What Makes Us Different</h2><p>The answer was Akshar Plus. A platform designed from the ground up to be your team\'s single source of communication truth. Live chat with threading, HD video and audio calling, a smart media library that auto-categorises every file you share, and multi-company workspace management for agencies and enterprises.</p><p>We\'re just getting started. Welcome to the future of team communication.</p>',
                'category'     => 'Product',
                'tags'         => ['launch', 'product', 'team communication'],
                'is_featured'  => true,
                'status'       => 'published',
                'published_at' => now()->subDays(2),
                'views'        => 1842,
            ],
            [
                'title'        => '10 Tips to Run More Effective Remote Team Meetings',
                'excerpt'      => 'Remote meetings don\'t have to be painful. These 10 proven techniques will transform your video calls from time-wasters into productive sessions.',
                'body'         => '<p>Remote work is here to stay — and so are remote meetings. But there\'s a massive difference between a meeting that energises your team and one that drains them. Here\'s how to make yours the former.</p><h2>1. Always Send an Agenda Beforehand</h2><p>A meeting without an agenda is a brainstorming session in disguise. Send a clear agenda at least 24 hours before, listing topics, owners, and time allocations.</p><h2>2. Respect the Clock</h2><p>Start on time, end on time. Every time. This signals to your team that their time is respected — which builds trust and engagement.</p><h2>3. Use Video Calling with Camera On</h2><p>Body language carries 55% of communication. When cameras are off, you\'re operating at a 55% communication deficit. Use Akshar Plus video calling and encourage camera-on culture.</p><h2>4. Designate a Facilitator</h2><p>Every meeting needs a conductor. The facilitator keeps discussion on track, ensures everyone gets heard, and calls time when needed.</p><h2>5. Record and Pin Key Decisions</h2><p>Use Akshar Plus\'s pinned messages to highlight key decisions in your team channel immediately after each meeting. This creates a searchable record that replaces long email threads.</p>',
                'category'     => 'Productivity',
                'tags'         => ['remote work', 'meetings', 'productivity', 'tips'],
                'is_featured'  => false,
                'status'       => 'published',
                'published_at' => now()->subDays(5),
                'views'        => 934,
            ],
            [
                'title'        => 'How Multi-Company Workspaces Are Changing Agency Life',
                'excerpt'      => 'Managing five client accounts used to mean five logins. Here\'s how agencies are using Akshar Plus multi-company workspaces to simplify everything.',
                'body'         => '<p>If you run a digital agency, you know the pain. Client A uses one tool, Client B insists on another, and your own team has its own preferences. You spend more time managing tool access than managing projects.</p><h2>The Agency Problem</h2><p>The average agency employee manages access to 14 different client systems. That\'s 14 different passwords, 14 different notification channels, and 14 different contexts to switch between every single day.</p><h2>The Multi-Company Solution</h2><p>Akshar Plus\'s multi-company workspace feature changes this completely. One login. Unlimited companies. Instant switching — no re-authentication, no context loss. Each workspace is completely isolated with its own channels, files, members, and settings.</p><h2>Role-Based Access That Actually Works</h2><p>Assign team members as Owner, Admin, Manager, or Member per company. A junior designer can have full access to the creative workspace but view-only access to client communication channels. All controlled from one dashboard.</p>',
                'category'     => 'Business',
                'tags'         => ['agency', 'multi-company', 'workflow', 'enterprise'],
                'is_featured'  => true,
                'status'       => 'published',
                'published_at' => now()->subDays(8),
                'views'        => 621,
            ],
            [
                'title'        => 'Why Scheduled Messages Are the Secret to Better Async Communication',
                'excerpt'      => 'Sending messages at 11 PM isn\'t fair to your team. Scheduled messages let you write when inspired and send when appropriate.',
                'body'         => '<p>You\'re a night owl. Your best thinking happens after 10 PM. But your team is scattered across three time zones and your 11 PM burst of insight shouldn\'t become their 6 AM notification.</p><h2>Async Communication Done Right</h2><p>Great async communication is about sending the right message at the right time — not necessarily when you write it. Scheduled messages in Akshar Plus let you compose when you\'re in flow and deliver when your team is ready to receive.</p><h2>Real-World Use Cases</h2><p><strong>Monday morning kickoffs:</strong> Write your team\'s weekly priorities on Friday afternoon, schedule for Monday 9 AM. Your team starts the week with context and direction without you having to remember to send it.</p><p><strong>Cross-timezone updates:</strong> Working with a team in India and one in the UK? Schedule updates to land at the start of each team\'s workday rather than the middle of the night.</p><p><strong>Automated reminders:</strong> Schedule deadline reminders three days out, one day out, and morning-of. Set it once, let Akshar Plus handle the follow-through.</p>',
                'category'     => 'Features',
                'tags'         => ['async', 'scheduled messages', 'remote work', 'features'],
                'is_featured'  => false,
                'status'       => 'published',
                'published_at' => now()->subDays(12),
                'views'        => 487,
            ],
            [
                'title'        => 'The Complete Guide to Akshar Plus Media Library',
                'excerpt'      => 'Stop hunting through old messages for that file someone shared three weeks ago. Here\'s how the Akshar Plus media library keeps everything organised.',
                'body'         => '<p>Every team has experienced it: "I know someone shared that design file in the chat... was it last week? Or the week before?" Then you spend 20 minutes scrolling through message history to find a single attachment.</p><h2>Auto-Organisation That Actually Works</h2><p>The Akshar Plus media library automatically categorises every file shared in any channel into five types: Images, Videos, Audio, Documents, and Links. No manual filing. No folder structures to maintain. Just share, and the library does the rest.</p><h2>Finding Files Instantly</h2><p>Every file is searchable by name, uploader, channel, and date. Filter by type with one click. The entire library is available at the company level — so you can see all assets shared across every channel in one view.</p><h2>What Gets Captured</h2><ul><li>Images: PNG, JPG, GIF, WebP with thumbnail preview</li><li>Videos: MP4, MOV with duration display</li><li>Audio: MP3, WAV, M4A with waveform visualisation</li><li>Documents: PDF, DOCX, XLSX with file size</li><li>Links: URLs with title and favicon preview</li></ul>',
                'category'     => 'Features',
                'tags'         => ['media library', 'files', 'organisation', 'features'],
                'is_featured'  => false,
                'status'       => 'published',
                'published_at' => now()->subDays(18),
                'views'        => 312,
            ],
            [
                'title'        => 'Akshar Plus vs Slack: An Honest Comparison',
                'excerpt'      => 'We know what you\'re thinking: another Slack competitor? Here\'s an honest, feature-by-feature comparison — including where Slack still wins.',
                'body'         => '<p>We\'re biased. Obviously. But we\'ve tried to write the most honest comparison we can — because we think if you understand the real differences, you\'ll see why Akshar Plus makes sense for a lot of teams.</p><h2>Where Akshar Plus Wins</h2><p><strong>Integrated calling:</strong> Akshar Plus includes HD video and audio calling in every plan. Slack requires a paid upgrade and integrates with Zoom or Huddles, adding tool overhead.</p><p><strong>Multi-company:</strong> If you manage multiple companies or clients, Akshar Plus is built for this. Slack requires separate workspaces with separate logins.</p><p><strong>Media library:</strong> Auto-organised file management is built in. Slack search for files works, but there\'s no visual media library.</p><h2>Where Slack Still Wins</h2><p>Slack\'s app marketplace has thousands of integrations. Akshar Plus is newer and we\'re building our integration ecosystem. If your workflow depends on specific third-party apps, check our integrations page before switching.</p><p>Slack also has more mature admin controls for very large enterprises. We\'re catching up fast.</p>',
                'category'     => 'Business',
                'tags'         => ['comparison', 'slack', 'features', 'business'],
                'is_featured'  => false,
                'status'       => 'published',
                'published_at' => now()->subDays(22),
                'views'        => 1203,
            ],
        ];

        foreach ($blogs as $data) {
            Blog::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($data['title'])],
                array_merge($data, ['author_id' => $admin->id])
            );
        }

        $this->command->info('✅ Blog posts seeded!');
    }
}
