<?php

  class imagen
  {
    private $imagen;
    private $estado; /* saber si la imagen esta volteada o no  1 o 0*/
    private $visible; /* mira si el estado esta en 1 o 0 */
    private $identificador; /*Cada imagen debe tener un identificador y sirve para diferenciarlas*/
    
    
    public function __construct($imagen)
    {
      $this->imagen = $imagen;
      $this->estado = 0;  /* cuando el estado esta en 0 es porque no esta visible */
      $this->visible = 1;
    }
    
    
    public function get_Imagen()
    {
       return $this->imagen;
    }
    
    public function set_Imagen($imagen)
    {
       $this->imagen = imagen;
    }
    
    public function get_Estado()
    {
      return $this->estado;
    }
    
    public function set_Estado($estado)
    {
      $this->estado = $estado;
    }  
    
    public function get_Visible()
    {
      return $this->visible;
    }
    
    
    public function set_Visible($visible)
    {
      $this->visible = $visible;
    }
    
    public function get_Identificador()
    {
      return $this->identificador;
    }
    
    public function set_Identificador($id)
    {
      $this->identificador = $id;
    }
    
      
      
    
  }
  
?>