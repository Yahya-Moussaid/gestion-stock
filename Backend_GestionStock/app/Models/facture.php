<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable=["tva","montantTotal","Ttc","produit_id","command_id"];
}
