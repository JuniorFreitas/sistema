<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;
use ptb\Helper\DataHora;

class Video extends Model
{
    protected $table = 'videos';

    public $timestamps = false;

    protected $fillable = [
        'usuarios_id',
        'nome_video',
        'url_video',
        'data_video',
        'visto_video',
        'ativo_video',
        'slug_video',
    ];
    protected $guarded = ['id'];

    public function dataHoraCriado()
    {
        $data = new DataHora($this->data_video);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function dataHoraAtualizado()
    {
        $data = new DataHora($this->dataAtualizado);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function usuario()
    {
        return $this->hasOne('ptb\User', 'id', 'usuarios_id');
    }
}
