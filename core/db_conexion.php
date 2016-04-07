<?php

class DBConexion{

private $db_host = 'localhost';
private $db_user = 'postgres';
private $db_pass = 'admin';
private $db_name = 'dbinvestigacion';
private $conectado = false;
public $conexion;
public $consulta;
public $mensaje;
public $mensaje2;
public $tipomsj;
public $filas = array();
public $filas2 = array();


# Conectar a pg
public function abrir_conexion() {
  $this->conexion = pg_connect("host='$this->db_host' dbname='$this->db_name' user='$this->db_user' password='$this->db_pass'");
  if(!$this->conexion){
    echo "No se ha podido conectar a PostgresSQL.";
  }else{
    $this->conectado = true;
  }

}

# Desconectar la base de datos
public function cerrar_conexion() {
  if($this->conectado == true){
    pg_close($this->conexion);
  }
}


public function ejecutar_simple_query($tipo, $modulo) {
  
  $this->abrir_conexion();
  if(pg_query($this->conexion, $this->consulta)){
    if($tipo == 'insert'){
      $this->mensaje = "Se Creó ".$modulo." Satisfactoriamente!";
      $this->tipomsj = "success";
    }else if($tipo == 'update'){
      $this->mensaje = "Se Modificó  ".$modulo." Satisfactoriamente!";
      $this->tipomsj = "info";
    }else if($tipo == 'delete'){
      $this->mensaje = "Se Eliminó ".$modulo." Satisfactoriamente!";
      $this->tipomsj = "danger";
    }
    return true;
  }else{
      $this->mensaje = "Error en la Base de Datos!";
      $this->tipomsj = "danger";
      return false;
  }
  $this->cerrar_conexion();
}

# Traer resultados de una consulta en una variable $this->cedula
public function traer_resultados_query_simple() {
$this->abrir_conexion();
$result = pg_query($this->conexion, $this->consulta);
$num = pg_num_rows($result);
if($num > 0){
  
  return true;
}else{
 
  return false;
}
$this->cerrar_conexion();
}

# Traer resultados de una consulta en un Array(campo => valor)
public function traer_resultados_query() {
$this->abrir_conexion();
$result = pg_query($this->consulta);
while($row = pg_fetch_assoc($result)) {
  foreach ($row as $campo => $valor) {
    $this->filas[$campo] = $valor;
  }
}
$this->cerrar_conexion();
}

# Traer resultados de una consulta en un Array[0](campo => valor)
public function traer_resultados_query_general() {
$this->abrir_conexion();
$result = pg_query($this->consulta);
while ($row = pg_fetch_assoc($result)) {
  $this->filas[] = $row;
}
$this->cerrar_conexion();
}

public function ultimoId(){
  $this->abrir_conexion();
  $result = pg_last_oid();
  return $result;
  $this->cerrar_conexion();
}

}
?>

















