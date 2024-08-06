<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Definir la relación con el modelo User
    protected $fillable = ['id_user', 'direccion', 'telefono'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_cliente');
    }
    public function dominios()
    {
        return $this->hasMany(Domain::class, 'id_cliente');
    }

    // Otras propiedades y métodos del modelo Client
}
