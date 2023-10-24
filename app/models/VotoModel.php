<?php
namespace app\models;

class VotoModel
{

    private $id;
    private $nombresApellidos;
    private $alias;
    private $rut;
    private $email;
    private $region;
    private $comuna;
    private $candidato;
    private $referencias;

    public function construct($nombresApellidos, $alias, $rut, $email, $region, $comuna, $candidato, $referencias)
    {
        $this->nombresApellidos = $nombresApellidos;
        $this->alias = $alias;
        $this->rut = $rut;
        $this->email = $email;
        $this->region = $region;
        $this->comuna = $comuna;
        $this->candidato = $candidato;
        $this->referencias = $referencias;
    }

     
    public function getId()
    {
        return $this->id;
    }

  
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    
    public function getNombresApellidos()
    {
        return $this->nombresApellidos;
    }

    
    public function setNombresApellidos($nombresApellidos): self
    {
        $this->nombresApellidos = $nombresApellidos;

        return $this;
    }

    public function getAlias()
    {
        return $this->alias;
    }

   
    public function setAlias($alias): self
    {
        $this->alias = $alias;

        return $this;
    }

   
    public function getRut()
    {
        return $this->rut;
    }

  
    public function setRut($rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    
    public function getEmail()
    {
        return $this->email;
    }

   
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    
    public function getRegion()
    {
        return $this->region;
    }


    public function setRegion($region): self
    {
        $this->region = $region;

        return $this;
    }

 
    public function getComuna()
    {
        return $this->comuna;
    }

    public function setComuna($comuna): self
    {
        $this->comuna = $comuna;

        return $this;
    }

    public function getCandidato()
    {
        return $this->candidato;
    }

    public function setCandidato($candidato): self
    {
        $this->candidato = $candidato;

        return $this;
    }

   
    public function getReferencias()
    {
        return $this->referencias;
    }

   
    public function setReferencias($referencias): self
    {
        $this->referencias = $referencias;

        return $this;
    }
}