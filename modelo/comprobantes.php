<?php

class comprobantes extends Main{

    public $idcomprobante;
    public $serie;
    public $correlativo;
    public $idtipo_comprobante;
    public $tipo;

    public function selecciona() {
        if(is_null($this->idcomprobante)){
            $this->idcomprobante=0;
        }
        if(is_null($this->tipo)){
            $this->tipo='';
        }
        $datos = array($this->idcomprobante, $this->tipo);
        $r = $this->get_consulta("pa_selecciona_comprobantes", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        if (conexion::$_servidor == 'oci') {
            oci_fetch_all($stmt, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            return $data;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);       
            return $stmt->fetchall();
        }
    }

    public function elimina() {
        $datos = array($this->idcomprobante);
        $r = $this->get_consulta("pa_elimina_comprobantes", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function inserta() {
        $datos = array(0, $this->serie, $this->correlativo, $this->idtipo_comprobante);
        $r = $this->get_consulta("pa_inserta_act_comprobantes", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->idcomprobante, $this->serie, $this->correlativo, $this->idtipo_comprobante);
        $r = $this->get_consulta("pa_inserta_act_comprobantes", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>