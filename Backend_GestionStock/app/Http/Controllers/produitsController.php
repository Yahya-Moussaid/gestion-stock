<?php

namespace App\Http\Controllers;

use App\Models\produit;
use App\Traits\ErrorSeccuss;
use Illuminate\Http\Request;

class produitsController extends Controller
{
    use ErrorSeccuss;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //afficher tout les produits
        $produits=produit::all();
        if (count($produits)===0) {
            return $this->errorMessage("ce produit n'exsit pas");
        }
        return response()->json($produits);
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
    public function store(Request $request ,produit $produit)
    {
        //ajouter un produit
        /* $produits=new produit();
        $request->nomProduit;
        $request->referenceProduit;
        $request->description;
        $request->prixAchat;
        $request->prixVente;
        $request->commission;
        $request->qauntitestock;*/
        $this->validate($request,['familleProduit'=>'required',
        'nomProduit'=>'required',
        'referenceProduit'=>'required',
        'description'=>'required',
        'prixAchat'=>'required',
        'prixVente'=>'required',
        'commission'=>'required',
        'qauntitestock'=>'required',
        'depot_id'=>'required']);
        $produit->create(
        ['familleProduit'=>$request->familleProduit,
        'nomProduit'=>$request->nomProduit,
        'referenceProduit'=>$request->referenceProduit,
        'description'=>$request->description,
        'prixAchat'=>$request->prixAchat,
        'prixVente'=>$request->prixVente,
        'commission'=>$request->commission,
        'qauntitestock'=> $request->qauntitestock,
        'depot_id'=>$request->depot_id]);
        return response()->json([$produit,'massege'=>'success add !!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //afficher un produit
        
        if($produit=produit::find($id)){
        $produit=['familleProduit'=>$produit->familleProduit,
        'nomProduit'=>$produit->nomProduit,
        'referenceProduit'=>$produit->referenceProduit,
        'description'=>$produit->description,
        'prixAchat'=>$produit->prixAchat,
        'prixVente'=>$produit->prixVente,
        'commission'=>$produit->commission,
        'qauntitestock'=> $produit->qauntitestock,
        'depot_id'=>$produit->depot_id
            ];
        return $this->returnData("produit",$produit);
    }
    else{   
            return $this->errorMessage("ce produit n'exsite pas");
        }
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
        //validation
        // $this->validate($request,['familleProduit'=>'required',
        // 'nomProduit'=>'required',
        // 'referenceProduit'=>'required',
        // 'description'=>'required',
        // 'prixAchat'=>'required',
        // 'prixVente'=>'required',
        // 'commission'=>'required',
        // 'qauntitestock'=>'required',
        // 'depot_id'=>'required']);
        //modification
        if($produit=produit::find($id)){
        $produit->update(
            ['familleProduit'=>($request->familleProduit)?$request->familleProduit:$produit->familleProduit,
        'nomProduit'=>($request->nomProduit)?$request->nomProduit:$produit->nomProduit,
        'referenceProduit'=>($request->referenceProduit)?$request->referenceProduit:$produit->referenceProduit,
        'description'=>($request->description)?$request->description:$produit->description,
        'prixAchat'=>($request->prixAchat)?$request->prixAchat:$produit->prixAchat,
        'prixVente'=>($request->prixVente)?$request->prixVente:$produit->prixVente,
        'commission'=>($request->commission)?$request->commission:$produit->commission,
        'qauntitestock'=> ($request->qauntitestock)?$request->qauntitestock:$produit->qauntitestock  ]
        );
        return response()->json([$produit,'message'=>'update success!!']);
        }else{
            return response()->json(['massge'=>"ce produit n'existe pas"]);
        }
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
        if($produit=produit::find($id)){
        $produit->delete();
        return response()->json(['message','produit a ete supprimer']);
    }else{
        return response()->json(['massge'=>"ce produit n'existe pas"]);
    }
}
}
