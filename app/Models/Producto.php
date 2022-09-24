<?php 
namespace App\Models;

use CodeIgniter\Model;

class Producto extends Model{
    protected $table      = 'productos';

    protected $primaryKey = 'id';
    protected $allowedFields = [
        'producto_id', 
        'user_id', 
        'title', 
        'price', 
        'category_id', 
        'available_quantity',  
        'status', 
        'start_time', 
        'stop_time', 
        'condition', 
        'permalink', 
        'pictures', 
        'attributes', 
        'thumbnail', 
        'sale_terms', 
    ];

}