<?php

namespace App\BO;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Http\Resources\ClientesResource;
use Exception;
use Illuminate\Http\Response;

class ClientesBO{


    public function getAllClient(){

        try{

             $clientes = Clientes::all();
             $clientes = ClientesResource::collection($clientes);
             return response()->json([
                'success' => 'true',
                'dados'     => $clientes,
            ]);

        }catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'msg' =>
                    'Erro: Não foi possível obter a lista de clientes' .
                    $e.'',
            ]);
        }

    }

    public function searchByPlaca($numero){

        $clientes  =  Clientes::whereRaw('RIGHT(placa_carro, 1) = ?', [$numero])->get();
        return ClientesResource::collection($clientes);

    }

    public function newClient($request){

        try{

            $novo_cliente = new Clientes();
            $novo_cliente->nome = $request->nome;
            $novo_cliente->telefone = $request->telefone;
            $novo_cliente->cpf = $request->cpf;
            $novo_cliente->placa_carro = $request->placa_carro;
            $novo_cliente->save();

            return response()->json([
                'success' => 'true',
                'dados'     => $novo_cliente,
            ]);

        }catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'msg' =>
                    'Erro: Não foi possível cadastrar o cliente:' .
                    $e.'',
            ]);
        }
    }


    public function updateClient($request, $id){

        try{

            $request->validate([
                'nome' => 'required|string|max:255',
                'telefone' => 'required|string|max:20',
                'cpf' => 'required|string|max:11|unique:clientes,cpf,' . $id,
                'placa_carro' => ['required', 'string', 'regex:/^[A-Z]{3}[0-9][A-Z][0-9]{2}$/'],
            ]);

            // Encontrar o usuário pelo ID
            $cliente = Clientes::findOrFail($id);

            // Atualizar os dados do usuário
            $cliente->update($request->all());

            // Retornar resposta de sucesso
            return response()->json([
                'success' => 'true',
                'dados'     => $cliente,
            ]);

        }catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'msg' =>
                    'Erro: Não foi possível atualizar o cliente:' .
                    $e.'',
            ]);
        }
    }

    public function destroy($id){

        try{

            // Encontrar o usuário pelo ID
            $cliente = Clientes::findOrFail($id);
            // Deletar o usuário
            $cliente->delete();

            return response()->json([
                'success' => 'true',
                'dados'     => "Cliente deletado com sucesso!",
            ]);

        }catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'msg' =>
                    'Erro: Não foi possível excluir o cliente:' .
                    $e.'',
            ]);
        }
    }



}

?>
