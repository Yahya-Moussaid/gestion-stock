<?php

namespace App\Http\Controllers;

use App\Models\command;
use App\Models\facture;
use App\Models\produit;
use Illuminate\Http\Request;

use App\Traits\ErrorSeccuss;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class factureController extends Controller
{  use ErrorSeccuss;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $factures = facture::all();
        if (count($factures)===0) {
            return $this->errorMessage("vide");
        }
        
        return $this->returnData('factures',$factures);
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
        //
        // $validate=Validator::make($request->all(),
        // ['tva'=>'required|tva',
        // 'montantTotal'=>'requider|montantTotal',
        // 'monyantTtc'=>'required|monyantTtc',
        // 'produit_id'=>'required|produit_id',
        // 'command_id'=>'required|command_id',]);
        if ($command=command::find($request->id)) {
            $produit=produit::where('id',$command->produit_id)->get();
        facture::create([
            'tva'=>$request->tva,
            'montantTotal'=>$request->montantTotal,
            'monyantTtc'=>$request->monyantTtc,
            'produit_id'=>$request->produit_id,
            'command_id'=>$request->command_id,
        ]);
        return response()->json([
            'message'=>'ajouter a ete success '
        ]);
        }
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
        $facture =facture::find($id);
        if (is_null($facture)===true) {
            return $this->errorMessage("ce produit n'exsit pas");
        }
        return response()->json($facture);
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
        $facture=facture::find($id);
        $facture->update([
            'tva'=>$request->tva,
            'montantTotal'=>$request->montantTotal,
            'monyantTtc'=>$request->monyantTtc,
            'produit_id'=>$request->produit_id,
            'command_id'=>$request->command_id,
        ]);
        return response()->json([
            'message'=>'modifier a ete success '
        ]);
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
        $facture= facture::find($id)->delete();
        return response()->json([
            'message'=>'supprimer a ete success '
        ]);
    }
}
