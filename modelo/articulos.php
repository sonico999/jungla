<?php

class articulos extends Main{

    public $idarticulo;
    public $titulo;
    public $descripcion;
    public $imagen;

    public function selecciona() {
        if(is_null($this->idarticulo)){
            $this->idarticulo=0;
        }
        if(is_null($this->titulo)){
            $this->titulo="";
        }
        if(is_null($this->descripcion)){
            $this->descripcion="";
        }
        $datos = array($this->idarticulo,$this->titulo,$this->descripcion);
        $r = $this->get_consulta("pa_selecciona_articulos", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        if (BaseDatos::$_archivo == 'OCI') {
            oci_fetch_all($stmt, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            return $data;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);       
            return $stmt->fetchall();
        }
    }

    public function elimina() {
        $datos = array($this->idarticulo);
        $r = consulta::procedimientoAlmacenado("pa_elimina_articulos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function inserta() {
        $datos = array(0, $this->titulo, $this->descripcion, $this->imagen);
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_articulos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->idarticulo, $this->titulo, $this->descripcion, $this->imagen);
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_articulos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>