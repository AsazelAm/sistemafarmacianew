<?php
//conexion pdo
//Creamos una clase
//Es programacion Orientada a objetos
class Conexion{ //Creamos una clase
    private $servidor="localhost"; //las variables es de tipo private
    private $db="farmaciasistema"; //llamamos a la base de datos
    private $puerto =3307; //el puerto de mi xam para el MYsql
    private $charset="utf8";//el tipo de dato q va ser español
    private $usuario="root";//usriario por defecto del xamp
    private $contrasena="";//no asiganamos ninguna contrase al instalar el xamp
    public $pdo=null;//es la variable q va a retornar al momento de ser iniciada con valor null
    private $atributos=[PDO::ATTR_CASE=>PDO::CASE_LOWER,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
    /*Los atributos del PDO
    PDO::ATTR_CASE:fuerza a los nombres de columnas a una capitalizacion especifica
        =>PDO::CASE_LOWER:fuerza a los nombres de columnas a minusculas
    PDO::ATTR_ERRMODE:reporte de Errorres
        =>PDO::ERRMODE_EXCEPTION:lanza errores o excepciones mediantes el trycach
    PDO::ATTR_ORACLE_NULLS:conversion del NULL y cadenas vacias
        =>PDO::NULL_EMPTY_STRING:las cadenas vacias son convertidas a NULL osea si hay celdas vacias no retornan null
    PDO::ATTR_DEFAULT_FETCH_MODE:es el modo de busqueda q nos va retornar
        =>PDO::FETCH_OBJ:cada ves q nosotros realisemos una consulta nos lo retornara en Objetos*/
    
    //nuestro metodo constructor
    function __construct(){//haci creamos nuestro metodo constructor
    /*Nos retornara el pdo y vamos a crear el nuevo PDO les asignamos al PDO a nuestras varibles y por ultimo pasamos a los atributos */
        $this->pdo=new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}",$this->usuario,$this->contrasena,$this->atributos);
    }
}
?>