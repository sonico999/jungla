<?php

class regiones extends Main{

    public $idubigeo;
    public $codigo_region;
    public $codigo_provincia;
    public $codigo_distrito;
    public $idpais;

    public function selecciona() {
        if(is_null($this->codigo_region)){
            $this->codigo_region=0;
        }
        $datos = array($this->codigo_region, $this->idpais);
        $r = $this->get_consulta("pa_selecciona_regiones", $datos);
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
        };
    }

}

?>
