<?php

class m_dom extends CI_Model {
//	function insertdom($data = '') {
//		
//		$data=$this->comptoidcomp($data);
//		unset ($data['linkss']);
//		unset ($data['kepanjangan']);
//		$this -> db -> trans_start();
//		$this -> db -> insert('dom', $data);
//		$this -> db -> trans_complete();
//}
    
    function updatecomp($data='', $id_competition){
        $this->db->trans_start();
        $this->db->where('id_competition', $id_competition);
        $this->db->update('competition', $data);
        $this->db->trans_complete();
        return ($this->db->trans_status()) ? 1 : 0;    }
    
    function insertdom($data = '') {

        $data = $this->comptoidcomp($data);
        unset($data['link']);
        unset($data['kepanjangan']);
        $this->db->trans_start();
        $this->db->insert('dom', $data);
        $this->db->trans_complete();
        return ($this->db->trans_status()) ? 1 : 0;

        }
        
        function deleteisnull(){
            return  $this->db->delete('dom',array('id_team' => null) );
          
        }
          function updatelastsync($id_negara) {
        $data = array(
            'llast_sync' => date('Y-m-d')
        );
        $this->db->trans_start();
        $this->db->where('id_negara', $id_negara);
        $this->db->update('negara', $data);
        $this->db->trans_complete();
        return ($this->db->trans_status()) ? 1 : 0;
    }

    function delete_domygblmtandingbyidteam($id_team){
        $this->db->delete('dom', array('id_team' => $id_team, 'status_tanding' => '0')); 
    }
   
    function comptoidcomp($data) {
//        print_r($data);
//        exit();
        $data['id_competition'] = $this->idcompbyname($data['id_competition'], $data['link'], $data['kepanjangan']);
        return $data;
    }

    function idcompbyname($name = '', $link = '', $kepanjangan = '') {
        if ($this->cekidcomp($name) == FALSE) {
            if ($this->insertnewcomp($name, $link, $kepanjangan)) {
                
            }
        }
        $this->db->where('competition', $name);
        $id = $this->db->get('competition')->result_array();
        return $id[0]['id_competition'];
    }

    function insertnewcomp($name, $link, $kepanjangan) {
        $data['competition'] = $name;
        $data['link'] = $link;
        $data['kepanjangan'] = $kepanjangan;
        $this->db->trans_start();
        $this->db->insert('competition', $data);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    function cekidcomp($name) {
        $this->db->where('competition', $name);
        $numr = $this->db->get('competition')->num_rows();
        if ($numr > 0)
            return true;
        else
            return false;
    }

    function updatedom($data = '') {
        $data = $this->comptoidcomp($data);
        $this->db->trans_start();
        unset($data['linkss']);
        unset($data['kepanjangan']);
        $this->db->where('id_team', $data['id_team']);
        $this->db->where('date', $data['date']);
        $this->db->update('dom', $data);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    function cekedited($data = '') {
        $this->db->where('id_team', $data['id_team']);
        $this->db->where('date', $data['date']);
        $this->db->where('edited', 1);
        $res = $this->db->get('dom');
        if ($res->num_rows() > 0) {
            return 1;
        }else
            return 0;
    }

    function cekdataisexist($id_team = '', $date = '') {
        $this->db->where('id_team', $id_team);
        $this->db->where('date', $date);
        return ($this->db->get('dom')->num_rows() > 0) ? TRUE : FALSE;
    }

//}
}