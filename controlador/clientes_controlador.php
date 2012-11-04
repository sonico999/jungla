<?php

class clientes_controlador extends controller {
    
    private $_clientes;
    private $_paises;
    private $_regiones;
    private $_provincias;
    private $_ubigeos;
    private $_membresias;
    private $_profesiones;
    
    public function __construct() {
        parent::__construct();
        $this->_clientes = $this->cargar_modelo('clientes');
        $this->_paises = $this->cargar_modelo('paises');
        $this->_regiones = $this->cargar_modelo('regiones');
        $this->_provincias = $this->cargar_modelo('provincias');
        $this->_ubigeos = $this->cargar_modelo('ubigeos');
        $this->_membresias= $this->cargar_modelo('membresia');
        $this->_profesiones = $this->cargar_modelo('profesiones');
    }
    
    public function index() {
        $this->_clientes->idcliente=0;
        $this->_vista->datos=$this->_clientes->selecciona();
        $this->_vista->renderizar('index');
    }
    
    public function nuevo(){
        if ($_POST['guardar'] == 1) {
//            echo '<pre>';
//            print_r($_POST);
//            echo '</pre>';
//            exit;
            $this->_clientes->idcliente = 0;
            $this->_clientes->nombres = $_POST['nombres'];
            if(isset ($_POST['apellidos'])){
                $this->_clientes->apellidos = $_POST['apellidos'];
            }else{
                $this->_clientes->apellidos = null;
            }
            $this->_clientes->documento = $_POST['documento'];
            if(isset ($_POST['fecha_nacimiento']) && $_POST['fecha_nacimiento']!=""){
                $this->_clientes->fecha_nacimiento = $this->fecha_en($_POST['fecha_nacimiento']);
            }else{
                $this->_clientes->fecha_nacimiento = null;
            }
            if(isset ($_POST['sexo'])){
                $this->_clientes->sexo = $_POST['sexo'];
            }else{
                $this->_clientes->sexo = null;
            }
            $this->_clientes->telefono=$_POST['telefono'] ;
            $this->_clientes->email= $_POST['email'];
            if(isset ($_POST['estado_civil'])){
                $this->_clientes->estado_civil = $_POST['estado_civil'];
            }else{
                $this->_clientes->estado_civil = null;
            }
            if(isset ($_POST['profesion'])){
                $this->_clientes->idprofesion = $_POST['profesion'];
            }else{
                $this->_clientes->idprofesion = 67;
            }
            if(isset ($_POST['ubigeo']) && $_POST['ubigeo']!=""){
                $this->_clientes->idubigeo = $_POST['ubigeo'];
            }else{
                $this->_clientes->idubigeo = 0;
            }
            if(isset ($_POST['membresia'])){
                $this->_clientes->idmembresia = $_POST['membresia'];
            }else{
                $this->_clientes->idmembresia = 0;
            }
            $this->_clientes->direccion = $_POST['direccion'];
            $this->_clientes->tipo = $_POST['tipo_cliente'];
            $this->_clientes->inserta();
            $this->redireccionar('clientes');
        }
        $this->_paises->idpais = 0;
        $this->_vista->datos_paises = $this->_paises->selecciona();
        $this->_membresias->idmembresia= 0;
        $this->_vista->datos_membresias= $this->_membresias->selecciona();
        $this->_profesiones->idprofesion = 0;
        $this->_vista->datos_profesiones = $this->_profesiones->selecciona();
        $this->_vista->titulo = 'Registrar Cliente';
        $this->_vista->action = BASE_URL . 'clientes/nuevo';
        $this->_vista->renderizar('form');
    }
    
    public function get_regiones() {
        $this->_regiones->codigo_region = 0;
        $this->_regiones->idpais = $_POST['idpais'];
        echo json_encode($this->_regiones->selecciona());
    }

    public function get_provincias() {
        $this->_provincias->codigo_provincia = 0;
        $this->_provincias->codigo_region = $_POST['idregion'];
        echo json_encode($this->_provincias->selecciona());
    }

    public function get_ciudades() {
        $this->_ubigeos->idubigeo = 0;
        $this->_ubigeos->codigo_provincia = $_POST['idprovincia'];
        echo json_encode($this->_ubigeos->selecciona());
    }
    
    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('empleados');
        }
//            echo '<pre>';
//            print_r($_POST);
//            echo '</pre>';
//            exit;
        if ($_POST['guardar'] == 1) {
            $this->_clientes->idcliente= $_POST['codigo'];
            $this->_clientes->nombres = $_POST['nombres'];
            if(isset ($_POST['apellidos'])){
                $this->_clientes->apellidos = $_POST['apellidos'];
            }else{
                $this->_clientes->apellidos = null;
            }
            $this->_clientes->documento = $_POST['documento'];
            if(isset ($_POST['fecha_nacimiento']) && $_POST['fecha_nacimiento']!=""){
                $this->_clientes->fecha_nacimiento = $this->fecha_en($_POST['fecha_nacimiento']);
            }else{
                $this->_clientes->fecha_nacimiento = null;
            }
            if(isset ($_POST['sexo'])){
                $this->_clientes->sexo = $_POST['sexo'];
            }else{
                $this->_clientes->sexo = null;
            }
            $this->_clientes->telefono=$_POST['telefono'] ;
            $this->_clientes->email= $_POST['email'];
            if(isset ($_POST['estado_civil'])){
                $this->_clientes->estado_civil = $_POST['estado_civil'];
            }else{
                $this->_clientes->estado_civil = null;
            }
            if(isset ($_POST['profesion'])){
                $this->_clientes->idprofesion = $_POST['profesion'];
            }else{
                $this->_clientes->idprofesion = 67;
            }
            if(isset ($_POST['ubigeo']) && $_POST['ubigeo']!=""){
                $this->_clientes->idubigeo = $_POST['ubigeo'];
            }else{
                $this->_clientes->idubigeo = 0;
            }
            if(isset ($_POST['membresia'])){
                $this->_clientes->idmembresia = $_POST['membresia'];
            }else{
                $this->_clientes->idmembresia = 0;
            }
            $this->_clientes->direccion = $_POST['direccion'];
            $this->_clientes->tipo = $_POST['tipo_cliente'];
            $this->_clientes->actualiza();
            $this->redireccionar('clientes');
        }

        $this->_clientes->idcliente = $this->filtrarInt($id);
        $datos = $this->_clientes->selecciona();
        //obtenemos todos los paises
        $this->_paises->idpais = 0;
        $this->_vista->datos_paises = $this->_paises->selecciona();
        //obtenemos todas las regiones que pertenecen al pais del empleado
        $this->_regiones->codigo_region = 0;
        $this->_regiones->idpais = $datos[0]['idpais'];
        $this->_vista->datos_regiones = $this->_regiones->selecciona();
        //obtenemos todas las provincias que pertenecen a la región del empleado
        $this->_provincias->codigo_provincia = 0;
        $this->_provincias->codigo_region = $datos[0]['idregion'];
        $this->_vista->datos_provincias = $this->_provincias->selecciona();
        //obtenemos todas las ciudades que pertenecen a la provincia del empleado
        $this->_ubigeos->idubigeo = 0;
        $this->_ubigeos->codigo_provincia = $datos[0]['idprovincia'];
        $this->_vista->datos_ubigeos = $this->_ubigeos->selecciona();

        $this->_vista->datos = $datos;
        $this->_membresias->idmembresia= 0;
        $this->_vista->datos_membresias= $this->_membresias->selecciona();
        $this->_profesiones->idprofesion = 0;
        $this->_vista->datos_profesiones = $this->_profesiones->selecciona();
        $this->_vista->titulo = 'Actualizar Cliente';
        $this->_vista->renderizar('form');
    }
        
}

?>
