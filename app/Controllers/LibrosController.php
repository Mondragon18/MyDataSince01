<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libros;

class LibrosController extends Controller{

    public function index(){
        $libro = new Libros();
        $datos['libros'] = $libro->orderBy('id', 'ASC')->findAll();
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');
        return view('libros/listar', $datos);
    }

    public function crear(){
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');
        return view('libros/crear', $datos);
    }
 
    public function guardar(){
        $libro = new Libros();
        $validacion = $this->validate([
            'nombre' => 'required|min_length[3]',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]',
            ]
        ]);
        if(!$validacion){
            return $this->response->redirect(site_url('/libros/listar'));
        }

        if($imagen=$this->request->getFile('imagen')){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('../public/uploads/', $nuevoNombre);
            $datos=[
                'nombre' => $this->request->getVar('nombre'),
                'imagen' => $nuevoNombre
            ];
            $libro->insert($datos);
        }
        return $this->response->redirect(site_url('/libros/listar'));
    }

    public function editar($id=null){

        $libro = new Libros();
        $datos['libro'] = $libro->where('id', $id)->first(); 
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');

        return view('libros/editar', $datos);

    }

    public function actualizar(){
        $libro = new Libros();
        $datos=[
            'nombre' => $this->request->getVar('nombre')
        ];

        $id = $this->request->getVar('id');
        $libro->update($id, $datos);

        $validacion = $this->validate([
                'imagen' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                    'max_size[imagen,1024]',
                ]
            ]);

            if($validacion){
                if($imagen=$this->request->getFile('imagen')){

                    $datosLibro= $libro->where('id', $id)->first();
                    $ruta=('../public/uploads/'.$datosLibro['imagen']);
                    unlink($ruta);

                    $nuevoNombre = $imagen->getRandomName();
                    $imagen->move('../public/uploads/', $nuevoNombre);

                    $datos=[ 'imagen' => $nuevoNombre ];
                    $libro->update($id, $datos);
                }
            }
        return $this->response->redirect(site_url('/libros/listar'));

    }

    public function borrar($id=null){
        $libro = new Libros();
        $datosLibro= $libro->where('id', $id)->first();
        $ruta=('../public/uploads/'.$datosLibro['imagen']);
        unlink($ruta);
        $libro->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/libros/listar'));
    }


}