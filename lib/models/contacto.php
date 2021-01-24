<?php
use Illuminate\Database\Eloquent\Model;

//--------------------------------------------------------------------
class Mensaje extends Model
{
//    protected $table = 'mensajes';
//    protected $primaryKey = 'mensajesId';
    protected $fillable = ['nombre', 'correo', 'asunto', 'texto'];
}
