<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class command extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $filleble=['qauntiteCmd',/*'client_id',*/'produit_id'];
}
