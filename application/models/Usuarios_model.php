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
        $this->db->from('ADMIN_USUARIOs');
        $consulta = $this->db->get();
        return $consulta->result();
    }

}
