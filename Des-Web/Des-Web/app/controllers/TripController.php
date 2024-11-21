<?php

namespace App\Controllers;

class TripController
{
    private $trip;

    public function list()
    {
        $trips = $this->trip->findAll();
        echo json_encode($trips);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name) && isset($data->start_date) && isset($data->end_date) && isset($data->location)) {
            try {
                $this->trip->save($data->name, $data->start_date, $data->end_date, $data->location);

                http_response_code(201);
                echo json_encode(["message" => "Viagem criado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar a viagem."]);
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
                $trip = $this->trip->findById($id);
                if ($trip) {
                    echo json_encode($trip);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Viagem não encontrada."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar a viagem."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && isset($data->name) && isset($data->start_date) && isset($data->end_date) && isset($data->location)) {
            try {
                $count = $this->trip->create($data->name, $data->start_date, $data->end_date, $data->location, $id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Viagem atualizada com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar a viagem."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar a viagem."]);
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
                $count = $this->trip->delete($id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Viagem deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar a viagem."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar a viagem."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}