<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clienteRepository = new ClienteRepository($this->cliente);

        if ($request?->has('filtro')){
            $clienteRepository->filtro($request->filtro);
        }

        $request?->has('atributos') ? $clienteRepository->selectAtributos($request->atributos) : '';

        return response()->json($clienteRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $cliente = $this->cliente->create([
            'nome' => $request->get('nome'),
        ]);
        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);
        if ($cliente === null) {
            return response()->json(['error' => 'Não foi possivel encotrar esse item em expecifico!'], 404);
        }
        return response()->json($cliente, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
        $cliente = $this->cliente->find($id);

        if($cliente !== null) {
            $cliente->fill($request->all());
            $cliente->save();
            return response()->json($cliente, 200);
        }

        return response()->json(['error' => 'Não foi possivel encontrar esse item para realizar o update!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);
        if($cliente !== null) {
            $cliente->delete();
            return response()->json(['success' => 'Cliente deletada com sucesso!'], 200);
        }

        return response()->json(['error' => 'Não foi possievl encontrar esse item para ser deletado!'], 404);
    }
}
