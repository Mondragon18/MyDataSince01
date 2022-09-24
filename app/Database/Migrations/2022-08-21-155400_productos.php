<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productos extends Migration{
    public function up(){

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'producto_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'user_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type' => 'INT',
                'constraint'     => 5,
            ],
            'category_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'available_quantity' => [
                'type' => 'INT',
                'constraint'     => 5,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'start_time' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'stop_time' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'condition' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'permalink' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'pictures' => [
                'type' => 'JSON'
            ],
            'attributes' => [
                'type' => 'JSON'
            ],
            'sale_terms' => [
                'type' => 'JSON'
            ],
            'thumbnail' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('productos');
    }

    public function down(){
        $this->forge->dropTable('productos');
    }
}