<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\ConnectionApiMercadolibre;
use App\Libraries\ApiMercadoLibre\ConnectionCategorias;
use App\Models\Producto;

class ProductosController extends Controller{

    protected $model;

    public function __construct(){
        $this->model = new Producto();
    }

    public function index(){
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');
        return view('productos/index', $datos);
    }   

    public function productos(){
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');
        return view('productos/producto', $datos);
    }  

    public function getProducto($pais = null, $name = null){
        $api = new ConnectionApiMercadolibre();
        $data = $api->getProductos($pais, $name);
        return  $this->response->setJSON($data);
    }

    public function getProductosCategorias(){
        $name = $this->request->getPost('name');
        $pais = $this->request->getPost('pais');

        if($name == ""){ return; }
        if($pais == ""){ $pais = "MCO"; }

        $api = new ConnectionApiMercadolibre();
        $datas = $api->getProductos($pais, $name);
        
        foreach ($datas as $data) {
            $id = $data->id;
            $id_category = $data->category_id;
        }  

        $producto = $api->getProducto($id);
        $categorias = $api->getDetallesCategorias($id_category);
        $descripcion = $api->getDescriptionItem($id);

        $informacion = [
            'producto' => $producto,
            'categorias'=> $categorias->path_from_root,
            'description' => $descripcion,
        ];

        return  $this->response->setJSON($informacion);
    }

    public function getAtributosRequeridos($id){
        if($id){
            $api = new ConnectionApiMercadolibre();
            $datas = $api->getCategoriasAtributos($id);
            return  $this->response->setJSON($datas->groups);
        }
    }

    public function setProductos(){
        $api = new ConnectionApiMercadolibre();
        $datas = $api->getSite($this->request->getPost('id_pais'));
        $currency_id = $datas->default_currency_id;

        $data_request = [
            "title" => $this->request->getPost('title'),
            "price" => $this->request->getPost('price'),
            "category_id" => $this->request->getPost('category_id'),
            "available_quantity" => $this->request->getPost('available_quantity'),
            "currency_id" => $currency_id,
            'sale_terms' => $this->request->getPost('sale_terms'),
            'condition' => 'not_specified',
            "listing_type_id" => "gold_special",
            "seller_custom_field" => $this->request->getPost('seller_custom_field'),
            "pictures" => $this->request->getPost('pictures'),
            "attributes" => $this->request->getPost('attributes')
        ];
        
        $set = $api->setItem($data_request);

        return  $this->response->setJSON($set);
    }


    public function updateProducto(){

    }

    public function deleteProducto($id){
        $api = new ConnectionApiMercadoLibre();
        $producto = $api->deleteProducto($id);
        $prod = $this->model->where('producto_id', $id)->delete($id);
        if($prod){
            return ['alert' => 'success', 'msg' => $producto];
        }
    }

    public function getListaProducto(){
        $id_user = 'MM102010';
        if($id_user){
            $datos['productos'] = $this->model->where('user_id', $id_user)->orderBy('id', 'ASC')->findAll();
            return  $this->response->setJSON($datos['productos']);
        }
    }

    public function getDescription($id_item){
        $api = new ConnectionApiMercadolibre();
        $datas = $api->getDescriptionItem($id_item);
        return  $this->response->setJSON($datas);
    }

    public function setDescription($id){
        $api = new ConnectionApiMercadolibre();
        $data_request = [
            "plain_text" => $this->request->getPost('plain_text'),
        ];

        $set = $api->setDescriptionItem($id, $data_request);
        // $set = $api->setDescriptionItem($this->request->getPost('id_item'), $data_request);
        return $this->response->setJSON($set);
    }

    public function updateDescription($id){
        $api = new ConnectionApiMercadolibre();
        $data_request = [
            "plain_text" => $this->request->getPost('plain_text'),
        ];

        $set = $api->updateDescriptionItem($id, $data_request);
        return $this->response->setJSON($set);
    }

}