<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;

class ProjectTaskSeeder extends Seeder
{
    public function run(): void
    {
        // ========== ADMIN USER ==========
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin', // Admin role
        ]);

        echo "✅ Admin created: admin@example.com (password: password)\n";

        // ========== REGULAR USER 1 ==========
        $user1 = User::create([
            'name' => 'Mahbub',
            'email' => 'msufianbd92@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
        ]);

        echo "✅ User 1 created: john@example.com (password: password)\n";

        // ========== REGULAR USER 2 ==========
        $user2 = User::create([
            'name' => 'Rejaul',
            'email' => 'rejaul@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
        ]);

        echo "✅ User 2 created: jane@example.com (password: password)\n";

        // ========== ADMIN'S PROJECTS ==========
        $adminProject = Project::create([
            'name' => 'Admin Dashboard Redesign',
            'description' => 'Redesign the admin panel with modern UI/UX',
            'user_id' => $admin->id,
        ]);

        Task::create([
            'project_id' => $adminProject->id,
            'title' => 'Create Wireframes',
            'description' => 'Design initial wireframes for admin panel',
            'status' => 'completed',
            'due_date' => Carbon::now()->subDays(5),
        ]);

        Task::create([
            'project_id' => $adminProject->id,
            'title' => 'Implement Role Management',
            'description' => 'Add role-based access control',
            'status' => 'in-progress',
            'due_date' => Carbon::now()->addDays(2),
        ]);

        echo "✅ Admin project created with 2 tasks\n";

        // ========== USER 1'S PROJECTS ==========
        
        // Project 1
        $project1 = Project::create([
            'name' => 'E-commerce Website',
            'description' => 'Build online store with payment gateway integration',
            'user_id' => $user1->id,
        ]);

        Task::create([
            'project_id' => $project1->id,
            'title' => 'Setup Laravel Project',
            'description' => 'Initialize Laravel with authentication',
            'status' => 'completed',
            'due_date' => Carbon::now()->subDays(10),
        ]);

        Task::create([
            'project_id' => $project1->id,
            'title' => 'Design Product Pages',
            'description' => 'Create product listing and detail pages',
            'status' => 'in-progress',
            'due_date' => Carbon::now()->addDays(3),
        ]);

        Task::create([
            'project_id' => $project1->id,
            'title' => 'Integrate Payment Gateway',
            'description' => 'Add Stripe payment integration',
            'status' => 'pending',
            'due_date' => Carbon::now()->addDays(7),
        ]);

        Task::create([
            'project_id' => $project1->id,
            'title' => 'Shopping Cart Feature',
            'description' => 'Implement add to cart functionality',
            'status' => 'pending',
            'due_date' => Carbon::now()->addDays(5),
        ]);

        // Project 2
        $project2 = Project::create([
            'name' => 'Marketing Campaign',
            'description' => 'Q4 2024 social media marketing strategy',
            'user_id' => $user1->id,
        ]);

        Task::create([
            'project_id' => $project2->id,
            'title' => 'Research Target Audience',
            'description' => 'Conduct market research and analysis',
            'status' => 'completed',
            'due_date' => Carbon::now()->subDays(3),
        ]);

        Task::create([
            'project_id' => $project2->id,
            'title' => 'Create Content Calendar',
            'description' => 'Plan social media posts for next month',
            'status' => 'in-progress',
            'due_date' => Carbon::now()->addDays(1),
        ]);

        Task::create([
            'project_id' => $project2->id,
            'title' => 'Design Graphics',
            'description' => 'Create promotional graphics for campaigns',
            'status' => 'pending',
            'due_date' => Carbon::now()->subDays(1), // Overdue
        ]);

        echo "✅ User 1 (John) projects created: 2 projects, 7 tasks\n";

        // ========== USER 2'S PROJECTS ==========
        
        // Project 3
        $project3 = Project::create([
            'name' => 'Mobile App Development',
            'description' => 'React Native iOS and Android application',
            'user_id' => $user2->id,
        ]);

        Task::create([
            'project_id' => $project3->id,
            'title' => 'Setup React Native Environment',
            'description' => 'Configure development environment with Expo',
            'status' => 'completed',
            'due_date' => Carbon::now()->subDays(8),
        ]);

        Task::create([
            'project_id' => $project3->id,
            'title' => 'Build Authentication Screens',
            'description' => 'Implement login and registration UI',
            'status' => 'in-progress',
            'due_date' => Carbon::today(), // Due today
        ]);

        Task::create([
            'project_id' => $project3->id,
            'title' => 'API Integration',
            'description' => 'Connect mobile app with backend API',
            'status' => 'pending',
            'due_date' => Carbon::now()->addDays(4),
        ]);

        Task::create([
            'project_id' => $project3->id,
            'title' => 'Push Notifications',
            'description' => 'Implement Firebase push notifications',
            'status' => 'pending',
            'due_date' => Carbon::now()->addDays(6),
        ]);

        // Project 4
        $project4 = Project::create([
            'name' => 'Company Website Redesign',
            'description' => 'Complete redesign of corporate website',
            'user_id' => $user2->id,
        ]);

        Task::create([
            'project_id' => $project4->id,
            'title' => 'Design Homepage Mockup',
            'description' => 'Create initial design mockups for homepage',
            'status' => 'completed',
            'due_date' => Carbon::now()->subDays(5),
        ]);

        Task::create([
            'project_id' => $project4->id,
            'title' => 'Develop Frontend Components',
            'description' => 'Build reusable React components',
            'status' => 'in-progress',
            'due_date' => Carbon::now()->addDays(3),
        ]);

        Task::create([
            'project_id' => $project4->id,
            'title' => 'Setup Backend API',
            'description' => 'Create REST API endpoints',
            'status' => 'pending',
            'due_date' => Carbon::now()->addDays(7),
        ]);

        echo "✅ User 2 (Jane) projects created: 2 projects, 7 tasks\n";

        // ========== ADDITIONAL PROJECTS FOR VARIETY ==========
        
        $project5 = Project::create([
            'name' => 'Blog Platform',
            'description' => 'Build a modern blogging platform',
            'user_id' => $user1->id,
        ]);

        Task::create([
            'project_id' => $project5->id,
            'title' => 'Database Schema Design',
            'description' => 'Design database structure for blog',
            'status' => 'completed',
            'due_date' => Carbon::now()->subDays(4),
        ]);

        Task::create([
            'project_id' => $project5->id,
            'title' => 'Rich Text Editor',
            'description' => 'Integrate WYSIWYG editor',
            'status' => 'pending',
            'due_date' => Carbon::now()->addDays(2),
        ]);

        echo "✅ Additional project created\n";

        // ========== SUMMARY ==========
        echo "\n📊 SEEDING SUMMARY:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "👥 Users: " . User::count() . " (1 admin, 2 regular users)\n";
        echo "📁 Projects: " . Project::count() . "\n";
        echo "✅ Tasks: " . Task::count() . "\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        
        echo "🔐 LOGIN CREDENTIALS:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "Admin:  admin@gmail.com / password\n";
        echo "User 1: msufianbd92@gmail.com / password\n";
        echo "User 2: rejaul@gmail.com / password\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    }
}