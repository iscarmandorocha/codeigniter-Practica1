<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;
class Libros extends Controller{
    public function index()
    {
        $libros = new Libro();
        $datos['libros'] = $libros->orderBy('id', 'ASC')->findAll();

        $datos['cabecera'] = view('templete/cabecera');
        $datos['pie'] = view('templete/pie');
        return View('libros/listar',  $datos);
    }

    public function Guardar()
    {
        $libro = new Libro();

        $validacion = $this->Validate([
            'nombre'=> 'required|min_length[3]',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]',
            ]
        ]);
        if(!$validacion){
            return $this->response->redirect(site_url('/listar'));
        }
        if($imagen = $this->request->getFile('imagen')){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('../public/uploads/', $nuevoNombre);
            $datos = [
                'nombre'=>$this->request->getVar('nombre'),
                'imagen'=>$nuevoNombre
            ];
            $libro->insert($datos);
        }
        return $this->response->redirect(site_url('/listar'));
    }
    public function Borrar($id = null )
    {
        $libros = new Libro();
        $libro = $libros->where('id',$id)->first();

        $ruta = ('../public/upload/'. $libro['imagen']);
        unlink($ruta);
        $libros->where('id',$id)->delete($id);

        return $this->response->redirect(site_url('/listar'));
    }
    public function Editar($id=null)
    {
        $libros = new Libro();
        $datos = [
            'nombre' => $this->request->getVar('nombre')
        ];
        $id =$this->request->getVar('id');

        $libros->update($id, $datos);
        $validacion = $this->Validate([
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]',
            ]
        ]);

        if($validacion){
            if($imagen = $this->request->getFile('imagen')){
                $libro = $libros->where('id',$id)->first();
                $ruta = ('../public/upload/'. $libro['imagen']);
                unlink($ruta);

                $nuevoNombre = $imagen->getRandomName();
                $imagen->move('../public/uploads/', $nuevoNombre);
                $datos = [
                    'nombre'=>$this->request->getVar('nombre'),
                    'imagen'=>$nuevoNombre
                ];
                $libro->update($id, $datos);
            }
        }

        return $this->response->redirect(site_url('/listar'));
    }
}