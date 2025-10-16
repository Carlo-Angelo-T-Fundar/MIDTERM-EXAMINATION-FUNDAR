<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration to create the announcements table
 * This table stores system-wide announcements visible to all logged-in users
 */
class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migration - creates the announcements table
     */
    public function up()
    {
        // Define the fields/columns for the announcements table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',              // Integer data type
                'constraint'     => 11,                 // Maximum length of 11 digits
                'unsigned'       => true,               // Only positive numbers (no negative)
                'auto_increment' => true,               // Auto-increment for each new record
            ],
            'title' => [
                'type'       => 'VARCHAR',              // Variable character string
                'constraint' => '255',                  // Maximum 255 characters
                'null'       => false,                  // Cannot be empty/null - title is required
            ],
            'content' => [
                'type' => 'TEXT',                       // TEXT data type for longer content
                'null' => false,                        // Content is required
            ],
            'created_at' => [
                'type' => 'DATETIME',                   // Date and time format (YYYY-MM-DD HH:MM:SS)
                'null' => false,                        // Created date is required
            ],
        ]);

        // Set 'id' as the primary key for the table
        // Primary key uniquely identifies each announcement record
        $this->forge->addPrimaryKey('id');

        // Create the table in the database with the name 'announcements'
        $this->forge->createTable('announcements');
    }

    /**
     * Reverse the migration - drops/deletes the announcements table
     * This is used when rolling back migrations
     */
    public function down()
    {
        // Drop/delete the announcements table if it exists
        $this->forge->dropTable('announcements');
    }
}
