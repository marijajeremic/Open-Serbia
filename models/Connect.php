<?php

// klasa Connect sluzi za konekciju sa bazom,napravljen je singlton patern
class Connect{
    private static $_instance = null;
    //privatni konstruktor onemogucava direknto instanciranje klase Connect
    private function __construct(){}
    //metoda 'getInstance' najpre vrsi proveru da li postoji instancirana konekcija
    public static function getInstance(){
        if(is_null(self::$_instance)){
            //  ukoliko ne postoji pravi instancu
            self::$_instance = new PDO("mysql:host=127.0.0.1;dbname=openserbia", "root", "");
        }
        // na kraju vrca tu instancu
        return self::$_instance;
    }
}
