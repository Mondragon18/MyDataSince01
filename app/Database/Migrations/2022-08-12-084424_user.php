<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration{
    public function up(){

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'TEXT',
            ],
            'password' => [
                'type' => 'TEXT',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('user');
    }

    public function down(){
        $this->forge->dropTable('user');
    }
}