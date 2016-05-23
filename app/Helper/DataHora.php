<?php
namespace ptb\Helper;


/*
  Desenvolvido por: Felipe Augusto Ramos Timoteo ( Felipe-FlashMaster )
  versao: 2.5.2
  ultima atualiza��o: 20/09/2011 15:22:00
  -Adicionado metodos para contagem de minutos, nas programoes do agendamento
  -O metodo construtor foi modificado usando expressao regular
  -O metodos addDia, foi adicionado mais um parametro, $atualizarObjetoAtual

  Modos de uso
  new DataHora(null); // recomendado null para evitar mensagens de erro
  new DataHora('1984-09-03'); do banco
  new DataHora('19/03/1984'); pelo usuario
  new DataHora('1984-09-03 10:16:00'); do banco
  new DataHora('19/03/1984 10:16:00'); pelo usuario
  new DataHora('10:16:00'); ou do banco ou pelo usuario

 */
date_default_timezone_set("America/Fortaleza");

// Recusa o hor�rio de verao de SP (uma hora a mais);

class DataHora {

    // Propriedades

    var $dia = "dd";
    var $mes = "mm";
    var $ano = "aaaa";
    // var $data="dd/mm/aaaa"; // dia completo
    var $hora = "hh";
    var $minuto = "mm";
    var $segundo = "ss";
    // var $tempo="00:00:00"; // hora completa
    //CONSTANTES
    //var $SEGUNDO = 1; // 1 segundo em timestamp
    //var $MINUTO; // 1 minuto em timestamp
    //var $HORA; // uma hora em timestamp
    //var $DIA; // 1 dia em timestamp
    //var $MES; // 1 m�s em timestamp, 30 dias mesmo e n�o 31
    //var $ANO; // 1 ano em timestamp
    // nomes por extenso min�sculo
    var $mes_extm = array("null", "janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro");
    var $dia_extm = array("null", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "onze", "doze", "treze", "quatorze", "quinze", "dezeseis", "dezesete", "dezoito", "dezenove", "vinte", "vinte e um", "vinte e dois", "vinte tr�s", "vinte e quatro", "vinte e cinco", "vinte e seis", "vinte e sete", "vinte e oito", "vinte e nove", "trinta", "trinta e um");
    var $dia_semana_extm = array("null", "segunda-feira", "terça-feira", "quarta-feira", "quinta-feira", "sexta-feira", "sábado", "domingo");
    // nomes por extenso mai�sculo
    var $mes_extM = array("null", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    var $dia_extM = array("null", "Um", "Dois", "Três", "Quatro", "Cinco", "Seis", "Sete", "Oito", "Nove", "Dez", "Onze", "Doze", "Treze", "Quatorze", "Quinze", "Dezeseis", "Dezesete", "Dezoito", "Dezenove", "Vinte", "Vinte e um", "Vinte e dois", "Vinte tr�s", "Vinte e quatro", "Vinte e cinco", "Vinte e seis", "Vinte e sete", "Vinte e oito", "Vinte e nove", "Trinta", "Trinta e um");
    var $dia_semana_extM = array("null", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo");

    //CONSTRUTOR
    public function __construct($data_e_hora) {

        if (isset($data_e_hora)) { // se for passado algum parametro...
            // se informar por exemplo '1984-03-19 10:58:00'...
            if (preg_match("/^\d{4}-\d{2}-\d{2} \d{2}\:\d{2}\:\d{2}$/", $data_e_hora)) {

                $partes = explode(' ', $data_e_hora); // separa as partes data e hora
                $pt_Data = explode('-', $partes[0]); // divide a data  em dia mes e ano se for '1984-03-19'

                if ($pt_Data[2] < 10) { // mdia
                    if (strpos($pt_Data[2], "0") === false) { // se nao encontrar zero adiciona
                        $pt_Data[2] = "0" . $pt_Data[2];
                    }
                }
                if ($pt_Data[1] < 10) { // mes
                    if (strpos($pt_Data[1], "0") === false) { // se nao encontrar zero adiciona
                        $pt_Data[1] = "0" . $pt_Data[1];
                    }
                }

                $this->dia = $pt_Data[2];
                $this->mes = $pt_Data[1];
                $this->ano = $pt_Data[0];

                $this->dia = date('d', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->mes = date('m', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->ano = date('Y', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));

                //----------------------------

                $pt_Hora = explode(":", $partes[1]); // separa em hora , minuto e segundo
                $this->hora = $pt_Hora[0];
                $this->minuto = $pt_Hora[1];
                $this->segundo = $pt_Hora[2];

                $this->hora = date('H', mktime($this->hora, $this->minuto, $this->segundo));
                $this->minuto = date('i', mktime($this->hora, $this->minuto, $this->segundo));
                $this->segundo = date('s', mktime($this->hora, $this->minuto, $this->segundo));
            }

            //  // se for '19/03/1984' 10:58:00
            if (preg_match("/^\d{2}\/\d{2}\/\d{4} \d{2}\:\d{2}\:\d{2}$/", $data_e_hora)) {

                $partes = explode(' ', $data_e_hora); // separa as partes data e hora			
                $pt_Data = explode('/', $partes[0]); // divide a data  em dia mes e ano se for '19/03/1984' 10:58:00

                if ($pt_Data[0] < 10) {
                    if (strpos($pt_Data[0], "0") === false) {
                        $pt_Data[0] = "0" . $pt_Data[0];
                    }
                }
                if ($pt_Data[1] < 10) {
                    if (strpos($pt_Data[1], "0") === false) {
                        $pt_Data[1] = "0" . $pt_Data[1];
                    }
                }

                $this->dia = $pt_Data[0];
                $this->mes = $pt_Data[1];
                $this->ano = $pt_Data[2];

                $this->dia = date('d', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->mes = date('m', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->ano = date('Y', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));


                $pt_Hora = explode(":", $partes[1]); // separa em hora , minuto e segundo
                $this->hora = $pt_Hora[0];
                $this->minuto = $pt_Hora[1];
                $this->segundo = $pt_Hora[2];

                $this->hora = date('H', mktime($this->hora, $this->minuto, $this->segundo));
                $this->minuto = date('i', mktime($this->hora, $this->minuto, $this->segundo));
                $this->segundo = date('s', mktime($this->hora, $this->minuto, $this->segundo));
            }

            //-------------------------------------------------APENAS DATA OU HORA------------------------------------------------
            // se for passado 00:00:00
            if (preg_match("/^\d{2}\:\d{2}\:\d{2}$/", $data_e_hora)) {

                $partes = explode(':', $data_e_hora); // separa as partes data e hora
                $this->hora = $partes[0];
                $this->minuto = $partes[1];
                $this->segundo = $partes[2];

                $this->hora = date('H', mktime($this->hora, $this->minuto, $this->segundo));
                $this->minuto = date('i', mktime($this->hora, $this->minuto, $this->segundo));
                $this->segundo = date('s', mktime($this->hora, $this->minuto, $this->segundo));
            }


            // se for passado 00:00
            if (preg_match("/^\d{2}\:\d{2}$/", $data_e_hora)) {

                $partes = explode(':', $data_e_hora); // separa as partes data e hora
                $this->hora = $partes[0];
                $this->minuto = $partes[1];
                $this->segundo = "00";

                $this->hora = date('H', mktime($this->hora, $this->minuto, $this->segundo));
                $this->minuto = date('i', mktime($this->hora, $this->minuto, $this->segundo));
                $this->segundo = date('s', mktime($this->hora, $this->minuto, $this->segundo));
            }

            // se for passado 13/03/2011
            if (preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $data_e_hora)) {

                $partes = explode('/', $data_e_hora); // separa as partes data e hora
                $this->dia = $partes[0];
                $this->mes = $partes[1];
                $this->ano = $partes[2];

                $this->dia = date('d', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->mes = date('m', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->ano = date('Y', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
            }

            // se for passado 2011-03-13
            if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $data_e_hora)) {

                $partes = explode('-', $data_e_hora); // separa as partes data e hora
                $this->dia = $partes[2];
                $this->mes = $partes[1];
                $this->ano = $partes[0];

                $this->dia = date('d', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->mes = date('m', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
                $this->ano = date('Y', mktime(0, 0, 0, $this->mes, $this->dia, $this->ano));
            }
        } else { // se foi passado NULL...
            $this->atual(); // aplica a data e hora atual
        }
    }

// FIM DO CONSTRUTOR
    //METODOS
    function dataInsert() {// cadastrar no banco
        return $this->ano() . '-' . $this->mes() . '-' . $this->dia();
    }

    function horaInsert() {// cadastrar no banco
        return $this->hora() . ':' . $this->minuto() . ':' . $this->segundo();
    }

    function dataHoraInsert() {// cadastrar no banco
        return $this->dataInsert() . ' ' . $this->horaInsert();
    }

    function dataCompleta() {
        return $this->dia . "/" . $this->mes . "/" . $this->ano;
    }

    function dataCompletaExt() {
        return $this->dia . " de " . $this->mesExtM() . " de " . $this->ano();
    }

    function horaCompleta() {
        return $this->hora . ":" . $this->minuto . ":" . $this->segundo;
    }

    function dia() {
        return $this->dia;
    }

    function setDia($dia) {
        $timestamp = mktime(0, 0, 0, $this->mes, $dia, $this->ano);
        $this->dia = date('d', $timestamp);
        $this->mes = date('m', $timestamp);
        $this->ano = date('Y', $timestamp);
        // caso seja passado dia, 31 em um mes de fevereiro(28 dias) , passa automaticamente para o proximo m�s.
    }

    function diaExt() {// dia por extenso
        if ($this->dia() < 10) {
            $tmp = substr($this->dia(), 1);
            return $this->dia_extm[$tmp];
        } else {
            return $this->dia_extm[$this->dia()];
        }
    }

    function diaExtM() {// dia por extenso
        if ($this->dia() < 10) {
            $tmp = substr($this->dia(), 1);
            return $this->dia_extM[$tmp];
        } else {
            return $this->dia_extM[$this->dia()];
        }
    }

    function diaSemanaExt() {
        return $this->dia_semana_extm[date("N", mktime(0, 0, 0, $this->mes(), $this->dia(), $this->ano()))]; // dia da semana de 1 a 7 (verificar isso date('N') retorna a semana atual e nao a que foi passada)
    }

    function diaSemanaExtM() {
        return $this->dia_semana_extM[date("N", mktime(0, 0, 0, $this->mes(), $this->dia(), $this->ano()))]; // dia da semana de 1 a 7 (verificar isso date('N') retorna a semana atual e nao a que foi passada)
    }

    function diaSemanaNum() { // retorna dia da semana atual em numero, 1 (segunda) e 7 (domingo)
        return date("N", mktime(0, 0, 0, $this->mes(), $this->dia(), $this->ano()));
    }

    function primeiroDiaSemanaNum() {
        return date("N", mktime(0, 0, 0, $this->mes(), 1, $this->ano()));
    }

    function primeiroDiaSemanaExt() {
        return $this->dia_semana_extm[date('N', mktime(0, 0, 0, $this->mes(), 1, $this->ano()))]; // dia da semana de 1 a 7
    }

    function ultimoDiaMes() {
        return date('t', mktime(0, 0, 0, $this->mes(), $this->dia(), $this->ano()));
    }

    function mes() {
        return $this->mes;
    }

    function setMes($mes) {
        $timestamp = mktime(0, 0, 0, $mes, $this->dia, $this->ano);
        $this->dia = date('d', $timestamp);
        $this->mes = date('m', $timestamp);
        $this->ano = date('Y', $timestamp);
    }

    function mesExt() {
        if ($this->mes() < 10) {
            $tmp = substr($this->mes(), 1);
            return $this->mes_extm[$tmp];
        } else {
            return $this->mes_extm[$this->mes()];
        }
    }

    function mesExtM() {
        if ($this->mes() < 10) {
            $tmp = substr($this->mes(), 1);
            return $this->mes_extM[$tmp];
        } else {
            return $this->mes_extM[$this->mes()];
        }
    }

    function ano() {
        return $this->ano;
    }

    function setAno($ano) {
        $timestamp = mktime(0, 0, 0, $this->mes, $this->dia, $ano);
        $this->dia = date('d', $timestamp);
        $this->mes = date('m', $timestamp);
        $this->ano = date('Y', $timestamp);
    }

    function hora() {
        return $this->hora;
    }

    function setHora($hora) {
        $timestamp = mktime($hora, $this->minuto, $this->segundo);
        $this->hora = date("H", $timestamp);
        $this->minuto = date("i", $timestamp);
        $this->segundo = date("s", $timestamp);
    }

    function minuto() {
        return $this->minuto;
    }

    function setMinuto($minuto) {
        $timestamp = mktime($this->hora, $minuto, $this->segundo);
        $this->hora = date("H", $timestamp);
        $this->minuto = date("i", $timestamp);
        $this->segundo = date("s", $timestamp);
    }

    function segundo() {
        return $this->segundo;
    }

    function setSegundo($segundo) {
        $timestamp = mktime($this->hora, $this->minuto, $segundo);
        $this->hora = date("H", $timestamp);
        $this->minuto = date("i", $timestamp);
        $this->segundo = date("s", $timestamp);
    }

    function nomeUnico() {// auxilia em nomes de arquivos
        $this->atual();
        return $this->dia() . $this->mes() . $this->ano() . $this->hora() . $this->minuto() . $this->segundo();
    }

    // metodos que usam timestamp##############################################################################################

    private function dataParaTime($data) { // converta uma data para timestamp
        $obj = new DataHora($data);
        $timestamp = mktime(0, 0, 0, $obj->mes(), $obj->dia(), $obj->ano());
        return $timestamp;
    }

    private function dataParaTimeCompleta($data) { // // converta uma data para timestamp com hora,minuto,segundo,dia,mes e ano
        $obj = new DataHora($data);
        $timestamp = mktime($obj->hora(), $obj->minuto(), $obj->segundo(), $obj->mes(), $obj->dia(), $obj->ano());
        return $timestamp;
    }

    function intervaloDias($inicio, $fim) { // retorna true se a Data de hoje est� dentro do intervalo dos parametros $inicio e $fim (apenas data)
        $hoje = new DataHora(null); // hoje
        $hoje = $hoje->dataCompleta();

        if ($this->dataParaTime($hoje) < $this->dataParaTime($inicio) || $this->dataParaTime($hoje) > $this->dataParaTime($fim)) {
            return false;
        } else {
            return true;
        }
    }

    function intervaloTempo($inicio, $fim) { // retorna true se a Data de hoje(incluindo horas, minuto e segundo) est� dentro do intervalo dos parametros $inicio e $fim
        $hoje = new DataHora(null); // hoje
        $hoje = $hoje->dataHoraInsert();

        if ($this->dataParaTimeCompleta($hoje) < $this->dataParaTimeCompleta($inicio) || $this->dataParaTimeCompleta($hoje) > $this->dataParaTimeCompleta($fim)) {
            return false;
        } else {
            return true;
        }
    }

    function addDia($_dias, $atualizaObjetoAtual = true) { // adiciona quantos dias vc quiser passando quantidade de dias.
        //$timestamp=strtotime($_data);
        //$timestamp=$timestamp + ($this->DIA * $_dias);
        //return date('d/m/Y',$timestamp);
        $obj = new DataHora($this->dataCompleta()); // mexer no proprio objeto
        $timestamp = mktime(0, 0, 0, $obj->mes(), $obj->dia() + $_dias, $obj->ano());
        $novo = new DataHora(date('d/m/Y', $timestamp));
        if ($atualizaObjetoAtual == true) {
            $this->setDia($novo->dia());
            $this->setMes($novo->mes());
            $this->setAno($novo->ano());
        }
        return date('d/m/Y', $timestamp);
    }

    /* 	function addDia($_dias) { // adiciona quantos dias vc quiser passando quantidade de dias.
      //$timestamp=strtotime($_data);
      //$timestamp=$timestamp + ($this->DIA * $_dias);
      //return date('d/m/Y',$timestamp);
      $obj = new DataHora($this->dataCompleta()); // mexer no proprio objeto
      $timestamp = mktime(0, 0, 0, $obj->mes(), $obj->dia() + $_dias, $obj->ano());
      $novo = new DataHora(date('d/m/Y', $timestamp));
      $this->setDia($novo->dia());
      $this->setMes($novo->mes());
      $this->setAno($novo->ano());
      return date('d/m/Y', $timestamp);
      }
     */

    function subtrairDia($_dias) { // subtrai quantos dias vc quiser passando quantidade de dias.
        //$timestamp=strtotime($_data);
        //$timestamp=$timestamp + ($this->DIA * $_dias);
        //return date('d/m/Y',$timestamp);
        $obj = new DataHora($this->dataCompleta()); // mexer no proprio objeto
        $timestamp = mktime(0, 0, 0, $obj->mes(), $obj->dia() - $_dias, $obj->ano());
        $novo = new DataHora(date('d/m/Y', $timestamp));
        $this->setDia($novo->dia());
        $this->setMes($novo->mes());
        $this->setAno($novo->ano());
        return date('d/m/Y', $timestamp);
    }

    function addMes($_meses) {
        //$timestamp=strtotime($_data);
        //$timestamp=$timestamp + ($this->MES * $_meses);
        //return date('d/m/Y',$timestamp);
        $obj = new DataHora($this->dataCompleta()); // mexer no proprio objeto
        $timestamp = mktime(0, 0, 0, $obj->mes() + $_meses, $obj->dia(), $obj->ano());
        $novo = new DataHora(date('d/m/Y', $timestamp));
        $this->setDia($novo->dia());
        $this->setMes($novo->mes());
        $this->setAno($novo->ano());
        return date('d/m/Y', $timestamp);
    }

    function subtrairMes($_meses) {
        //$timestamp=strtotime($_data);
        //$timestamp=$timestamp + ($this->MES * $_meses);
        //return date('d/m/Y',$timestamp);
        $obj = new DataHora($this->dataCompleta()); // mexer no proprio objeto
        $timestamp = mktime(0, 0, 0, $obj->mes() - $_meses, $obj->dia(), $obj->ano());
        $novo = new DataHora(date('d/m/Y', $timestamp));
        $this->setDia($novo->dia());
        $this->setMes($novo->mes());
        $this->setAno($novo->ano());
        return date('d/m/Y', $timestamp);
    }

    function addAno($_anos) {
        $obj = new DataHora($this->dataCompleta()); // mexer no proprio objeto
        $timestamp = mktime(0, 0, 0, $obj->mes(), $obj->dia(), $obj->ano() + $_anos);
        $novo = new DataHora(date('d/m/Y', $timestamp));
        $this->setDia($novo->dia());
        $this->setMes($novo->mes());
        $this->setAno($novo->ano());
        return date('d/m/Y', $timestamp);
    }

    function subtrairAno($_anos) {
        $obj = new DataHora($this->dataCompleta()); // mexer no proprio objeto
        $timestamp = mktime(0, 0, 0, $obj->mes(), $obj->dia(), $obj->ano() - $_anos);
        $novo = new DataHora(date('d/m/Y', $timestamp));
        $this->setDia($novo->dia());
        $this->setMes($novo->mes());
        $this->setAno($novo->ano());
        return date('d/m/Y', $timestamp);
    }

    function addSegundo($_segundos) {
        $obj = new DataHora($this->horaCompleta()); // mexer no proprio objeto
        $timestamp = mktime($obj->hora(), $obj->minuto(), $obj->segundo() + $_segundos);
        $novo = new DataHora(date('H:i:s', $timestamp));
        $this->setHora($novo->hora());
        $this->setMinuto($novo->minuto());
        $this->setSegundo($novo->segundo());
        return date('H:i:s', $timestamp);
    }

    function subtrairSegundo($_segundos) {
        $obj = new DataHora($this->horaCompleta()); // mexer no proprio objeto
        $timestamp = mktime($obj->hora(), $obj->minuto(), $obj->segundo() - $_segundos);
        $novo = new DataHora(date('H:i:s', $timestamp));
        $this->setHora($novo->hora());
        $this->setMinuto($novo->minuto());
        $this->setSegundo($novo->segundo());
        return date('H:i:s', $timestamp);
    }

    function addMinuto($_minutos) {
        $obj = new DataHora($this->horaCompleta()); // mexer no proprio objeto
        $timestamp = mktime($obj->hora(), $obj->minuto() + $_minutos, $obj->segundo());
        $novo = new DataHora(date('H:i:s', $timestamp));
        $this->setHora($novo->hora());
        $this->setMinuto($novo->minuto());
        $this->setSegundo($novo->segundo());
        return date('H:i:s', $timestamp);
    }

    function subtrairMinuto($_minutos) {
        $obj = new DataHora($this->horaCompleta()); // mexer no proprio objeto
        $timestamp = mktime($obj->hora(), $obj->minuto() - $_minutos, $obj->segundo());
        $novo = new DataHora(date('H:i:s', $timestamp));
        $this->setHora($novo->hora());
        $this->setMinuto($novo->minuto());
        $this->setSegundo($novo->segundo());
        return date('H:i:s', $timestamp);
    }

    function addHora($_horas) {
        $obj = new DataHora($this->horaCompleta()); // mexer no proprio objeto
        $timestamp = mktime($obj->hora() + $_horas, $obj->minuto(), $obj->segundo());
        $novo = new DataHora(date('H:i:s', $timestamp));
        $this->setHora($novo->hora());
        $this->setMinuto($novo->minuto());
        $this->setSegundo($novo->segundo());
        return date('H:i:s', $timestamp);
    }

    function subtrairHora($_horas) {
        $obj = new DataHora($this->horaCompleta()); // mexer no proprio objeto
        $timestamp = mktime($obj->hora() - $_horas, $obj->minuto(), $obj->segundo());
        $novo = new DataHora(date('H:i:s', $timestamp));
        $this->setHora($novo->hora());
        $this->setMinuto($novo->minuto());
        $this->setSegundo($novo->segundo());
        return date('H:i:s', $timestamp);
    }

    function diferencaMinutos($hora_completa1, $hora_completa2) { // hora_completa1(maior), hora_completa2(menor)
        $obj1 = new DataHora($hora_completa1);
        $obj2 = new DataHora($hora_completa2);

        $horas1 = $obj1->hora();
        $minutos1 = $obj1->minuto();
        $total1 = ($horas1 * 60) + ($minutos1);

        $horas2 = $obj2->hora();
        $minutos2 = $obj2->minuto();
        $total2 = $horas2 * 60 + ($minutos2);

        $diferenca = $total1 - $total2;
        return $diferenca; // em minutos
    }

    function diferencaAnos($_data1, $_data2) { // hoje(ou maior),anterior(data menor)
        $obj_data1 = new DataHora($_data1);
        $obj_data2 = new DataHora($_data2);
        $timestamp1 = mktime(0, 0, 0, $obj_data1->mes(), $obj_data1->dia(), $obj_data1->ano());
        $timestamp2 = mktime(0, 0, 0, $obj_data2->mes(), $obj_data2->dia(), $obj_data2->ano());
        //$diferenca=$timestamp1-$timestamp2;
        //60 seg * 60 min * 24 horas * 365 dias do ano = 31536000
        $diferenca = ($timestamp1 - $timestamp2) / 31536000;
        //echo "time1: ".$timestamp1."<br>";
        //echo "time2: ".$timestamp2."<br>";
        //echo "DIFEREN�A: ".$diferenca."<br>";
        return floor($diferenca); // arredonda pra baixo
    }

    function diferencaDias($_data1, $_data2) { // hoje(ou maior),anterior(data menor)
        $obj_data1 = new DataHora($_data1);
        $obj_data2 = new DataHora($_data2);
        $timestamp1 = mktime(0, 0, 0, $obj_data1->mes(), $obj_data1->dia(), $obj_data1->ano());
        $timestamp2 = mktime(0, 0, 0, $obj_data2->mes(), $obj_data2->dia(), $obj_data2->ano());
        //24 horas * 60 Min * 60 seg = 86400
        $diferenca = ($timestamp1 - $timestamp2) / 86400;
        //echo "time1: ".$timestamp1."<br>";
        //echo "time2: ".$timestamp2."<br>";
        //echo "DIFEREN�A: ".$diferenca."<br>";

        return floor($diferenca);
    }

    function atual() { // aplica data e hora atual
        $this->dia = date('d');
        $this->mes = date('m');
        $this->ano = date('Y');

        $this->hora = date('H');
        $this->minuto = date('i');
        $this->segundo = date('s');
    }

}

// FIM DA CLASSE
