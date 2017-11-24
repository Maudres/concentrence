<?php

class collection  implements  iterator
{
  private $coleccion;
  private $position=0;
    
  function __construct()
  {
    $this->coleccion = Null;
    $this->position = -1;
  }  
  
    
  function add($dato) # Agrega un nuevo objeto a la coleccion #
  {      
    $this->coleccion[] = $dato;
  }
  
  function sobreescribir($dato) # Sobreescribe un dato, en la posicion actual
  {      
    $this->coleccion[$this->position] = $dato;
  }
  
  function eliminar() # Elimina un objeto y corre una posicion, para que no queden vacios
  {

    array_splice($this->coleccion,$this->position,1); 
  }

  function rewind() # Rebobina la posicicion de la coleccion
  {
        $this->position = 0;
  }

  function tamano() # cuenta el tamaño o el numero de objetos que tiene esa coleccion
  {
    return count($this->coleccion);
  }
  
  function current() { #retorna el  objeto de la posicion actual 
     return $this->coleccion[$this->position];
  }

  function key() { 
      return $this->position;
  }

  function next() { #aumenta la posicion de un objeto en +1 
   
      ++$this->position;
  }

  function valid() { #verifica si un posicion es valida en una coleccion
        return isset($this->coleccion[$this->position]);
  }

  function buscar($propertyName,$property) #busca o compara el dato ingresado con alguno almacenado en la coleccion
  {
     $this->rewind();
     $dato = NULL;
     
     while($this->valid())
          {
             
            $dato =  $this->getByProperty($propertyName,$property);
              if ($dato != NULL)
              {
	        
                return $dato;
              }
              $this->next();
          }
        return $dato;

  }

  function getByProperty($propertyName, $property) 
     {
         $methodName = $propertyName;
	 
	 
         $obj = $this->current();
	 
                if ($obj->{$methodName}() == $property)
                   {
                     
                     return $obj;
                   }
                  

            return false;
     }
}
?>