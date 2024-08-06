<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'dominio';

    protected $fillable = [
        'url_dominio',
        'licencia',
        'id_cliente',
        'estado',
        // Otros campos si los hay
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
