<?php

class Seguridad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        if (!$this->session->userdata('id_usuario')) {
            redirect('autentificacion');
        }
    }

    public function roles() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_table('admin_roles');
            $crud->set_subject('Roles');

            //los campos obligatorios
            $crud->required_fields('DESCRIPCION');

            //relaciones de varios a varios
            $crud->set_relation_n_n('PERMISOS', 'admin_permisos', 'admin_modulos', 'ID_ROL', 'ID_MODULO', 'NOMBRE_MODULO', 'PRIORIDAD');

            $output = $crud->render();
            $datos = (array) $output;
            $datos['TITULO_PAGINA'] = "Administrar Roles";
            $this->load->view('template_grocery.php', $datos);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function usuarios() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_table('admin_usuarios');
            $crud->set_subject('Usuarios');

            //los campos obligatorios
            $crud->required_fields('NOMBRE_COMPLETO', 'USUARIO', 'CLAVE');
             $crud->unique_fields('USUARIO');

            //para ocultar clave y encriptar
            $crud->change_field_type('CLAVE', 'password');
            $crud->callback_edit_field('CLAVE', array($this, 'set_password_input_to_empty'));
            $crud->callback_add_field('CLAVE', array($this, 'set_password_input_to_empty'));
            $crud->callback_before_insert(array($this, 'encrypt_password_callback'));
            $crud->callback_before_update(array($this, 'encrypt_password_callback'));

            //validaciones - Valores únicos
           // $crud->unique_fields('NOMBRE_USUARIO');

            $output = $crud->render();
            $datos = (array) $output;
            $datos['TITULO_PAGINA'] = "Administrar Usuarios";
            $this->load->view('template_grocery.php', $datos);
        } catch (Exception $e) {
            //show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            echo $e->getMessage() . ' --- ' . $e->getTraceAsString();
        }
    }

    function encrypt_password_callback($post_array, $primary_key) {
        //$this->load->library('encrypt');
        if (!empty($post_array['CLAVE'])) {
          //  $key = 'super-secret-key';
            //$post_array['CLAVE'] = $this->encrypt->encode($post_array['CLAVE'], $key);
            $post_array['CLAVE'] = md5($post_array['CLAVE']);
        } else {
            unset($post_array['CLAVE']);
        }
        return $post_array;
    }

    function set_password_input_to_empty() {
        return "<input type='password' name='CLAVE' class='form-control' value='' />";
    }

}
