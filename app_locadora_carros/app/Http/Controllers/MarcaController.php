<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaRequest;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->marca->all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaRequest $request)
    {
        // $marca = Marca::create($request->all());
        $imagem = $request->file('image')->store('imagens', 'public');

        $marca = $this->marca->create([
            'nome' => $request->get('nome'),
            'image' => $imagem
        ]);
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['error' => 'Não foi possivel encotrar esse item em expecifico!'], 404);
        }
        return response()->json($marca, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request, $id)
    {
        // $marca->update($request->all());
        $marca = $this->marca->find($id);

        /* Sé o $request->file('image') não for nulo ele vai deletar a imagem.
        Mas se ele for nulo só vou retornar a imagem para fazer o update sem erro.*/
        if($request?->file('image')) {
            Storage::disk('public')->delete($marca->image);
            $imagem = $request->file('image')->store('imagens', 'public');
        }else {
            $imagem = $marca->image;
        }

        if($marca !== null) {
            $marca->update([
                'nome' => $request->nome ?? $marca->nome,
                'image' => $imagem
            ]);
            return response()->json($marca, 200);
        }

        return response()->json(['error' => 'Não foi possivel encontrar esse item para realizar o update!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $marca->delete();
        $marca = $this->marca->find($id);
        if($marca !== null) {
            Storage::disk('public')->delete($marca->image);
            $marca->delete();
            return response()->json(['success' => 'Marca deletada com sucesso!'], 200);
        }

        return response()->json(['error' => 'Não foi possievl encontrar esse item para ser deletado!'], 404);
    }
}
