<?php
session_start();

include_once('../php/conection.php');
include_once('../modelos/Usuario.php');

if (isset($_POST['accion'])) {

    if ($_POST['accion'] == 'login') {
        $usuario = new Usuario();
        $coneccion = new DB();

        $usuario->setNombreUsuario($_POST['nombreUsuario']);
        $usuario->setContraseña($_POST['contraseña']);
        $imagenGuardada = "";
        
        try {

            $procedure = $coneccion->login(
                $_POST['nombreUsuario'],
                $_POST['contraseña']
            );

            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            if($resultado) {
                //echo 'Usuario ' . $resultado['nombreUsuario'] . ' encontrado<br>';
                //echo '<img src="data:image/png;base64,'. base64_encode($resultado['imagen']). '" class="userImage" alt="..." id="imgUser">';
                $_SESSION['nombreUsuario'] = $resultado['nombreUsuario'];
                $_SESSION['imagen'] = $resultado['imagen'];
                header("Location: ../perfil.php?nombreUsuario=" . $resultado['nombreUsuario']);
            } else {
                echo 'Usuario no encontrado';
                throw new Exception("Usuario No Encontrado", 1);
                
            }
            

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . '<br> Code:' . $errorCode;
        } catch (Exception $err) {
            header("Location: ../index.php?error=" . $err->getCode());
        }
            
    }

    if ($_POST['accion'] == 'registrar') {
        $usuario = new Usuario();
        $coneccion = new DB();

        $usuario->setNombreUsuario($_POST['nombreUsu']);
        $usuario->setContraseña($_POST['contra']);
        $usuario->setNombre($_POST['nombre']);
        $usuario->setApellidos($_POST['apellido']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSexo($_POST['sexo']);
        $usuario->setFechaNacimiento($_POST['fecha']);
        $usuario->setIdRol($_POST['idRol']);
        $imagenGuardada = "";

        if ($_POST['imagenN'] == '') {
            $imagenGuardada = "NULL";
        } else {
            $imagenGuardada = "0x".bin2hex(file_get_contents($_FILES["imagen"]["tmp_name"]));
        }
        
        try {

            $procedure = $coneccion->gestionUsuario(
                $usuario->getNombreUsuario(),
                $usuario->getContraseña(),
                $usuario->getNombre(),
                $usuario->getApellidos(),
                $usuario->getFechaNacimiento(),
                $usuario->getEmail(),
                $usuario->getSexo(),
                $imagenGuardada,
                1,
                $usuario->getIdRol(),
                'I'
            );
                
            $_SESSION['nombreUsuario'] = $usuario->getNombreUsuario();
            $_SESSION['imagen'] = $imagenGuardada;

            if ($procedure) {
                header("Location: ../perfil.php?nombreUsuario=" . $usuario->getNombreUsuario());
            } else {
                throw new Exception("Usuario No Agregado", 2);
            }
            

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            header("Location: ../index.php?error=$errorCode");
        } catch (Exception $err) {
            $errorCode = $err->getCode();
            header("Location: ../index.php?error=$errorCode");
        }
            
    }

    /*if ($_POST['accion'] == 'editar') {
        $usuario = new Usuario();
        $coneccion = new DB();
        $nombreUsu = $_POST['nombreUsu'];

        $usuario->setNombreUsuario($_POST['nombreUsu']);
        $usuario->setContraseña($_POST['contra']);
        $usuario->setNombre($_POST['nombre']);
        $usuario->setApellidos($_POST['apellido']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSexo($_POST['sexo']);
        $usuario->setFechaNacimiento($_POST['fecha']);
        $usuario->setIdRol($_POST['idRol']);
        $imagenGuardada = "";

        if ($_POST['imagenN'] == '') {
            $imagenGuardada = "NULL";
        } else {
            $imagenGuardada = "0x".bin2hex(file_get_contents($_FILES["imagen"]["tmp_name"]));
        }
        
        try {

            $procedure = $coneccion->gestionUsuario(
                $usuario->getNombreUsuario(),
                $usuario->getContraseña(),
                $usuario->getNombre(),
                $usuario->getApellidos(),
                $usuario->getFechaNacimiento(),
                $usuario->getEmail(),
                $usuario->getSexo(),
                $imagenGuardada,
                $usuario->getIdRol(),
                'U'
            );

            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            header("Location: ../perfil.php?nombreUsuario=$nombreUsu");

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
        }
            
    }*/
}
?>