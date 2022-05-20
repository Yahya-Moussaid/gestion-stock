<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\command;
use App\Models\depot;
use App\Models\facture;
use App\Models\produit;
use App\Traits\ErrorSeccuss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class commandController extends Controller
{
    use ErrorSeccuss;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    
    $command=command::all();
    if(!count($command)===0)
        return $this->seccusMessage(['command'=>$command]);
    else{
    return response()->json(['message'=>'command vide !!']);
    }
    
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
        $validate=Validator::make($request->all(),
        ['qauntiteCmd'=>'required|quantiteCmd',
        'client_id'=>'required|client_id','produit_id'=>'required|produit_id']);
        $command=command::create([
            'qauntiteCmd'=>$request->qauntiteCmd,
            'produit_id'=>$request->produit_id]);
            if( $cmd=command::find($command)){
                foreach($cmd as $item){
                    $idCmd=$item->id;
                    $qauntite=$item->qauntiteCmd;
                }
                $produit=produit::where('id',$command->produit_id)->get();
                foreach ($produit as $item ) { 
                    $idProduit=$item->id;
                    $nomProduit=$item->nomProduit;
                    $prixVente=$item->prixVente;
                    $commission=$item->commission;
                
                }
                $mt=$prixVente*$qauntite;
                $tva=$mt*1.2;
            $facture=facture::create([
                'tva'=>$tva,
                'montantTotal'=>$mt,
                'Ttc'=>$mt+$tva,
                'produit_id'=>$idProduit,
                'command_id'=>$idCmd,
            ]);
          //  return "prix:".$prixVente.",qntcmd:".$qauntite.",facture:".$facture;
            return $this->seccussMessage('ajoute a ete success.');
        } return $this->errorMessage('cette command n\'ajoute pas');
        
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
        if ($command=command::find($id)) {
            $client=client::where('id',$command->client_id)->get();
            foreach ($client as $item1 ) {
                $Client=$item1->prenom.' '.$item1->nom;
            }
            $produit=produit::where('id',$command->produit_id)->get();
            foreach ($produit as $item ) {
                $nomProduit=$item->nomProduit;
                $prixVente=$item->prixVente.' '.$item->commission;
                $description=$item->description;
            }
            $command=[
                ''=>'COMMAND DE PRODUIT',
            'nom client'=>$Client,
            'nom produit'=>$nomProduit,
            'description'=>$description,
            'prixVente'=>$prixVente,
            'qauntite de command'=>$command->qauntiteCmd
            ]; 
            return $this->returnData('command',$command);
        }
        else {
            return $this->errorMessage("ce produit n'existe pas");       
        }
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
        if($command=command::find($id)){
        $command->update(
            [
                'qauntiteCmd'=>($request->qauntiteCmd)?$request->qauntiteCmd:$command->qauntiteCmd,
                'client_id'=>($request->client_id)?$request->client_id:$command->client_id,
                'produit_id'=>($request->produit_id)?$request->produit_id:$command->produit_id
            ]
            );
            return $this->returnData('command',$command);
        }else{
            return $this->errorMessage("ce produit n'existe pas");
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
        $command=command::find($id);
        $command->delete();
        return $this->seccussMessage('produit a ete supprimer ');
    }
}
