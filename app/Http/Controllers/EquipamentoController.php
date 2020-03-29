<?php

namespace App\Http\Controllers;

use App\Equipamento;
use App\EquipamentoTemItem;
use App\TipoEquipamento;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Equipamento $equipamento)
    {

        return view('equipamento.index', ['itens'=> $equipamento->select('equipamento.*', 'tipo_equipamento.nome as nomeTipo')->join('tipo_equipamento', 'tipo_equipamento.id', '=', 'equipamento.tipo_equipamento_id')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoEquipamento = TipoEquipamento::all();
        return view('equipamento.create', ['tipoEquipamento'=>$tipoEquipamento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Equipamento $equipamento)
    {



        if ($file = $request->file('imagem')) {

            $equipamento->tipo_equipamento_id = $request->tipo_equipamento_id;





            $equipamento->tombo = $request->tombo;


            $files = $request->imagem;




            $extensao = $files->getClientOriginalExtension();


            $imageName = time() . '.' . $extensao;


            $equipamento->path = $imageName;

            $equipamento->descricao = $request->descricao;

            $request->imagem->move(public_path('images'), $imageName);


            $equipamento->save();

            return redirect()->route('equipamento.index')->with('status', 'Equipamento Adicionado Com Sucesso');

        }






    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Equipamento $equipamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipamento $equipamento)
    {
        $tipoEquipamento = TipoEquipamento::all();



        return view('equipamento.edit', compact('equipamento'),['tipoEquipamento' => $tipoEquipamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipamento $equipamento)
    {

        if ($file = $request->file('imagem')) {


            $files = $request->imagem;




            $extensao = $files->getClientOriginalExtension();


            $imageName = time() . '.' . $extensao;

            $equipamento->path = $imageName;


            $request->imagem->move(public_path('images'), $imageName);

            $equipamento->tipo_equipamento_id = $request->tipo_equipamento_id;


            $equipamento->descricao = $request->descricao;
            $equipamento->tombo = $request->tombo;




            $equipamento->update();

            return redirect()->route('equipamento.index')->with('status', 'Equipamento Atualizado Com Sucesso');

        }else{
            $equipamento->tipo_equipamento_id = $request->tipo_equipamento_id;


            $equipamento->descricao = $request->descricao;
            $equipamento->tombo = $request->tombo;




            $equipamento->update();

            return redirect()->route('equipamento.index')->with('status', 'Equipamento Atualizado Com Sucesso');
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();

        return redirect()->route('equipamento.index')->with('status', 'Equipamento Removido Com Sucesso');
    }
}
