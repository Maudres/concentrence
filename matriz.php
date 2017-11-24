<?php
class Cmatriz
{
  private $matriz;
  private $columna;
  private $fila;
  
  function __construct($columna, $fila)
  {
    $this->columna = $columna;
    $this->fila = $fila;
    $this->inicializar();
  }
  
  function get_Columna()
  {
     return $this->columna;
  }
  
  function get_Fila()
  {
    return $this->fila;
  }
  
  
  
  function inicializar()
  {
    for($x=0;$x<$this->get_Columna();$x++)
     for($j=0;$j<$this->get_Fila();$j++)
      {
        $this->matriz[$x][$j] = "-";
      }
  }
  
  
  function mostrar()
    {
      for($x=0;$x<$this->get_Columna();$x++)
      {
       for($j=0;$j<$this->get_Fila();$j++)
        {
          echo $this->get_Dato($x,$j)->get_Visible() . "<br>";
        }

	}
    }
    
    
  
  function get_Dato($columna,$fila)
  {
    return $this->matriz[$fila][$columna];
  }
  
  function set_Dato($columna,$fila,$valor)
    {
       $this->matriz[$fila][$columna] = $valor;
    }
  
}
?>