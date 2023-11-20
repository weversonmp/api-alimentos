<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Exception;

class Foods extends ResourceController
{
    private $foodsModel;
    private $token = '123456789abcdefghi';

    public function __construct()
    {
        $this->foodsModel = new \App\Models\FoodsModel();
    }

    private function _validaToken()
    {
        return $this->request->getHeaderLine('token') == $this->token;
    }

    //GET - Receive a JSON file with all rows from tb_foods
    public function list()
    {
        $data = $this->foodsModel->findAll();

        return $this->response->setJSON($data);
    }

    //POST - Add food to table tb_foods
    public function create()
    {
        $response = [];

        if ($this->_validaToken() == true) {
            //Pega os dados que vieram no body da requisição para salvar
            $newFood['food_name'] = $this->request->getPost('food_name');
            $newFood['carb'] = $this->request->getPost('carb');
            $newFood['prot'] = $this->request->getPost('prot');
            $newFood['fat'] = $this->request->getPost('fat');
            $newFood['kcal'] = $this->request->getPost('kcal');

            try {
                if ($this->foodsModel->insert($newFood)) {
                    $response = [
                        'response' => 'success',
                        'msg' => 'Produto adicionado com sucesso'
                    ];
                } else {
                    $response = [
                        'response' => 'error',
                        'msg' => 'Erro ao salvar o alimento',
                        'errors' => $this->foodsModel->errors()
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'response' => 'error',
                    'msg' => 'Erro ao salvar o alimento',
                    'errors' => [
                        'exception' => $e->getMessage()
                    ]
                ];
            }
        } else {
            $response = [
                'response' => 'error',
                'msg' => 'Token Inválido',
            ];
        }

        return $this->response->setJSON($response);
    }
}
