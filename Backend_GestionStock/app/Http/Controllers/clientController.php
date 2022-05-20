<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\client;
use App\Traits\ErrorSeccuss;
use Illuminate\Support\Facades\Validator;
class clientController extends Controller
{   use ErrorSeccuss;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //---->afficher les clients
        $clients=Client::all();
        if(!count($clients)==0)
            return $this->returnData('clients',$clients);
        return $this->errorMessage('vide !!');
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
        $validator=Validator::make($request->all(),
        ['required|nom',
        'required|prenom',
        'required|adresse',
        'required|telephone',
        'required|type']);
        $client=Client::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'adresse'=>$request->adresse,
            'telephone'=>$request->telephone,
            'type'=>$request->type]
        );
        return $this->seccussMessage('client est bien ajouter');
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
