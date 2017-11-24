<?php
  require_once('matriz.php');
  require_once('lector_imagen.php');
  class concentrece
  {
     private $tablero;
     private $jugador;
     private $imagenes;
     
     public function __construct()
     {
       $this->imagenes = new v_imagenes('img');
       $this->imagenes->Cargue();
       $n_img = $this->imagenes->get_Listado()->tamano();
       $columna = $n_img / 2;
       $fila = ($n_img * 2)/$columna;
       $this->tablero = new Cmatriz($fila,$columna); 
       $this->cargue_imagenes_tablero();
       $this->jugador = 'X';
     }
     
     
     public function get_Jugador()
     {
            return $this->jugador;
     }
     
     public function set_Jugador($valor)
          {
            $this->jugador = $valor;
          }
     
   
   
   
   public function revolver()
   {
    $cuadros = $this->get_Tablero()->get_Columna() * $this->get_Tablero()->get_Fila(); /* multiplica las columnas por las filas y se hace un ciclo for*/
      for($x=1;$x<100;$x++)
        {
	   $posA =  rand(1,$cuadros); /* esta es una posición por ejemplo (6) */
           $posB =  rand(1,$cuadros);	/* esta es otra poición por ejemplo (4) */
	   $ubicacion = $this->correlacion_coordenada($posA); /* aquí se correlacionan las posiciones y queda (6)(4) */
	   $xy = explode(":", $ubicacion); /* con este se dividen los numeros queda 6, 4 la posición como tal */
	    
	   $Tempimg = $this->get_Tablero()->get_Dato($xy[1],$xy[0]);
	   
	   $ubicacion = $this->correlacion_coordenada($posB);
	   $xyB = explode(":", $ubicacion);
	   $TempimgB = $this->get_Tablero()->get_Dato($xyB[1],$xyB[0]);
	   
	   $this->get_Tablero()->set_Dato($xy[1],$xy[0],$TempimgB);
           $this->get_Tablero()->set_Dato($xyB[1],$xyB[0],$Tempimg);	   
	}
   }
   
   
   
   
     public function cargue_imagenes_tablero()
     {
       $cuadros = $this->get_Tablero()->get_Columna() * $this->get_Tablero()->get_Fila();
        
       $n_img = $this->imagenes->get_Listado()->tamano();
       
       
       $this->imagenes->get_Listado()->rewind();
       for($x= 1;$x<=$n_img;$x++)
        {
	
	$ubicacion = $this->correlacion_coordenada($x); /* la ubicación está y la parte con explode*/
	$xy = explode(":", $ubicacion);
	
	$imagen = $this->imagenes->get_Listado()->current();
	
	$this->get_Tablero()->set_Dato($xy[1],$xy[0],$imagen);
	
	$imagenb =  new imagen($imagen->get_Imagen());
	$imagenb->set_Identificador($imagen->get_Identificador());
	
	
	
	$casillab = $n_img + $x;
	$ubicacion = $this->correlacion_coordenada($casillab);
	$xy = explode(":", $ubicacion);
	//$imagen = $this->imagenes->get_Listado()->current();
	$this->get_Tablero()->set_Dato($xy[1],$xy[0],$imagenb);
	
	$this->imagenes->get_Listado()->next();
	
	}
     }
     
     
     public function correlacion_coordenada($ordinal)
     {
       $ubicacion = '0,0';
     	  if ($ordinal  <= $this->get_Tablero()->get_Columna())
     	   {
     	   $fila = 0;
     	   $columna = $ordinal - 1;
     	   $ubicacion = $fila . ':' . $columna;	
     	   }
     	   
     	   else
     	    {
     	      $fila = floor(($ordinal - 1)/$this->get_Tablero()->get_Fila());
     	      $columna = ($ordinal - floor(($this->get_Tablero()->get_Columna()* (floor(($ordinal -1)/$this->get_Tablero()->get_Columna()))))) -1;
	      $ubicacion = $fila . ':' . $columna;	
     	    }
		 
          return $ubicacion;
       }
     	   
     
     public function movimiento($casillaA,$casillaB) 
     {
        $coordenadaA = $this->correlacion_coordenada($casillaA);
	
	$xy = explode(":", $coordenadaA);
	
	$imagenA =  $this->get_Tablero()->get_Dato($xy[1],$xy[0]);
	

	$coordenadaB = $this->correlacion_coordenada($casillaB);
	$xyB = explode(":", $coordenadaB);
	
	$imagenB =  $this->get_Tablero()->get_Dato($xyB[1],$xyB[0]);

	if ($imagenA->get_Identificador() == $imagenB->get_Identificador())
	  {
	     
	     
	     $imagenA->set_Estado(1);
	     $imagenB->set_Estado(1);
	     $this->get_Tablero()->set_Dato($xy[1],$xy[0],$imagenA);
	     $this->get_Tablero()->set_Dato($xyB[1],$xyB[0],$imagenB);
	     return 0;
	  }
	  
	else
	   return 1;	
	
     }
     
     
     public function get_Tablero()
     {
       return $this->tablero;
     }
     
     public function set_Tablero($tablero)
     {
      $this->tablero = $tablero;
     
     
     }
     

    public function visible_all($n)
    {
     for($x=0;$x<$this->get_Tablero()->get_Fila();$x++)
     {
	  for($j=0;$j<$this->get_Tablero()->get_Columna();$j++)
	   {
	      $imagen =  $this->get_Tablero()->get_Dato($j,$x); /* variable imagen se carga el tablero y se traen la corordenadas */
	      $imagen->set_Visible($n);
	      $this->get_Tablero()->set_Dato($j,$x,$imagen); /* a la coorrdenada se le agrega la imagen */
	   }
     }
	   	    
    }
     
   public function pintado()
   {
   	$numero=1;
    
    echo '<center><table    WIDTH=30% HEIGHT=30%  >';
    
    for($x=0;$x<$this->get_Tablero()->get_Fila();$x++)
    {
           echo "<tr>";
           for($j=0;$j<$this->get_Tablero()->get_Columna();$j++)
             {
	           echo "<td align=center>";
	           $imagen =  $this->get_Tablero()->get_Dato($j,$x);
             $imgg='"http://localhost/concentrece/'.$this->imagenes->get_Directorio() .'/'. $imagen->get_Imagen().'"';
                   if ($imagen->get_Estado() == 0)
	               {
		         if ($imagen->get_Visible() == 0)
			     {
	                  
                                
		                echo "<img src=" . $this->imagenes->get_Directorio() ."\\" . $imagen->get_Imagen() . ">";
				                
			     }
			  else
			   {
			        echo "<a href='javascript:jugar(".$numero.",x".$numero.",".$imgg.");'><img id='x".$numero."' name='x".$numero."' src=.\\img\\otras\\fondo.png ></a>";
		
			     		             
			   }
			   $this->get_Tablero()->set_Dato($j,$x,$imagen);
			 }
			 
		   else
		     {
		        //echo "<img src=.\\img\\otras\\correcta.png>";
			      echo "<img src=" . $this->imagenes->get_Directorio() ."\\" . $imagen->get_Imagen() . ">";
		     }	 
			 	
			   echo "</td>"; 
                       $numero++;
                       }
		      
		       
	      echo "</tr>";
       }
    echo "</table>";   
    }      
    
    
   
   }      
      
          
                           
    

  
?>