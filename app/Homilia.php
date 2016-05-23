<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;
use ptb\Helper\DataHora;

class Homilia extends Model
{
    protected $table = 'homilia';

    public $timestamps = false;

    protected $fillable = [
        'usuario',
        'titulo',
        'url',
        'cadastro',
        'ativo',
        'slug',
    ];
    protected $guarded = ['id'];

    public function dataHoraCriado()
    {
        $data = new DataHora($this->cadastro);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function dataHoraAtualizado()
    {
        $data = new DataHora($this->cadastro);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function usua()
    {
        return $this->hasOne('ptb\User', 'id', 'usuario');
    }
}
