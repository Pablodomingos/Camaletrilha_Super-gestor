<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocacaoRequest;
use App\Models\Locacao;
use App\Repositories\LocacaoRepository;
use Illuminate\Http\Request;

class LocacaoController extends Controller
{
    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        if ($request?->has('filtro')){
            $locacaoRepository->filtro($request->filtro);
        }

        $request?->has('atributos') ? $locacaoRepository->selectAtributos($request->atributos) : '';

        return response()->json($locacaoRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocacaoRequest $request)
    {
        $locacao = $this->locacao->create([
            'cliente_id' => $request->get('cliente_id'),
            'carro_id' => $request->get('carro_id'),
            'data_inicio_periodo' => $request->get('data_inicio_periodo'),
            'data_final_previsto_periodo' => $request->get('data_final_previsto_periodo'),
            'data_final_realizado_periodo' => $request->get('data_final_realizado_periodo'),
            'valor_diario' => $request->get('valor_diario'),
            'km_inicial' => $request->get('km_inicial'),
            'km_fianl' => $request->get('km_fianl'),
        ]);
        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locacao = $this->locacao->find($id);
        if ($locacao === null) {
            return response()->json(['error' => 'Não foi possivel encotrar esse item em expecifico!'], 404);
        }
        return response()->json($locacao, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocacaoRequest  $request
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(LocacaoRequest $request, $id)
    {
        $locacao = $this->locacao->find($id);

        if($locacao !== null) {
            $locacao->fill($request->all());
            $locacao->save();
            return response()->json($locacao, 200);
        }

        return response()->json(['error' => 'Não foi possivel encontrar esse item para realizar o update!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locacao = $this->locacao->find($id);
        if($locacao !== null) {
            $locacao->delete();
            return response()->json(['success' => 'Locacao deletada com sucesso!'], 200);
        }

        return response()->json(['error' => 'Não foi possievl encontrar esse item para ser deletado!'], 404);
    }
}
