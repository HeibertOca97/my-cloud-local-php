<?php

namespace controllers;

use core\Controller;
use core\Logger;
use models\Archivo;
use models\Paginator;

class DocumentController extends Controller
{
    private $type_file = 3;

    public function index()
    {
        self::isGET();
        $file = new Paginator("archivos", 6);
        $file->_set('type_id', $this->type_file);

        $this->view('views.document', [
            "documents" => $file->getPaginator(),
            "totalPage" => $file->getTotal(),
            "limitPage" => $file->_get('limit'),
            "pagLink" => $file->getLinks(),
            "paginate" => true
        ]);
    }

    public function pag($pag)
    {
        self::isGET();
        if (!is_numeric($pag)) $this->redirect("document");

        $file = new Paginator("archivos", 6);
        $file->_set('type_id', $this->type_file);
        $total = $file->getTotal();
        $limit = $file->_get('limit');

        if ($total <= $limit) $this->redirect("document");

        if ($pag != null) {
            $file->_set('page', $pag);
        }

        $this->view('views.document', [
            "documents" => $file->getPaginator(),
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
            $req = $this->inputFile("document");
            $new_name = date("is") . $req->name;
            $route_file = $this->setStorage("document", $new_name);
            $this->uploadFile($req->tmp_name, $route_file);

            $img = new Archivo();
            $img->_set('url', $route_file);
            $img->_set('type_id', $this->type_file);
            $img->save();

            Logger::info("Documento almacenado con exito - " . $new_name);
        } catch (\Throwable $th) {
            Logger::error("DocumentController::store - " . $th);
        }

        $this->redirect("document");
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
            Logger::error("DocumentController::destroy - " . $th);
        }

        $this->redirect("document");
    }
}
