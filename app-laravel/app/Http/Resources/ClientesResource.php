<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'placa' => $this->placa_carro
        ];
    }
}
