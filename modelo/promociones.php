<?php

class promociones {

    public $idpromocion;
    public $descripcion;
    public $descuento;
    public $fecha_inicio;
    public $fecha_final;

    public function selecciona() {
        $datos = array($this->idpromocion, $this->descripcion);
        $r = consulta::procedimientoAlmacenado("pa_selecciona_promociones", $datos);
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
        $datos = array($this->idpromocion);
        $r = consulta::procedimientoAlmacenado("pa_elimina_promociones", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function inserta() {
        $datos = array($this->idpromocion, $this->descripcion, $this->descuento, $this->fecha_inicio, $this->fecha_final);
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_promociones", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->idpromocion, $this->descripcion, $this->descuento, $this->fecha_inicio, $this->fecha_final);
        $r = consulta::procedimientoAlmacenado("pa_inserta_actualiza_promociones", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>