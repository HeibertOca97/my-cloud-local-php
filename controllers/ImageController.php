<?php

namespace controllers;

use core\Controller;
use core\Logger;
use models\Archivo;
use models\Paginator;

class ImageController extends Controller
{
    private $type_file = 1;

    public function index()
    {
        self::isGET();
        $file = new Paginator("archivos", 6);
        $file->_set('type_id', $this->type_file);

        $this->view('views.image', [
            "images" => $file->getPaginator(),
            "totalPage" => $file->getTotal(),
            "limitPage" => $file->_get('limit'),
            "pagLink" => $file->getLinks(),
            "paginate" => true
        ]);
    }

    public function pag($pag)
    {
        self::isGET();
        if (!is_numeric($pag)) $this->redirect("image");

        $file = new Paginator("archivos", 6);
        $file->_set('type_id', $this->type_file);
        $total = $file->getTotal();
        $limit = $file->_get('limit');

        if ($total <= $limit) $this->redirect("image");

        if ($pag != null) {
            $file->_set('page', $pag);
        }

        $this->view('views.image', [
            "images" => $file->getPaginator(),
            "totalPage" => $total,
            "limitPage" => $limit,
            "pagLink" => $file->getLinks(),
            "pagActual" => $pag,
            "paginate" => false
        ]);
    }

    public function store()
    {
        self::isPOST();

        try {
            $req = $this->inputFile("image");
            $new_name = date("is") . $req->name;
            $route_file = $this->setStorage("image", $new_name);
            $this->uploadFile($req->tmp_name, $route_file);

            $img = new Archivo();
            $img->_set('url', $route_file);
            $img->_set('type_id', $this->type_file);
            $img->save();

            Logger::info("Imagen almacenada con exito - " . $new_name);
        } catch (\Throwable $th) {
            Logger::error("ImagenController::store - " . $th);
        }

        $this->redirect("image");
    }

    public function destroy($id)
    {
        self::isPOST();

        try {
            $img = new Archivo();
            $data = $img->getBy($id);

            $this->deleteFile($data->url);
            $img->delete($data->id);
        } catch (\Throwable $th) {
            Logger::error("ImagenController::destroy - " . $th);
        }

        $this->redirect("image");
    }
}
