<?php
namespace App\Library;
/**
 * Created by PhpStorm.
 * User: glam
 * Date: 11/27/15
 * Time: 5:43 AM
 */
class Datify
{
    public static function toDate($str=NULL, $separator = null)
    {
        if ($separator == null) {
            $separator = ' ';
        }else{
            $separator = $separator;
        }

        if ($str != NULL)
        {
            $a = explode($separator, $str);
            switch ($a[1]) {
                case 'Januari':
                    $b = '01';
                    break;
                case 'Februari':
                    $b = '02';
                    break;
                case 'Maret':
                    $b = '03';
                    break;
                case 'April':
                    $b = '04';
                    break;
                case 'Mei':
                    $b = '05';
                    break;
                case 'Juni':
                    $b = '06';
                    break;
                case 'Juli':
                    $b = '07';
                    break;
                case 'Agustus':
                    $b = '08';
                    break;
                case 'September':
                    $b = '09';
                    break;
                case 'Oktober':
                    $b = '10';
                    break;
                case 'November':
                    $b = '11';
                    break;
                case 'Desember':
                    $b = '12';
                    break;
                default:
                    $b = '01';
                    break;
            }
            $tgl = date('Y-m-d', strtotime($a[2] . '-' . $b . '-' . $a[0]));
            return $tgl;
        }else{
            return false;
        }
    }

    public static function readify($date=NULL, $separator = null)
    {
        if ($separator == null) {
            $separator = '-';
        }else{
            $separator = $separator;
        }

        if ($date != NULL)
        {
            $a = explode($separator, $date);
            switch ($a[1]) {
                case '01':
                    $b = 'Januari';
                    break;
                case '02':
                    $b = 'Februari';
                    break;
                case '03':
                    $b = 'Maret';
                    break;
                case '04':
                    $b = 'April';
                    break;
                case '05':
                    $b = 'Mei';
                    break;
                case '06':
                    $b = 'Juni';
                    break;
                case '07':
                    $b = 'Juli';
                    break;
                case '08':
                    $b = 'Agustus';
                    break;
                case '09':
                    $b = 'September';
                    break;
                case '10':
                    $b = 'Oktober';
                    break;
                case '11':
                    $b = 'November';
                    break;
                case '12':
                    $b = 'Desember';
                    break;
                default:
                    $b = 'Januari';
                    break;
            }
            $tgl = $a[2] . ' ' . $b . ' ' . $a[0];
            return $tgl;
        }else{
            return false;
        }
    }
}