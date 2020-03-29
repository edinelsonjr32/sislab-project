<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemEquipamento;
use Illuminate\Http\Request;

class ItemEquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Item $itens)
    {

        return view('item.index', ['itens' => $itens->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        $item->create($request->all());


        return redirect()->route('item_equipamento.index')->with('status', 'Dados Cadastrados com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemEquipamento  $itemEquipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Item $itemEquipamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemEquipamento  $itemEquipamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $itemEquipamento)
    {
        return view('item.edit', ['itens'=>$itemEquipamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemEquipamento  $itemEquipamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $itemEquipamento)
    {
        $itemEquipamento->update($request->all());

        return redirect()->route('item_equipamento.index')->with('status', 'Dados Atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemEquipamento  $itemEquipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $itemEquipamento)
    {
        $itemEquipamento->delete();

        return redirect()->route('item_equipamento.index')->with('status', 'Dados Excluidos com sucesso!');
    }
}
