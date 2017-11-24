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
if (!isset($_SESSION["juego"]))
{
  $_SESSION["juego"] = new concentrece();
  $_SESSION["juego"]->revolver();
  
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
    if  ($_SESSION["apagado"] == 1)
      {
?>
<script> var n = 1;</script>

<?php
      }
       

     if ($_SESSION["apagado"] == 1 )
      {
      
        $_SESSION["apagado"] = 0;
        $_SESSION["juego"]->visible_all(0);
      }
    else
      {
         $_SESSION["apagado"] = 1;
         $_SESSION["juego"]->visible_all(1);
       }
  
      
    }
    else{
    $A = $_POST["casillaA"];
    $B = $_POST["casillaB"];    
    $r = $_SESSION["juego"]->movimiento($A,$B);
          $_SESSION["apagado"] = 1;
    if ($r == 0)
      {
       if ($_SESSION["turno"] == 0)
        $_SESSION["JA"] = $_SESSION["JA"] + 1;
       else
         $_SESSION["JB"] = $_SESSION["JB"] + 1;
      }
     else
       {
           if ($_SESSION["turno"] == 0)
       $_SESSION["turno"] = 1;
      else
        $_SESSION["turno"] = 0; 
       
       }
    
    
  }
  $_SESSION["juego"]->pintado();
  
  
  
 

 echo "<p id=demo></p>";
?>
</td>

<td align="center" ><img src="estilo/jugador2.png" alt="jugador2" class="imgcenter">
<?php
  echo "<table><tr><td><font face= arial> PUNTAJE</td><td>" .  $_SESSION["JB"] . "</font></td></tr></table>";
?>
</td>
</tr>

<tr>
<td align="center" valign="center"></td>
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
     
     function jugar(num,element,ruta){
      
      var x1=document.getElementById('casillaA').value;
      var x2=document.getElementById('casillaB').value;
      //alert("http://localhost/"+ruta);
      element.src = ruta;
      $(element).rotate3Di(180, 300);


      if (x1>0) {
        document.getElementById('casillaB').value=num;
        setTimeout(enviod, 2000);
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