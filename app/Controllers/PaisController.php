<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pais;
use App\Libraries\ApiMercadoLibre\ConnectionPais;


class PaisController extends Controller
{

    public function __construct(){}

    public function vue()
    {
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');
        return view('sites/vue-listar', $datos);
    }

    public function jquerys()
    {
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');
        return view('sites/jquery-listar', $datos);
    }

    public function getPaisesVue()
    {
        $api = new ConnectionPais();
        $data = $api->getPaises();
        return  $this->response->setJSON($data);
    }

    public function getPaisesJquery()
    {
        $url = "sites";
        $datos['paises'] = json_decode($this->client->get($url)->getBody());

        $data = '';
        if($datos['paises']){
            foreach ($datos['paises'] as $pais ) {
                $data.= '
                    <li  id="'.$pais->id.'" class="list-group-item d-flex justify-content-between align-items-start cursor-pointer list-group-item-action btn-selecc-pais">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"> '.$pais->name.'</div>
                            '.$pais->id.'
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
                'message' => '<div class="text-secondary text-center fw-bold my-5">No paises found in the database!</div>'
            ]);
        }
        
    }
}
