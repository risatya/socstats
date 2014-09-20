<?php

class m_bola extends CI_Model {

    function history($id_team = '', $starttgl = '') {
        $this->db->where('id_team', $id_team);
        $this->db->where('status_tanding', '1');
        if ($starttgl != '') {
            $this->db->where('date >', $starttgl);
        }
        $this->db->order_by('date', 'desc');
        // $this->db->limit(20);
        return $this->db->get('dom')->result_array();
    }

    function getbuathistory($id_negara = 1, $order_by = 'id_team') {
        $listteam = $this->getteambynegara($id_negara, $order_by);
        $starttgl = $this->getstartdatebyidnegara($id_negara);
        $data = null;
        $i = 0;
        foreach ($listteam as $team) {
            $data[$i]['id_team'] = $team['id_team'];
            $data[$i]['team'] = $team['team'];
            $data[$i]['rekap'] = array_reverse($this->history2($team['id_team'], $starttgl));
            $i++;
        }
        return $data;
    }
    
    function history2($id_team = '', $starttgl = '') {
        $this->db->where('id_team', $id_team);
        $this->db->where('status_tanding', '1');
        if ($starttgl != '') {
//            $this->db->where('date >', $starttgl);
//            $this->db->where("dom.date BETWEEN CURDATE()- INTERVAL 30 DAY and SYSDATE()");
        }
        $this->db->order_by('status_tanding', 'desc');
		$this->db->order_by('date', 'desc');
        $this->db->limit(30);
        return $this->db->get('dom')->result_array();
    }
    
    

    function input_team($data = '') {
        if (!$this->cek_team_is_exist($data['team'])) {
            $this->db->trans_start();
            $this->db->insert('team', $data);
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
        else
            return false;
    }

    function updatestartdate($tgl, $id) {
        $data['tgl_start'] = $tgl;
        $this->db->trans_start();
        $this->db->where('id_negara', $id);
        $this->db->update('negara', $data);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    function ubahpass($id, $data) {
        $this->db->trans_start();
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function getpassbyid($id = 0) {
        $this->db->where('id_user', $id);
        $res = $this->db->get('user')->result_array();
        return $res[0]['password'];
    }

    function deletenegara($id_negara = 0) {
        $this->db->trans_start();
        $this->db->delete('negara', array('id_negara' => $id_negara));
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    function getteambyid($id = 0) {
        $this->db->join('negara', 'team.id_negara=negara.id_negara');
        $d = $this->db->get_where('team', array('id_team' => $id));
        return $d->row();
    }

    function input_negara($data = '') {
        $this->db->trans_start();
        $this->db->insert('negara', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function negarabyid($id_negara = 1) {
        $this->db->where('id_negara', $id_negara);
        $res = $this->db->get('negara')->result_array();
        return $res[0]['negara'];
         
    }

    function edit_team($data = '') {
        $ndata['team'] = $data['team'];
        $ndata['link'] = $data['link'];
        // echo '<pre>';
        //print_r($data);exit();
        $this->db->trans_start();
        $this->db->where('id_team', $data['id_team']);
        $this->db->update('team', $ndata);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function edit_country($data, $id_country = '') {

        // echo '<pre>';
        //print_r($data);exit();
        $this->db->trans_start();
        $this->db->where('id_negara', $id_country);
        $this->db->update('negara', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function get_id_negara($nama_negara = '') {
        $this->db->where('negara', $nama_negara);
        $res = $this->db->get('negara');
        if ($res->num_rows() > 0) {
            $res = $res->result_array();
            return $res[0]['id_negara'];
        } else {
            $data['negara'] = $nama_negara;
            $this->insert_negara($data);
            $this->db->where('negara', $nama_negara);
            $res2 = $this->db->get('negara');
            $res2 = $res2->result_array();
            return $res2[0]['id_negara'];
        }
    }

    function cek_team_is_exist($nama_team = '') {
        $this->db->where('team', $nama_team);
        $res = $this->db->get('team');
        if ($res->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert_negara($data) {
        $this->db->trans_start();
        $this->db->insert('negara', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function list_team($order_by = 'id_team', $id_negara = 0) {
        if ($order_by == '') {
            $order_by = 'id_team';
        }
        $this->db->select('*');
        $this->db->where('team.id_negara', $id_negara);
        $this->db->join('negara', 'team.id_negara=negara.id_negara');
        $this->db->order_by($order_by, 'asc');
        return $this->db->get('team')->result_array();
    }

    function extratime_list($order_by = 'id_team', $edited = 0, $tipe = '') {
        if ($order_by = '') {
            $order_by = 'id_team';
        }
        $this->db->select('*,extratime');
        $this->db->join('negara', 'team.id_negara=negara.id_negara');
        $this->db->join('dom', 'team.id_team=dom.id_team');
        if ($tipe == 'E') {
            return $this->db->get_where('team', array('extratime' => 'E', 'edited' => 0))->result_array();
        } else if ($tipe == 'P') {
            return $this->db->get_where('team', array('extratime' => 'P', 'edited' => 0))->result_array();
        } else if ($tipe == 'D') {
            return $this->db->get_where('team', array('extratime !=' => '', 'edited' => 1))->result_array();
        } else {
            $this->db->where('extratime !=', '');
            return $this->db->get_where('team', array('edited' => 0))->result_array();
        }
    }

    function delete_team($id_team) {
        $this->db->trans_start();
        $this->db->delete('team', array('id_team' => $id_team));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function deletedom($id_team) {
        $this->db->trans_start();
        $this->db->delete('dom', array('id_team' => $id_team));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function getnegara() {
//    	$this->db->select('*');
        $this->db->select('*,count(negara.id_negara) as "count"');
        $this->db->join('team', 'negara.id_negara=team.id_negara', 'left');
        $this->db->group_by('team.id_negara');
        $this->db->order_by('negara.negara', 'asc');
        return $this->db->get('negara')->result_array();
    }
    
    
    function getnegara2() {
//    	$this->db->select('*');
        $this->db->order_by('negara.negara', 'asc');
        return $this->db->get('negara')->result_array();
    }

    function getnegaraischecked() {
        $this->db->select('*,count(negara.id_negara) as "count"');
        $this->db->join('team', 'negara.id_negara=team.id_negara', 'left');
        $this->db->group_by('team.id_negara');
        $this->db->order_by('negara.negara', 'asc');
        $this->db->where('negara.is_checked', 1);
        return $this->db->get('negara')->result_array();
    }

    function updatenegaraischecked($idnegara) {
        $data['is_checked'] = 1;
        $this->db->trans_start();
        $this->db->where('id_negara', $idnegara);
        $this->db->update('negara', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function updatenegaraischeckednull() {
        $data['is_checked'] = null;
        $this->db->trans_start();
        $this->db->update('negara', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function getteam() {
        return $this->db->get('team')->result_array();
    }

    function getteambynegara($id_negara = 0, $order_by) {
        $this->db->where('id_negara', $id_negara);
        $this->db->order_by($order_by);
        return $this->db->get('team')->result_array();
    }

    function getdatateampernegara($id_negara = 1, $order_by = 'id_team') {
        $listteam = $this->getteambynegara($id_negara, $order_by);
        $starttgl = $this->getstartdatebyidnegara($id_negara);
        $data = null;
        $i = 0;
        foreach ($listteam as $team) {
            $data[$i]['id_team'] = $team['id_team'];
            $data[$i]['team'] = $team['team'];
            $data[$i]['rekap'] = array_reverse($this->rekapteam($team['id_team'], $starttgl));
            $i++;
        }
        return $data;
    }

    function getstartdatebyidnegara($id_negara) {
        $this->db->where('id_negara', $id_negara);
        $res = $this->db->get('negara')->result_array();
        if (sizeof($res) != 0) {
            return $res[0]['tgl_start'];
        }
        else
            return '';
    }

    function rekapteam($id_team = '', $starttgl = '') {
        $this->db->where('id_team', $id_team);
        $this->db->where('status_tanding', '1');
        if ($starttgl != '') {
            $this->db->where('date >', $starttgl);
        }
        $this->db->order_by('date', 'desc');
        $this->db->limit(20);
        return $this->db->get('dom')->result_array();
    }

    function getallsummary($page = 0, $tipe = 'oe', $f = 2) {
        $negara = $this->getnegaraischecked();
        $data = '';
        foreach ($negara as $key => $n) {
            $data[$key]['id_negara'] = $n['id_negara'];
            $data[$key]['negara'] = $n['negara'];
            $data[$key]['row'] = $this->getsummary($n['id_negara'], $page, $tipe, $f);
        }
        return $data;
    }

    function getallsummarycomp($page = 0, $tipe = 'oe', $f = 2) {
        $negara = $this->getcompetitionischecked();
        //echo "<pre>";
        //print_r($negara);
        //exit();
        $data = $this->getsummarycomp( $page, $tipe, $f);

        return $data;
    }

    function filtersummary($id_team) {
        //$sql = 'SELECT * FROM dom where team_a like "%" and team_b like "%" and link is not null or team_a like "%" and team_b like "%" and link is not null group by date';
        // $q = $this->db->query($sql);
        // return $q->result_array();
        $sql = "delete from dom where id_team = '$id_team' AND status_tanding = '0'";
        $q = $this->db->query($sql);
        //return $q->row_array();
    }

    function tanggalsummary($page = 0) {
        //$date = '2013-4-8';
        $kurang = $page * 5;
        $date = date('Y-m-d');
        $date = date('Y-m-d', strtotime('+' . $kurang . ' day', strtotime($date)));
        $data[0] = date('Y-m-d', strtotime('-1 day', strtotime($date)));
        $data[1] = date('Y-m-d', strtotime('+0 day', strtotime($date)));
        $data[2] = date('Y-m-d', strtotime('+1 day', strtotime($date)));
        $data[3] = date('Y-m-d', strtotime('+2 day', strtotime($date)));
        $data[4] = date('Y-m-d', strtotime('+3 day', strtotime($date)));
        //$data[5] = date('Y-m-d', strtotime('+2 day', strtotime($date)));
        //$data[6] = date('Y-m-d', strtotime('+3 day', strtotime($date)));
        return $data;
    }

    function getsummary($id_negara = 5, $page = 0, $tipe, $f = 2) {
        //1. get hari ini
        //1. get hari ini+1
        //1. get hari ini+2
        //$date = '2013-4-8';
        $kurang = $page * 5;
        $date = date('Y-m-d');
        $date = date('Y-m-d', strtotime('+' . $kurang . ' day', strtotime($date)));
        $sum[0] = $this->getsummarybydate(date('Y-m-d', strtotime('-1 day', strtotime($date))), $id_negara, $tipe, $f);
        $sum[1] = $this->getsummarybydate(date('Y-m-d', strtotime('+0 day', strtotime($date))), $id_negara, $tipe, $f);
        $sum[2] = $this->getsummarybydate(date('Y-m-d', strtotime('+1 day', strtotime($date))), $id_negara, $tipe, $f);
        $sum[3] = $this->getsummarybydate(date('Y-m-d', strtotime('+2 day', strtotime($date))), $id_negara, $tipe, $f);
        $sum[4] = $this->getsummarybydate(date('Y-m-d', strtotime('+3 day', strtotime($date))), $id_negara, $tipe, $f);
        //$sum[5] = $this->getsummarybydate(date('Y-m-d', strtotime('+2 day', strtotime($date))), $id_negara, $tipe,$f);
        //$sum[6] = $this->getsummarybydate(date('Y-m-d', strtotime('+3 day', strtotime($date))), $id_negara, $tipe,$f);

        $data;
        //echo '<pre>';
        $i = 0;
        $j = 0;
        $k = 0;
        $id_negara_last = 0;

        foreach ($sum as $key_day => $s) {
            foreach ($s as $key => $t) {
                //print_r($t);exit();
                if ($t['id_negara'] == $id_negara_last) {

                    $j++;
                    $k++;
                } else {
                    $data[$i]['id_negara'] = $t['id_negara'];
                    $data[$i]['negara'] = $t['negara'];
                    $data[$i]['row'][$j]['team'] = $t['negara'];
                    $i++;
                    $j = 0;
                    $k = 0;
                }
                $id_negara_last = $t['id_negara'];
            }
        }
        return $sum;
    }
    
    function getsummarycomp($page = 0, $tipe, $f = 2) {
        //1. get hari ini
        //1. get hari ini+1
        //1. get hari ini+2
        //$date = '2013-4-8';
        $kurang = $page * 5;
        $date = date('Y-m-d');
        $date = date('Y-m-d', strtotime('+' . $kurang . ' day', strtotime($date)));
        $sum[0] = $this->getsummarybydatecomp(date('Y-m-d', strtotime('-1 day', strtotime($date))), $tipe, $f);
        $sum[1] = $this->getsummarybydatecomp(date('Y-m-d', strtotime('+0 day', strtotime($date))), $tipe, $f);
        $sum[2] = $this->getsummarybydatecomp(date('Y-m-d', strtotime('+1 day', strtotime($date))), $tipe, $f);
        $sum[3] = $this->getsummarybydatecomp(date('Y-m-d', strtotime('+2 day', strtotime($date))), $tipe, $f);
        $sum[4] = $this->getsummarybydatecomp(date('Y-m-d', strtotime('+3 day', strtotime($date))), $tipe, $f);
        //$sum[5] = $this->getsummarybydate(date('Y-m-d', strtotime('+2 day', strtotime($date))), $id_negara, $tipe,$f);
        //$sum[6] = $this->getsummarybydate(date('Y-m-d', strtotime('+3 day', strtotime($date))), $id_negara, $tipe,$f);

        $data;
        //echo '<pre>';
        $i = 0;
        $j = 0;
        $k = 0;
        $id_negara_last = 0;

        foreach ($sum as $key_day => $s) {
            foreach ($s as $key => $t) {
                //print_r($t);exit();
                if ($t['id_negara'] == $id_negara_last) {

                    $j++;
                    $k++;
                } else {
                    $data[$i]['id_negara'] = $t['id_negara'];
                    $data[$i]['negara'] = $t['negara'];
                    $data[$i]['row'][$j]['team'] = $t['negara'];
                    $i++;
                    $j = 0;
                    $k = 0;
                }
                $id_negara_last = $t['id_negara'];
            }
        }
        //echo '<pre>';
        //print_r($sum);
        //exit();
        return $sum;
    }
    
    function getsummarybydatecomp($date = '', $tipe, $f = 2) {
        //$date='2013-08-23';
        //$this->db->where('status_tanding', 0);
        //$this->db->query('select competition.kepanjangan, competition.link_competition as link from competition;');
        $this->db->where('date', $date);
        $this->db->where('competition.is_checked', "1");
        $this->db->join('team', 'dom.id_team=team.id_team');
        $this->db->join('negara', 'team.id_negara=negara.id_negara');
        $this->db->join('competition', 'dom.id_competition=competition.id_competition', 'left');

        $res = $this->db->get('dom')->result_array();

        $data = array();
        //echo $date.$id_negara;
        //echo '<pre>';
        //echo print_r($res);
        //echo '</pre>';
        //exit();
        foreach ($res as $key => $r) {
            $r['sum'] = $this->isandalan($r['id_team'], $date, $tipe);
            if ($r['sum'] >= $f) {

                $data[] = $r;
            }
        }
        return $data;
    }
    function getsummarybydate($date = '', $id_negara = 0, $tipe, $f = 2) {
        //$date='2013-08-23';
        //$this->db->where('status_tanding', 0);
        //$this->db->query('select competition.kepanjangan, competition.link as link_competition from competition');
        $this->db->where('date', $date);
        $this->db->where('negara.id_negara', $id_negara);
        $this->db->join('team', 'dom.id_team=team.id_team');
        $this->db->join('negara', 'team.id_negara=negara.id_negara');
        $this->db->join('competition', 'dom.id_competition=competition.id_competition', 'left');

        $res = $this->db->get('dom')->result_array();
        
        //echo '<pre>';
        //print_r($res);
        //echo '<pre>';
        //EXIT();
        //tekan kene 22 februari 2014
        
        $data = array();
        //echo $date.$id_negara;
        //echo '<pre>';
        //echo print_r($res);
        //echo '</pre>';
        //exit();
        foreach ($res as $key => $r) {
            $r['sum'] = $this->isandalan($r['id_team'], $date, $tipe);
            if ($r['sum'] >= $f) {

                $data[] = $r;
            
            }
            
        }
        return $data;
    }

    function getfirstidnegara() {
        $this->db->select('id_negara');
        $this->db->order_by('negara', 'asc');
        $this->db->limit('1');

        $query = $this->db->get('negara')->result_array();

        return $query[0]['id_negara'];
    }

    function isandalan($id_team = '', $date = '', $tipe) {
        $this->db->select('result,result2,result3,result4');
        $this->db->where('team.id_team', $id_team);
        $this->db->where('status_tanding', '1');
        $this->db->where('date <', $date);

        $this->db->join('dom', 'team.id_team=dom.id_team');
        $this->db->order_by('dom.date', 'desc');
        //$this->db->limit(3);
        $res = $this->db->get('team')->result_array();

        $sum = 0;
        if ($tipe == 'oe') {
            foreach ($res as $key => $r) {
                if ($r['result'] == 'E') {
                    $sum++;
                }
                else
                    break;
            }
        } else if ($tipe == 'ou') {
            foreach ($res as $key => $r) {
                if ($r['result2'] == 'U') {
                    $sum++;
                }
                else
                    break;
            }
        } else if ($tipe == 'ox') {
            foreach ($res as $key => $r) {
                if ($r['result3'] == 'O') {
                    $sum++;
                }
                else
                    break;
            }
        } else if ($tipe == 'te') {
            foreach ($res as $key => $r) {
                if ($r['result4'] == 'E') {
                    $sum++;
                }
                else
                    break;
            }
        } 


        return $sum;
    }

    function edit_dom($data = '', $id_dom = 0) {
        $this->db->where('id_dom', $id_dom);

        $this->db->trans_start();
        $this->db->update('dom', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function listcompetition() {
        return $this->db->get('competition')->result_array();
    }

    function getcompetition() {
        return $this->db->get('competition')->result_array();
    }

    function getcompetitionischecked() {
        $this->db->where('competition.is_checked', 1);
        return $this->db->get('competition')->result_array();
    }

    function updatecompetitionischecked($idcompetition) {
        $data['is_checked'] = 1;
        $this->db->trans_start();
        $this->db->where('id_competition', $idcompetition);
        $this->db->update('competition', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function updatecompetitionischeckednull() {
        $data['is_checked'] = 0;
        $this->db->trans_start();
        $this->db->update('competition', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

}

?>