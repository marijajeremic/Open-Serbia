<?php

//Abstraktna klasa Model koja ce biti parent svim ostalim klasama
// samo omogucava da svaka klasa koja je nasledi dobije tj.nasledi ‘$db’
// bez ponavljanja koda (Connect::getInstance)u svakoj toj klasi ponaosob.
abstract class Model
{
    protected $db;
    //konstruktor ima ulogu da pozove metodu 'getInstance'
    public function __construct()
    {   //ovde pristupamo public metodi klase Connect i trazimo tu instancu
        $this->db = Connect::getInstance();
    }
}