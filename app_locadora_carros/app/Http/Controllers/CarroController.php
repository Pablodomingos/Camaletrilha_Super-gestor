<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarroRequest;
use App\Models\Carro;
use App\Repositories\CarroRepository;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carroRepository = new CarroRepository($this->carro);

        if($request?->has('atributos_modelo')) {
            $carroRepository->selectAtributeRegistrosRelacionados("modelo:id,$request->atributos_modelo");
        }else {
            $carroRepository->selectAtributeRegistrosRelacionados('modelo');
        }

        if ($request?->has('filtro')){
            $carroRepository->filtro($request->filtro);
        }

        $request?->has('atributos') ? $carroRepository->selectAtributos($request->atributos) : '';

        return response()->json($carroRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarroRequest $request)
    {
        $carro = $this->carro->create([
            'modelo_id' => $request->get('modelo_id'),
            'placa' => $request->get('placa'),
            'disponivel' => $request->get('disponivel'),
            'km' => $request->get('km'),
        ]);
        return response()->json($carro, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carro = $this->carro->with('modelo')->find($id);
        if ($carro === null) {
            return response()->json(['error' => 'Não foi possivel encotrar esse item em expecifico!'], 404);
        }
        return response()->json($carro, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarroRequest  $request
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(CarroRequest $request, $id)
    {
        $carro = $this->carro->find($id);

        if($carro !== null) {
            $carro->fill($request->all());
            $carro->save();
            return response()->json($carro, 200);
        }

        return response()->json(['error' => 'Não foi possivel encontrar esse item para realizar o update!'], 404);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carro = $this->carro->find($id);
        if($carro !== null) {
            $carro->delete();
            return response()->json(['success' => 'Carro deletada com sucesso!'], 200);
        }

        return response()->json(['error' => 'Não foi possievl encontrar esse item para ser deletado!'], 404);
    }
}
