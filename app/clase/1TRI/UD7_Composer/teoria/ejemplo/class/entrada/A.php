<?php

class A
{
    public function __toString()
    {
        return "Estoy en la clase " . __CLASS__;
    }
}