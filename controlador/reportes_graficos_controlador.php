<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reportes_graf
 *
 * @author eveR
 */
class reportes_graficos_controlador extends controller {

    //put your code here
    public function __construct() {
        $this->get_Libreria('Highchart');
        parent::__construct();
        $this->_modulos = $this->cargar_modelo('modulos');
    }

    public function index() {
        $this->_vista->renderizar('index');
    }

    public function r_ventas() {
        $this->_vista->renderizar('r_ventas');
    }

    public function r_estadias() {
        $this->_vista->renderizar('r_estadias');
    }

    public function r_pasajeros() {
        $this->_vista->renderizar('r_pasajeros');
    }

}

?>
