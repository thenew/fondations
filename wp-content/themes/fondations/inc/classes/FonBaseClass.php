<?php
class Fon_Base_Class
{

  public static function beautify($string)
  {
    return ucwords(str_replace('_', ' ', $string));
  }

  public static function uglify($string)
  {
    return strtolower(str_replace(' ', '_', $string));
  }


  public static function pluralize($string)
  {
    $last = $string[strlen($string) - 1];

    if($last == 'y')
    {
      $cut = substr($string, 0, -1);
      //convert y to ies
      $plural = $cut . 'ies';
    }
    else
    {
      // just attach an s
      $plural = $string . 's';
    }

    return $plural;
  }

}