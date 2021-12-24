<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "members";

    protected $fillable = ['id', 'name', 'cin', 'tele', 'age', 'adresse', 'subscribe', 'assurance', 'date_assurance', 'date_payment_assurance', 'etat', 'created_at', 'updated_at'];
}
