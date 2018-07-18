<?php

class Usuarios_model extends CI_Model {

    public function buscar_autentificacion($usuario, $clave) {
        $user = $this->db->select('*')->get_where('ADMIN_USUARIOS', array(
                    'usuario' => $usuario,
                    'clave' => $clave
                ))->row();
        return $user;
    }

    public function get_usuarios() {
        $this->db->select('*');
        $this->db->from('ADMIN_USUARIOS');
        //$this->db->join('admin_roles', 'admin_usuarios.ID_ROL = admin_roles.ID_ROL');
        $consulta = $this->db->get();
        return $consulta->result();
    }

}
