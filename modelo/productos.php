<?php

class productos extends Main{

    public $idproducto;
    public $descripcion;
    public $precio_unitario;
    public $observaciones;
    public $idservicio;
    public $idtipo_producto;
    public $idunidad_medida;
    public $idubicacion;
    public $stock;
    public $estado;
    public $precio_compra;
    public $tipo_producto;
    public $unidad_medida;
    public $ubicacion;
    public $aumenta;

    public function inserta() {
        $datos = array(0, $this->descripcion, $this->precio_unitario, $this->observaciones, 
            $this->idservicio, $this->idtipo_producto, $this->idunidad_medida, $this->idubicacion,  
            $this->stock, $this->estado, $this->precio_compra, 0);
        $r = $this->get_consulta("pa_inserta_actualiza_productos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        if(is_null($this->stock)){
            $datos = array($this->idproducto, $this->descripcion, $this->precio_unitario, $this->observaciones, 
            $this->idservicio, $this->idtipo_producto, $this->idunidad_medida, $this->idubicacion,  
            $this->stock, $this->estado, $this->precio_compra, 0);
            $r = $this->get_consulta("pa_inserta_actualiza_productos", $datos);
        }else{
            if(is_null($this->aumenta)){
                $this->aumenta = 0;
            }
            $datos = array ($this->idproducto, $this->stock, $this->aumenta);
            $r = $this->get_consulta("pa_actualizar_stock_producto", $datos);
        }
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function selecciona() {
        if(is_null($this->idproducto)){
            $this->idproducto=0;
        }
        if(is_null($this->descripcion)){
            $this->descripcion='';
        }
        if(is_null($this->tipo_producto)){
            $this->tipo_producto='';
        }
        if(is_null($this->unidad_medida)){
            $this->unidad_medida='';
        }
        if(is_null($this->ubicacion)){
            $this->ubicacion='';
        }
        $datos = array($this->idproducto, $this->descripcion, $this->tipo_producto, $this->unidad_medida, $this->ubicacion);
        $r = $this->get_consulta("pa_selecciona_productos", $datos);
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
        };
    }

    public function elimina() {
        $datos = array($this->idproducto);
        $r = $this->get_consulta("pa_elimina_productos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
