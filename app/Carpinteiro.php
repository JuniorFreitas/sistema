<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;
use ptb\Helper\DataHora;

class Carpinteiro extends Model
{

    protected $table = 'carpinteiro';

    public $timestamps = false;

    protected $fillable = [
        'titulo_carpinteiro',
        'arquivo_carpinteiro',
        'data_carpinteiro',
        'img_carpinteiro',
        'ativo_carpinteiro',
        'usuario_carpinteiro',
    ];
    protected $guarded = ['id'];

    public function dataHoraCriado()
    {
        $data = new DataHora($this->data_carpinteiro);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function dataHoraAtualizado()
    {
        $data = new DataHora($this->data_carpinteiro);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function usuario()
    {
        return $this->hasOne('ptb\User', 'id', 'usuario_carpinteiro');
    }

}
