<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\ConnectionApiMercadolibre;

class CategoriaController extends Controller
{

    public function __construct(){}

    // metodos para manejar con vue 
    public function getCategorias($id){
        $api = new ConnectionApiMercadolibre();
        $data = $api->getCategorias($id);
        return  $this->response->setJSON($data);
    }

    public function getDetalleCategoria($id)
    {
        $api = new ConnectionApiMercadolibre();
        $data = $api->getDetallesCategorias($id);
        if($data->children_categories == []){
            return $this->response->setJSON($data);
        }else{
            return $this->response->setJSON($data->children_categories);
        }
    }


    // metodos para manejar con jQuery
    public function getCategoriasJquery()
    {
        $id = $this->request->getPost('id'); //id de la categoria
        $api = new ConnectionApiMercadolibre();
        $datas = $api->getCategorias($id);

        $data = '';
        if ($datas) {
            foreach ($datas as $categoria) {
                $data .= '
                    <li  id="' . $categoria->id . '" class="list-group-item d-flex justify-content-between align-items-start cursor-pointer list-group-item-action btn-selecc-ctg">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"> ' . $categoria->name . '</div>
                            ' . $categoria->id . '
                        </div>
                    </li>
                ';
            }
            return $this->response->setJSON([
                'error' => false,
                'message' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'error' => false,
                'message' => '<div class="text-secondary text-center fw-bold my-5">No categories found in the database!</div>'
            ]);
        }
    }

    public function getDetalleCategoriaJquery()
    {
        $id = $this->request->getPost('id'); //id de la categoria
        $api = new ConnectionApiMercadolibre();
        $datas = $api->getDetallesCategorias($id);

        $data = '';
        if ($datas) {

            $data .= '
                <div class="mx-2" style="width: 15rem;">
                    <h5>subcategorias</h5>
                    <ol class="list-group list-group-numbered" >';

            foreach ($datas->children_categories as $sub) {
                $data .= '
                    <li  class="list-group-item d-flex justify-content-between align-items-start cursor-pointer list-group-item-action">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"> ' . $sub->name . '</div>
                                    ' . $sub->id . '
                        </div>
                    </li>
                ';
            }

            $data .= '
                    </ol>
                </div>
            ';

            $data .= '
                <div class="mx-2">
                    <h6>Informacion general</h6>
                    <div class="card mt-3" style="width: 30rem;">
                        <img src="' . $datos['detalles']->picture . '" alt="" class="w-50 p-3 h-25 mx-auto">
                        <div class="card-body">
                            <h5 class="card-title">' . $datos['detalles']->name . '</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Total categorias: ' . $datos['detalles']->total_items_in_this_category . '</h6>
                            <a href="' . $datos['detalles']->permalink . '" target="_blank" class="card-link">' . $datos['detalles']->permalink . '</a>
                            <p class="card-text"><small class="text-muted">' . $datos['detalles']->date_created . '</small></p>
                        </div>
                    </div>
                </div>   
            ';
            return $this->response->setJSON([
                'error' => false,
                'message' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'error' => false,
                'message' => '<div class="text-secondary text-center fw-bold my-5">No details found in the database!</div>'
            ]);
        }
        
    }
}