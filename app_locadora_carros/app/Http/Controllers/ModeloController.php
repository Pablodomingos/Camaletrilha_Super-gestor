<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeloRequest;
use App\Models\Modelo;
use App\Repositories\ModeloRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
{
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modeloRepository = new ModeloRepository($this->modelo);

        if($request?->has('atributos_marca')) {
            $modeloRepository->selectAtributeRegistrosRelacionados("marca:id,$request->atributos_marca");
        }else {
            $modeloRepository->selectAtributeRegistrosRelacionados('marca');
        }

        if ($request?->has('filtro')){
            $modeloRepository->filtro($request->filtro);
        }

        $request?->has('atributos') ? $modeloRepository->selectAtributos($request->atributos) : '';

        return response()->json($modeloRepository->getResultado(), 200);
        //all() -> criando um obj de consulta + get() = collection
        //get() -> modeificar a consulta -> collection
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloRequest $request)
    {
        $imagem = $request->file('image')->store('imagens/modelos', 'public');

        $modelo = $this->modelo->create([
            'marca_id' => $request->marca_id,
            'nome' => $request->get('nome'),
            'image' => $imagem,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs,
        ]);
        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id);
        if ($modelo === null) {
            return response()->json(['error' => 'Não foi possivel encotrar esse item em expecifico!'], 404);
        }
        return response()->json($modelo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(ModeloRequest $request, $id)
    {
        $modelo = $this->modelo->find($id);

        /* Sé o $request->file('image') não for nulo ele vai deletar a imagem.
        Mas se ele for nulo só vou retornar a imagem para fazer o update sem erro.*/
        if($request?->file('image')) {
            Storage::disk('public')->delete($modelo->image);
            $imagem = $request->file('image')->store('imagens/modelos', 'public');
        }else {
            $imagem = $modelo->image;
        }

        if($modelo !== null) {
            $modelo->fill($request->all());
            $modelo->image = $imagem;
            $modelo->save();

            /*
            $modelo->update([
                'marca_id' => $modelo->marca_id,
                'nome' => $request->nome ?? $modelo->nome,
                'image' => $imagem,
                'numero_portas' => $request->numero_portas ?? $modelo->numero_portas,
                'lugares' => $request->lugares ?? $modelo->lugares,
                'air_bag' => $request->air_bag ?? $modelo->air_bag,
                'abs' => $request->abs ?? $modelo->abs
            ]);
            */

            return response()->json($modelo, 200);
        }

        return response()->json(['error' => 'Não foi possivel encontrar esse item para realizar o update!'], 404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);
        if($modelo !== null) {
            Storage::disk('public')->delete($modelo->image);
            $modelo->delete();
            return response()->json(['success' => 'Modelo deletada com sucesso!'], 200);
        }

        return response()->json(['error' => 'Não foi possievl encontrar esse item para ser deletado!'], 404);
    }
}
