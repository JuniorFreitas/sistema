<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;
use ptb\Helper\DataHora;

class Galeria extends Model
{

    protected $table = 'fotos';

    public $timestamps = false;

    protected $fillable = [
        'titulo_fotos',
        'capa_fotos',
        'url_fotos',
        'data_fotos',
        'ativo_fotos',
        'usuario_cadastrado',
    ];
    protected $guarded = ['id'];

    public function dataHoraCriado()
    {
        $data = new DataHora($this->data_fotos);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function dataHoraAtualizado()
    {
        $data = new DataHora($this->data_fotos);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function usuario()
    {
        return $this->hasOne('ptb\User', 'id', 'usuario_cadastrado');
    }

}
