<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateUtil
 *
 * @author Weslley Leandro
 */
class DateUtil extends CI_Model {
    /* FORMATOS PARA A SAIDA DA STRING */

    public static $FORMAT_UPPER = 201;
    public static $FORMAT_LOWER = 202;
    public static $FORMAT_UCFIRST = 203;
    public static $FORMAT_UCWORDS = 204;

    /* Retorna o primeiro dia do mes especificado */

    public function getFirstDay($mes, $ano) {
        return date("Y-m-d", mktime(0, 0, 0, $mes, 1, $ano));
    }

    /* Retorna o ultimo dia do mes especificado */

    public function getLastDay($mes, $ano) {
        return date("Y-m-d", mktime(0, 0, 0, $mes + 1, 0, $ano));
    }

    /* Retorna o nome do mes */

    public static function getNameMes($mes, $format = NULL) {
        $nameMes = strftime("%B", mktime(0, 0, 0, $mes, 1, date("Y")));
        $nameMesUtf8 = utf8_encode($nameMes);

        return DateUtil::formatString($nameMes, $format);
    }

    private static function formatString($string, $format) {

        switch ($format) {
            case ConstantsUtil::$FORMAT_UPPER:
                $string = strtoupper($string);
                break;

            case ConstantsUtil::$FORMAT_LOWER:
                $string = strtolower($string);
                break;

            case ConstantsUtil::$FORMAT_UCFIRST:
                $string = ucfirst($string);
                break;

            case ConstantsUtil::$FORMAT_UCWORDS:
                $string = ucwords($string);
                break;

            default :
                $string = ucfirst($string);
                break;
        }
        return utf8_encode($string);
    }

    /*
     * Calculo da difeRenca de datas
     * @ $date1, @date2
     */
    /*
      private static function dateDiferanca($data1, $data2) {
          $data1 = $data_de;
          $arr = explode('-', $data1);

          $data2 = $parcelaORdata_ate;
          $arr2 = explode('-', $data2);

          $dia1 = $arr[2];
          $mes1 = $arr[1];
          $ano1 = $arr[0];

          $dia2 = $arr2[2];
          $mes2 = $arr2[1];
          $ano2 = $arr2[0];

          $a1 = ($ano2 - $ano1) * 12;
          $m1 = ($mes2 - $mes1) + 1;
          $m3 = ($m1 + $a1);
          $parcelaORdata_ate = $m3;


      }
     */
}

?>
