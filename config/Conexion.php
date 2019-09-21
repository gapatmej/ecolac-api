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
            if(DIALECT == 'POSTGRES'){
                return self::conectarPostgres();
            }else if(DIALECT == 'MYSQL'){
                return self::conectarMysql();
            }
            else{
                throw new Exception("No Dialec support");
            }
            
        } catch (Exception $e) {
            die("Error". $e->getMessage());
            echo 'Excepción conn BDD line : ',  $e->getLine(), "\n";
            return null;
        }
    }
    
    private static function conectarMysql(){
        $con = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER_MYSQL, PASS_MYSQL);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $con;
    }
    
    private static function conectarPostgres(){
        $con = new PDO("pgsql:host=".HOST.";dbname=".DATABASE, USER_POSTGRES, PASS_POSTGRES);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $con;
    }
    
}
