<?php

namespace App\Libraries;

class ConnectionApiMercadolibre {

    protected $client;
    protected $token;
    protected $haeders;

    public function __construct()
    {
        $this->client = \Config\Services::curlrequest([
            'baseURI' => 'https://api.mercadolibre.com',
        ]);
        $this->token = "Bearer APP_USR-4332857485021545-092316-b093ee24e4c3d1139ce6afd9b9452205-833930674";
        $this->haeders = [
            'Accept'        => 'applications->token,/json',
            'Authorization' => $thi
            'Content-Type' => 'application/json',
        ];
    }

    public function getProductos($pais, $name){
        $url = '/sites/' . $pais . '/search?q=' . $name . '&limit=1'; //  /sites/MCO/search?q=Kit 6 Sillas Eames Patas En Madera Para Comedor - Sala
        // $url = '/sites/' . $pais . '/search?q=Kit&limit?=1'; //  /sites/MCO/search?q=Kit 6 Sillas Eames Patas En Madera Para Comedor - Sala
        $datos['producto'] = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
        return $datos['producto']->results; 
    }

    public function getPaises(){
        $url = "sites";
        $datos['paises'] = json_decode($this->client->get($url)->getBody());
        return $datos['paises'];
    }

    public function getCategorias($id)
    {
        $url = 'sites/' . $id . '/categories';  // url de consulta
        $datos['categorias'] = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
        return $datos['categorias'];
    }

    public function getDetallesCategorias($id){
        $url = 'categories/' . $id; //url de consulta a la api de mercado libre
        $datos['subs'] = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
        return $datos['subs'];
    }

    public function getCategoriasAtributos($id){ //id de la categoria seleccionada
        $url = 'categories/'.$id.'/technical_specs/input';
        $datos['atributos'] = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
        return $datos['atributos'];
    }

    public function getProducto($id){
        $url = '/items/' . $id;
        $datos['producto'] = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
        return $datos['producto'];
    }

    public function getDescriptionItem($id){
        try {
            $url = '/items/'.$id.'/description';
            $datos['producto'] = json_decode($this->client->get($url)->getBody());
            return $datos['producto'];
        } catch (\Throwable $th) {
           return ['alert' => 'error', 'msg' => 'el producto no tiene una descripcion'];
        }
    }

    public function setItem($datos){
        try{
            $url = 'items';
            $item = json_decode($this->client->post($url, ['json' => $datos, 'headers' => $this->haeders, 'http_errors' => false])->getBody());
            return $item;
        } catch (\Throwable $th) {
            return ['alert' => 'error', 'msg' => 'el producto no se pudo publicar, intentelo mas tarde'];
        }
    }

    public function getSite($id){
        $url = 'sites/' . $id;
        $datos['item'] = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
        return $datos['item'];
    }

    public function setDescriptionItem($id_item, $datos){
        try {
            $url = '/items/'.$id_item.'/description';
            $item = json_decode($this->client->post($url, ['json' => $datos, 'headers' => $this->haeders, 'http_errors' => false])->getBody());
            return $item;
        } catch (\Throwable $th) {
            return ['alert' => 'error', 'msg' => 'el producto no se pudo publicar, intentelo mas tarde'];
        }
    }

    public function updateDescriptionItem($id_item, $datos){
        try {
            $url = 'items/'.$id_item.'/description';
            $item = json_decode($this->client->put($url, ['json' => $datos, 'headers' => $this->haeders, 'http_errors' => false])->getBody());
            return $item;
        } catch (\Throwable $th) {
            return ['alert' => 'error', 'msg' => 'el producto no se pudo publicar, intentelo mas tarde'];
        }
    }

    public function getMiUsuario(){
        try {
            $url = '/users/me';
            $item = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
            return $item;
        } catch (\Throwable $th) {
            return ['alert' => 'error', 'msg' => 'Ocurre un error, intentelo nuevamente'];
        }
    }

    public function getProductosUsuario($id){ // id usuario
        try {
            $url = '/users/'.$id.'/items/search';
            $item = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
            return $item;
        } catch (\Throwable $th) {
            return ['alert' => 'error', 'msg' => 'Ocurre un error, intentelo nuevamente'];
        }
    }

    public function deleteProducto($id){
        try {
            if($id){
                $url = '/items/'. $id;
                $this->client->put($url, ['json' => ['status' => 'paused'], 'headers' => $this->haeders, 'http_errors' => false])->getBody();
                $producto = json_decode($this->client->put($url, ['json' => ['status' => 'closed'], 'headers' => $this->haeders, 'http_errors' => false])->getBody());
                
                return $producto;
            }
        } catch (\Throwable $th) {
            return ['alert' => 'error', 'msg' => 'Ocurre un error, intentelo nuevamente'];
        }
    }

}