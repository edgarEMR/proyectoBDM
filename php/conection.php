<?php
    class DB
    {
        private $host = 'localhost';
        private $db = 'proyectobdm';
        private $user = 'root';
        private $password = ''; //[dC5+vri(YmUO+z9
        private $charset = 'utf8mb4';

        function connect()
        {
            try {
                $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
                $options = [
                    PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES  => false
                ];

                $pdo = new PDO($connection, $this->user, $this->password);

                return $pdo;
            } catch (PDOException $e) {
                print_r('Error connection: ' . $e->getMessage());
            }
        }

        function login($nombreUsuario, $contraseña)
        {
            return $this->connect()->query("CALL login('$nombreUsuario', '$contraseña')");
        }

        function gestionUsuario($nombreUsuario, $contraseña, $nombre, $apellidos, $fechaNacimiento, 
                                $email, $sexo, $imagen, $esPublico, $rol, $opcion)
        {
            if($opcion == 'S' || $opcion == 'A'){
                return $this->connect()->query("CALL spGestionUsuario('$nombreUsuario', '$email', '$contraseña', '$nombre', '$apellidos', 
                                                                    '$fechaNacimiento', '$sexo', '$imagen', $esPublico, $rol, '$opcion')");
            } else {
                return $this->connect()->exec("CALL spGestionUsuario('$nombreUsuario', '$email', '$contraseña', '$nombre', '$apellidos', 
                                                                    '$fechaNacimiento', '$sexo', '$imagen', $esPublico, $rol, '$opcion')");
            }
            
        }
/*
        function gestionSeccion($idSeccion, $nombreSeccion, $color, $orden, $opcion)
        {
            return $this->connect()->query("CALL gestionSeccion($idSeccion,'$nombreSeccion','$color',$orden,'$opcion')");
        }

        function gestionNoticia($idNoticia, $titulo, $descripcion, $contenidoNoticia, $lugar, $fechaHora, $esUrgente, $idEstatus, $nombreUsuario, $opcion)
        {
            return $this->connect()->query("CALL gestionNoticia($idNoticia, '$titulo', '$descripcion', '$contenidoNoticia', 
                                            '$lugar', '$fechaHora', $esUrgente, '$idEstatus', '$nombreUsuario','$opcion')");
        }

        function obtenNoticia($idNoticia, $opcion)
        {
            return $this->connect()->query("CALL obtenNoticia($idNoticia,'$opcion')");
        }

        function obtenImagen($idNoticia, $opcion)
        {
            return $this->connect()->query("CALL obtenImagen($idNoticia,'$opcion')");
        }

        function obtenVideo($idNoticia, $opcion)
        {
            return $this->connect()->query("CALL obtenVideo($idNoticia,'$opcion')");
        }

        function gestionSeccion_Noticia($idSeccion_Noticia, $idSeccion, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionSeccion_Noticia($idSeccion_Noticia, $idSeccion, $idNoticia, '$opcion')");
        }

        function gestionImagen($idImagen, $imagenNot, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionImagen($idImagen, $imagenNot, $idNoticia, '$opcion')");
        }

        function gestionVideo($idVideo, $videoPath, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionVideo($idVideo, '$videoPath', $idNoticia, '$opcion')");
        }

        function gestionPalabra_clave($idPalabra, $palabra, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionPalabra_clave($idPalabra, '$palabra', $idNoticia, '$opcion')");
        }
*/    
    }
