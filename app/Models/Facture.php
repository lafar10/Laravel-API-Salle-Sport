<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = "factures";

    protected $fillable = ['id', 'name', 'cin', 'subscribe', 'member_id', 'date_payment', 'etat', 'created_at', 'updated_at'];
}
