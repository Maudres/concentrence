<html>
<title>CONCENTRESE</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="rotate3Di/jquery-css-transform/jquery-css-transform.js"></script>
<script type="text/javascript" src="rotate3Di/rotate3Di.js"></script>

<body background='img/otras/background.jpg'>


<table width="100%" height="100%">
<tr>
  <td align="center" valign="center">
</td>
  <td align="center" valign="center"> <img src="estilo/concentrese.png" alt="concentrese" class="imgcenter">
</td>
  <td align="center" valign="center">
</td>
</tr>
 
<tr>
<td align="center"><img src="estilo/jugador1.png" alt="jugador1" class="imgcenter">
<?php
error_reporting(0);
require_once('juego.php');
session_start();
if (!isset($_SESSION["juego"])) /* en esta parte se inicia sesión y comienza un nuevo juego */
{
  $_SESSION["juego"] = new concentrece();
  $_SESSION["juego"]->revolver(); /* se llama al metodo revolver que esta en la clase juego, revuelve las imagenes pero no las muestra */
  
  $_SESSION["JA"] = 0;
  $_SESSION["JB"] = 0;
  $_SESSION["apagado"] = 1;
  $_SESSION["turno"] = 0;
}

echo "<table><tr><td><font face= arial> PUNTAJE</td><td>" .  $_SESSION["JA"] . "</font></td></tr></table>";

?>
</td>

<td >

<?php
   if ($_POST["iniciar"])
    {
    if  ($_SESSION["apagado"] == 1) /*estan las cartas volteadas */
      {
  ?> 
  <script> var n = 1;</script>
  
  <?php
      }
       

     if ($_SESSION["apagado"] == 1 )
      {
      
        $_SESSION["apagado"] = 0; /* se pasa a cero y se voltean las cartas el tiempo estipulado 10 seg */
        $_SESSION["juego"]->visible_all(0); /* todo se vuelve visible */
      }
    else
      {
         $_SESSION["apagado"] = 1; /* cuando pasan los 10 seg se vuelve apagado 1 */
         $_SESSION["juego"]->visible_all(1); /* todo se vuelve a ocultar */
       }
  
      
    }
  $_SESSION["juego"]->pintado();
  
  
  
 





      
?>
</td>
<td align="center" ><img src="estilo/jugador2.png" alt="jugador2" class="imgcenter"> <?php
  echo "<table><tr><td><font face= arial> PUNTAJE</td><td>" .  $_SESSION["JB"] . "</font></td></tr></table>";
?></td>

</tr>

<tr>
  <td align="center" valign="center">
</td>
  <td align="center" valign="center">  
<?php
 echo '<form  name="controles" id="controles" action="index2.php" method="post">';

 
  
  
  echo '<center>';
  echo '<table><tr><td colspan=2><input type="image" src="estilo/iniciar.png" name="iniciar" value="INICIAR JUEGO"></td></table>';


  echo '<input type="hidden" name="casillaA" id="casillaA" required><input type="hidden" name="casillaB" id="casillaB" required></form>'; 
  ?>
</td>
  <td align="center" valign="center">
</td>
</tr>

</table>

 <script> 
 
     
     
     if (n == 1)
           {
     
        var t = 10;
        var myVar = setInterval(function(){myTimer()},1000); function myTimer() {
        t = t - 1;
        document.getElementById("demo").innerHTML = t;
     
         if (t == 0)
          {
       clearInterval(myVar);
       location.reload(true);
    }
  }
       
       }
     
     function jugar(num,element,ruta){ /* en jugar esta el tiempo en que una carta se voltea para encontrar la pareja */ 
      
      var x1=document.getElementById('casillaA').value;
      var x2=document.getElementById('casillaB').value;
      //alert("http://localhost/"+ruta);
      element.src = ruta;
      $(element).rotate3Di(180, 300);


      if (x1>0) {
        document.getElementById('casillaB').value=num;
        setTimeout(enviod, 1000);
      }
      else{
        document.getElementById('casillaA').value=num;
      }
     }
      function enviod(){

        document.controles.submit();
      }


 </script>
 </body>
 </html>