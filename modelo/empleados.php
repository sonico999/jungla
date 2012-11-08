<?php

class empleados {

    public $idempleado;
    public $nombres;
    public $apellidos;
    public $dni;
    public $telefono;
    public $direccion;
    public $fecha_nacimiento;
    public $fecha_contratacion;
    public $idubigeo;
    public $idperfil;
    public $idprofesion;
    public $usuario;
    public $clave;
    public $estado;
    public $idactividad;
    public $idtipo_empleado;
    public $perfil;
    public $ubigeo;
    

    public function inserta() {
        $datos = array($this->idempleado, $this->nombres, $this->apellidos, $this->dni, 
            $this->telefono, $this->direccion, $this->fecha_nacimiento, $this->fecha_contratacion,  
            $this->idubigeo, $this->idperfil, $this->idprofesion, $this->usuario, $this->clave, $this->estado,
            $this->idactividad, $this->idtipo_empleado);
//            echo '<pre>';
//            print_r($datos);
//            echo '</pre>';
//            exit;
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_empleados", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->idempleado, $this->nombres, $this->apellidos, $this->dni, 
            $this->telefono, $this->direccion, $this->fecha_nacimiento, $this->fecha_contratacion,  
            $this->idubigeo, $this->idperfil, $this->idprofesion, $this->usuario, $this->clave, $this->estado,
            $this->idactividad, $this->idtipo_empleado);
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_empleados", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function selecciona() {
        if(is_null($this->nombres)){
            $this->nombres='';
        }
        if(is_null($this->apellidos)){
            $this->apellidos='';
        }
        if(is_null($this->perfil)){
            $this->perfil='';
        }
        if(is_null($this->ubigeo)){
            $this->ubigeo='';
        }
        $datos = array($this->idempleado, $this->nombres, $this->apellidos, $this->perfil, $this->ubigeo);
        $r = consulta::procedimientoAlmacenado("pa_selecciona_empleados", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchall();
    }

    public function elimina() {
        $datos = array($this->idempleado);
        $r = consulta::procedimientoAlmacenado("pa_elimina_empleados", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    
    public function seleccionar($usuario,$clave) {
        $datos = array($usuario,$clave);
        $r = consulta::procedimientoAlmacenado("pa_valida_login", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }
    
    public function seleccion($usuario,$clave){
         $datos = array($usuario,$clave);
        $r = consulta::procedimientoAlmacenado("pa_login_android", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }
}

?>
