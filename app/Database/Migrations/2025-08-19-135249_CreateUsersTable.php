<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'instructor', 'student'],
                'default'    => 'student',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}