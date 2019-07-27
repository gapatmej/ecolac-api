<?php namespace config;

use \PDO;
/**
 * Description of Conexion
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   28/05/2019
 * 
 */
class Conexion {
    
    public static function conectar(){
        try{
           /* mysqli_report(MYSQLI_REPORT_STRICT);
            
            if(DRIVER =="mysql" || DRIVER ==null){
                $con = new \mysqli(HOST, USER, PASS, DATABASE);
                $con->query("SET NAMES '".CHARSET."'");
            }*/
            $con = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $con;
            
        } catch (Exception $e) {
            die("Error". $e->getMessage());
            echo 'Excepción conn BDD line : ',  $e->getLine(), "\n";
            return null;
        }
    }
    
}
