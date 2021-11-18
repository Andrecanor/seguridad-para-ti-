<?php
    // Arrays para guardar mensajes y errores:
    $aErrores = array();
    $aMensajes = array();

    // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

    // Comprobar si se ha enviado el formulario:
  if( !empty($_POST['btn_enviar']) ){
      echo "FORMULARIO RECIBIDO:<br/>";
      // Comprobar si llegaron los campos requeridos:
      if(isset($_POST['Nom']) && isset($_POST['H_trabajadas']) && isset($_POST['Sal_hora']) && isset($_POST['Sal_extras'])){

        if (empty($_POST['Nom'])){
            echo "<script>alert('NOMBRE VACIO');</script>";
            echo "<script>window.location='../HTML/ejercicio01.html';</script>";
        }
        if (empty($_POST['H_trabajadas'])){
            echo "<script>alert('HORAS T VACIO');</script>";
            echo "<script>window.location='../HTML/ejercicio01.html';</script>";
        }
        if (empty($_POST['Sal_hora'])){
            echo "<script>alert('SAL HORA VACIO');</script>";
            echo "<script>window.location='../HTML/ejercicio01.html';</script>";
        }
        if (empty($_POST['Sal_extras'])){
            echo "<script>alert('SAL EXTRA VACIO');</script>";
            echo "<script>window.location='../HTML/ejercicio01.html';</script>";
        }
        
            
                        // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                if( preg_match($patron_texto, $_POST['Nom']) )
                    $aMensajes[] = "Nombre: [".$_POST['Nom']."]";
                else
                    $aErrores[] = "El nombre sólo puede contener letras y espacios";
    
                      
              if( (isset($_POST['H_trabajadas']) ) && (!empty($_POST['H_trabajadas'])) ){
                        if( is_numeric($_POST['H_trabajadas']) && $_POST['H_trabajadas']>0 )
                            $aMensajes[] ="Horas Trabajadas: [".$_POST['H_trabajadas']."]";
                        else
                            $aErrores[] = "El campo Horas debe contener un número.";
                    }
              
              if( (isset($_POST['Sal_hora']) ) && (!empty($_POST['Sal_hora'])) )
                    {
                        if( is_numeric($_POST['Sal_hora']) && $_POST['Sal_hora']>0)
                            $aMensajes[] ="Salario por Hora: [".$_POST['Sal_hora']."]";
                        else
                            $aErrores[] = "El campo salario por Hora debe contener un número.";
                    }
                    if( (isset($_POST['Sal_extras']) ) && (!empty($_POST['Sal_extras'])) )
                    {
                        if( is_numeric($_POST['Sal_extras']) && $_POST['Sal_extras']>0 )
                            $aMensajes[] ="Salario por hora extra: [".$_POST['Sal_extras']."]";
                        else
                            $aErrores[] = "El campo salario extra debe contener un número.";
                    }

                            
                      if( count($aErrores) > 0 )
                      {
                          echo "<p>ERRORES ENCONTRADOS:</p>";
                          // Mostrar los errores:
                          for( $contador=0; $contador < count($aErrores); $contador++ )
                              echo $aErrores[$contador]."<br/>";
                      }
                      else
                      {
                        $Nom_empleado=$_POST["Nom"];
                        $H_trabajadas=$_POST["H_trabajadas"];
                        $ValorHora=$_POST["Sal_hora"];
                        $Sal_extras=$_POST["Sal_extras"];
                          // Mostrar los mensajes:
                          if ($H_trabajadas>40){
                            //FORMULAS
                              $Cant_extras= $H_trabajadas-40;
                              $Total_extras= $Cant_extras*$Sal_extras;
                              $Total_salnormal= $ValorHora*$H_trabajadas;
                              $SumaTOTAL=$Total_extras+$Total_salnormal;
                              
                              $Porcentaje=($SumaTOTAL*25)/100;
                              $PrecioPagar=$SumaTOTAL-$Porcentaje;
                              //IMPRIMIR
                                echo "<br><br>Bienvenido $Nom_empleado , usted trabajo $H_trabajadas y horas de las cuales $Cant_extras corresponden a horas extras. <br><br>";
                                echo "El valor acumulado por $Cant_extras horas extras es de $Total_extras <br><br>";
                                echo "El valor por cada hora trabajada (sin ser extra) es de $ValorHora <br><br>";
                                echo "Su Sub-Salario es de $PrecioPagar. Teniendo en cuenta que se debe descontar: <br><br> ";
                                echo "por  concepto  de pensión (10%) y salud (15%) que corresponde a $Porcentaje <br><br>";
                                echo "su salario sin descuento es $SumaTOTAL";
                            
                              //CONDICION HORAS MENOR O IGUAL A 40
                          }elseif ($H_trabajadas<=40) {
                            //FORMULAS
                              $Total_salnormal= $ValorHora*$H_trabajadas;
                
                              $Porcentaje=($Total_salnormal*25)/100;
                              $PrecioPagar=$Total_salnormal-$Porcentaje;
                              //IMPRIMIR
                              echo "<br><br>Bienvenido $Nom_empleado , usted trabajo $H_trabajadas<br><br>";
                              echo "El valor por cada hora trabajada es de $ValorHora <br><br>";
                              echo "Su Sub-Salario es de $PrecioPagar. Teniendo en cuenta que se debe descontar: <br><br> ";
                              echo "por  concepto  de pensión (10%) y salud (15%) que corresponde a $Porcentaje <br><br>";
                              echo "su salario sin descuento es $Total_salnormal";
                          }
                      }
    
    }

  }
  
?>