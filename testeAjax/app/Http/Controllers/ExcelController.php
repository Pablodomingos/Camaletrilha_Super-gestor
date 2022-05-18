<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelRequest;
use App\Models\ImportExcel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->all() == null){
            $teste['message'] = "Error, Seu arquivo não foi armazenado!";
            return response()->json($teste);
        }

        $read = IOFactory::load($request->file('arquivo'));
        $count = $read->getSheetCount();
        for ($i = 1; $i < $count; $i++) {
            $i == 1 ? $data = $read->getSheet($i)->toArray() : '';
        }

        for ($i = 1; $i < count($data); $i++) {
            $excel = new ImportExcel();
            $excel->create([
                'SID' => $data[$i][1],
                'Pkgs' => $data[$i][2],
                'Recipient' => $data[$i][3],
                'ContactName' => $data[$i][4],
                'AddressLine1' => $data[$i][5],
                'AddressLine2' => $data[$i][6],
                'City' => $data[$i][7],
                'State' => $data[$i][8],
                'PostalCode' => $data[$i][9],
                'StopInstructions' => $data[$i][10],
                'Phone' => $data[$i][11],
                'Completed' => $data[$i][12]
            ]);
        }
        $teste['message'] = "Success, Seu arquivo foi armazenado!";
        return response()->json($teste);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
