<?php


function conectar(){
    $server = "advance\SQLEXPRESS";
$database = "SGDA20";
$user = "sgda";
$password = "5gd4p1u5";
$conninfo = array("Database"=>$database,"UID"=>$user, "PWD"=>$password);

    $conn = sqlsrv_connect($server, $conninfo);
    
    if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
    }
    return $conn;
}

function consulta($sql){
    $conn = conectar();
   // $sql = "SELECT nome FROM alunos WHERE matricula = '1289'";
    $params = array();

    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $stmt = sqlsrv_query( $conn, $sql, $params, $options);
    
    if ($stmt === false) {
        return false;
        exit;
    }
    $row_count = sqlsrv_num_rows($stmt);
    
    $numFields = sqlsrv_num_fields( $stmt );

    while( sqlsrv_fetch( $stmt )) {
       // Iterate through the fields of each row.
       for($i = 0; $i < $numFields; $i++) { 
          $resultado[$i] = sqlsrv_get_field($stmt, $i);
       }
       return $resultado;
    }
}

function consultaDadosCurso(){
    $conn = conectar();
    
}

?>