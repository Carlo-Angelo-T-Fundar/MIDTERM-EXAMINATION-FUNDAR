<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * AnnouncementSeeder
 * 
 * Seeds the announcements table with sample data for testing
 * This is useful for development and demonstration purposes
 */
class AnnouncementSeeder extends Seeder
{
    /**
     * Run the seeder - inserts sample announcement records
     */
    public function run()
    {
        // Sample announcement data - array of announcement records
        $data = [
            [
                'title'      => 'Welcome to the Student Portal!',
                'content'    => 'We are excited to announce the launch of our new Online Student Portal. Here you can access your courses, view grades, submit assignments, and stay updated with the latest announcements. Please take some time to explore the features and let us know if you have any questions or feedback.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')), // Posted 2 days ago
            ],
            [
                'title'      => 'Midterm Examination Schedule',
                'content'    => 'The midterm examinations will be held from October 20-27, 2025. Please check your individual course schedules for specific dates and times. Make sure to review all course materials and complete any pending assignments before the exam period. Good luck to all students!',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')), // Posted 1 day ago
            ],
            [
                'title'      => 'System Maintenance Notice',
                'content'    => 'Please be informed that the Student Portal will undergo scheduled maintenance on October 18, 2025, from 10:00 PM to 2:00 AM. During this time, the system will be temporarily unavailable. We apologize for any inconvenience this may cause. Thank you for your understanding.',
                'created_at' => date('Y-m-d H:i:s'), // Posted today
            ],
        ];

        // Insert the sample data into the announcements table
        // Using Query Builder for better performance with multiple inserts
        $this->db->table('announcements')->insertBatch($data);
        
        // Alternative method using the model (commented out):
        // $announcementModel = new \App\Models\AnnouncementModel();
        // foreach ($data as $announcement) {
        //     $announcementModel->insert($announcement);
        // }
        
        // Display success message in the terminal
        echo "✓ Successfully seeded 3 announcements into the database.\n";
    }
}
