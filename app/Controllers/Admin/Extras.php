<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Extra;

class Extras extends BaseController
{
    private $extraModel;

    public function __construct(){
        $this->extraModel = new \App\Models\ExtraModel();
    }

    public function index()
    {
       $data = [
        'titulo' => 'Listando os extras de Produtos',
        'extras' => $this->extraModel->withDeleted(true)->paginate(10),
        'pager' => $this->extraModel->pager
       ];

       return view('Admin/Extras/index', $data);
    }
}
