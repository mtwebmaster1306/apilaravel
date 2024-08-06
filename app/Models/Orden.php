<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    // Definir la relación con el modelo User
// app/Models/Orden.php

protected $table = 'orden';

protected $fillable = [
    'id_cliente', 'id_dominio', 'estado', 'fecha_exp',
];

public function cliente()
{
    return $this->belongsTo(Cliente::class, 'id_cliente');
}

public function dominio()
{
    return $this->belongsTo(Domain::class, 'id_dominio');
}


}
