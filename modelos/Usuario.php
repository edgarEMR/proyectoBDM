<?php

while(!file_exists('php'))
    chdir(('..'));

include_once('php/conection.php');

class Usuario extends DB
{
    private $nombreUsuario;
    private $contraseña;
    private $nombre;
    private $apellidos;
    private $fechaNacimiento;
    private $email;
    private $sexo;
    private $imagen;
    private $esPublico;
    private $idRol;

    function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    function setNombreUsuario($nombreUsuario): self
    {
        $this->nombreUsuario = $nombreUsuario;
        return $this;
    }

    function getContraseña()
    {
        return $this->contraseña;
    }

    function setContraseña($contraseña): self
    {
        $this->contraseña = $contraseña;
        return $this;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setNombre($nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    function getApellidos()
    {
        return $this->apellidos;
    }

    function setApellidos($apellidos): self
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    function setFechaNacimiento($fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;
        return $this;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    function getSexo()
    {
        return $this->sexo;
    }

    function setSexo($sexo): self
    {
        $this->sexo = $sexo;
        return $this;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function getImagenUri()
    {
        return data_uri($this->imagen, 'image/png');
    }

    function setImagen($imagen): self
    {
        $this->imagen = $imagen;
        return $this;
    }
    
    public function getEsPublico()
    {
        return $this->esPublico;
    }

    public function setEsPublico($esPublico)
    {
        $this->esPublico = $esPublico;

        return $this;
    }

    function getIdRol()
    {
        return $this->idRol;
    }

    function setIdRol($idRol): self
    {
        $this->idRol = $idRol;
        return $this;
    }
}

function data_uri($file, $mime)
{
    return ('data:' . $mime . ';base64,' . $file);
}