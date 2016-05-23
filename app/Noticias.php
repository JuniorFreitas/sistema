<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;
use ptb\Helper\DataHora;

class Noticias extends Model
{
    protected $table = 'noticias';

    public $timestamps = false;

    protected $fillable = [
        'usuarios_id',
        'tipos_id',
        'titulo_noticias',
        'descricao_noticias',
        'materia_noticias',
        'data_noticias',
        'slug_noticias',
        'fonte_noticias',
        'ativo_noticias',
        'contador_noticias',
        'usuarioAtualiza_noticias',
        'dataProgramada_noticias',
        'dataAtualizada_noticias',
        'img_noticias',

    ];
    protected $guarded = ['id'];


    public function dataHoraCriado()
    {
        $data = new DataHora($this->data_noticias);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function dataHoraProgramada()
    {
        $data = new DataHora($this->dataProgramada_noticias);
        return $data->dataCompleta();
    }

    public function cat()
    {
        return $this->hasOne('ptb\Categoria', 'id', 'tipos_id');
    }

    public function usuarioCriado()
    {
        return $this->hasOne('ptb\User', 'id', 'usuarios_id');
    }
}

