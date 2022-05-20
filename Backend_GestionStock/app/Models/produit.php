<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
    use HasFactory;
    protected $fillable=['familleProduit','nomProduit','referenceProduit','description','prixAchat','prixVente','commission','qauntitestock','depot_id','fournisseur_id'];
}
