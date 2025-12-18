<?php

namespace Controladores;

class Alumno
{
    public function __construct(public $name, public $email){}
    public function __toString()
    {
        return "$this->name, $this->email";
    }
}