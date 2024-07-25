<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\BO\ClientesBO;
use App\Http\Resource\ClientesResource;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
    */

    public function __construct()
    {
        $this->clientesBo =  new ClientesBO();
    }

    public function index()
    {
        //retorna todos os clientes
        $lista_cliente = $this->clientesBo->getAllClient();
        return $lista_cliente;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Cadastro de novo cliente
        $cadastro_cliente = $this->clientesBo->newClient($request);
        return $cadastro_cliente;
    }

    /**
     * Display the specified resource.
     */
    public function searchByPlaca($numero)
    {
        //Atualizar cadastro do cliente
        $show_cliente = $this->clientesBo->searchByPlaca($numero);
        return $show_cliente;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //Atualizar cadastro do cliente
        $update_cliente = $this->clientesBo->updateClient($request, $id);
        return $update_cliente;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
          //Deleta cadastro do cliente
          $destroy_cliente = $this->clientesBo->destroy($id);
          return $destroy_cliente;
    }
}
