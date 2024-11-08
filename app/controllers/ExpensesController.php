<?php

namespace App\Controllers;

class ExpensesController
{
    private $despesa;

    public function list()
    {
        $despesas = $this->despesa->findAll();
        echo json_encode($despesas);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->description) && isset($data->value) && isset($data->status)) {
            try {
                $this->despesa->save($data->description, $data->value, $data->status);

                http_response_code(201);
                echo json_encode(["message" => "Despesa criada com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar a despesa."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $despesa = $this->despesa->findById($id);
                if ($despesa) {
                    echo json_encode($despesa);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Despesa não encontrada."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar a despesa."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && isset($data->description) && isset($data->value) && isset($data->status)) {
            try {
                $count = $this->despesa->create($data->description, $data->value, $data->status, $id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Despesa atualizada com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar a despesa."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar a despesa."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id)) {
            try {
                $count = $this->despesa->delete($id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Despesa deletada com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar a despesa."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar a despesa."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}