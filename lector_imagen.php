<?php
require_once('collection.php');
require_once('imagen.php');
  class v_imagenes
  {
     private $listado; /* */
     private $directorio; /* donde estan las imagenes */
     
     
     public function __construct($directorio)
     {
        $this->listado = new collection();
	$this->directorio = $directorio;
     }
     
     
     public function get_Directorio()
     {
       return $this->directorio;
     }
     
     
     public function set_Directorio($directorio)
     {
       $this->directorio = $directorio;
     }
     
     
     public function set_Dato($dato)
     {
       $this->listado->add($dato);
     }
     
     
     
     public function Cargue()
     {
         $dirint = dir($this->get_Directorio());
	 $ind = 1;
	 while (($archivo = $dirint->read()) !== false)
	     {
	       if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("png", $archivo))
	        {
		   $img = new imagen($archivo);
		   $img->set_identificador($ind);
		   $this->set_Dato($img);
		   ++$ind;
		}
	         
	     }
	     $dirint->close();
	 
       
     }
     
     
     public function get_Listado()
     {
       return $this->listado;
     
     }
     
  
  }
  
  ?>