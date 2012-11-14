<?php

class modulos {

    public $idmodulo;
    public $descripcion;
    public $url;
    public $estado;
    public $idmodulo_padre;
    public $modulo_padre;
    
    public function selecciona() {
        if(is_null($this->idmodulo)){
            $this->idmodulo=0;
        }
        if(is_null($this->descripcion)){
            $this->descripcion='';
        }
        if(is_null($this->modulo_padre)){
            $this->modulo_padre='';
        }
        $datos = array($this->idmodulo, $this->descripcion, $this->modulo_padre);
        $r = consulta::procedimientoAlmacenado("pa_selecciona_modulos", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchall();
    }
    
    public function inserta() {
        $datos = array(0, $this->descripcion, $this->url, $this->estado, 
            $this->idmodulo_padre);
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_modulos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->idmodulo, $this->descripcion, $this->url, $this->estado, 
            $this->idmodulo_padre);
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_modulos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function seleccionar($idmodulo_padre){
        $datos = array($idmodulo_padre);
        $r = consulta::procedimientoAlmacenado("pa_selecciona_modulos_padre", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        return $stmt->fetchall();
    }

    public function elimina() {
        $datos = array($this->idmodulo);
        $r = consulta::procedimientoAlmacenado("pa_elimina_modulos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
