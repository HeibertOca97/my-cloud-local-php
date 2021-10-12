<?php

namespace controllers;

use core\Controller;
use core\Logger;
use models\Archivo;
use models\Paginator;

class VideoController extends Controller
{

    public function index()
    {
        self::isGET();

        self::isGET();
        $file = new Paginator("archivos", 6);
        $file->_set('type_id', 2);

        $this->view('views.video', [
            "videos" => $file->getPaginator(),
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
        $file->_set('type_id', 2);
        $total = $file->getTotal();
        $limit = $file->_get('limit');

        if ($total <= $limit) $this->redirect("image");

        if ($pag != null) {
            $file->_set('page', $pag);
        }

        $this->view('views.video', [
            "videos" => $file->getPaginator(),
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
            $req = $this->inputFile("video");
            $new_name = date("is") . $req->name;
            $route_file = $this->setStorage("video", $new_name);
            $this->uploadFile($req->tmp_name, $route_file);

            $img = new Archivo();
            $img->_set('url', $route_file);
            $img->_set('type_id', 2);
            $img->save();

            Logger::info("Video almacenada con exito - " . $new_name);
        } catch (\Throwable $th) {
            Logger::error("VideoController::store - " . $th);
        }

        $this->redirect("video");
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
            Logger::error("VideoController::destroy - " . $th);
        }

        $this->redirect("video");
    }
}
