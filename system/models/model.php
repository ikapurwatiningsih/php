<?php

class model extends CI_Model {

    public function login($user, $pass) {
        $lahir=md5(substr($pass, 4,4)."-".substr($pass, 2,2)."-".substr($pass, 0,2));
        $pass=md5($pass);
        $query = $this->db->query("(SELECT 
                    `id_mahasiswa` as id_user, 
                    `nim` as username, 
                    `nama` as realname, 
                    `tgllahir` as password,
                    'mahasiswa' as lvl 
                FROM `mahasiswa`
                WHERE nim='$user'
                AND md5(tgllahir)='$lahir'
                ) union (SELECT 
                    `id_dosen` as id_user, 
                    `nip` as username, 
                    `nama` as realname, 
                    `tgllahir` as password,
                    'dosen' as lvl 
                FROM `dosen`
                WHERE nip='$user'
                AND md5(tgllahir)='$lahir'
                ) union (SELECT 
                    `id_user`, 
                    `username`, 
                    `realname`, 
                    `password`,
                    'admin' as lvl 
                FROM `user` 
                WHERE username='$user'
                AND password='$pass'
                ) LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $this->session->set_userdata('login', TRUE);
            $this->session->set_userdata('user_id', $row['id_user']);
            $this->session->set_userdata('real_name', $row['realname']);
            $this->session->set_userdata('user_name', $row['username']);
            $this->session->set_userdata('user_pass', $row['password']);
            $this->session->set_userdata('user_time', date('H:i'));
            $this->session->set_userdata('user_level', $row['lvl']);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_total($table, $cond, $groupby) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        if (isset($groupby)) {
            $this->db->group_by($groupby);
        }
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function get_detail($table, $cond) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        $query = $this->db->get($table);
        foreach ($query->result_array() as $r)
            ;
        return $r;
    }

    public function get_data_like($table, $cond, $opt) {
        for ($x = 0; $x < count($cond['column']); $x++) {
            for ($y = 0; $y < count($cond['key']); $y++) {
                $this->db->or_like($cond['column'][$x], $cond['key'][$y]);
            }
        }
        if (is_array($opt)) {
            if (isset($opt['order_by'])) {
                $this->db->order_by($opt['order_by'][0], $opt['order_by'][1]);
            }
        }
        $query = $this->db->get($table, $opt['limit'][1], $opt['limit'][0]);
        return $query;
    }

    public function get_data($table, $cond, $no, $perpage) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        if (is_array($no)) {
            if (isset($no['order_by'])) {
                $this->db->order_by($no['order_by'][0], $no['order_by'][1]);
            }
            if (isset($no['group_by'])) {
                $this->db->group_by($no['group_by']);
            }
            if (isset($no['limit'])) {
                $query = $this->db->get($table, $no['limit'][1], $no['limit'][0]);
            } else {
                $query = $this->db->get($table);
            }
        } else {
            if (isset($no) && isset($perpage)) {
                $query = $this->db->get($table, $perpage, $no);
            } else {
                $query = $this->db->get($table);
            }
        }
        return $query;
    }

    public function hapus($table, $cond) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        $query = $this->db->delete($table);
        return $query;
    }

    public function update($table, $insert, $update = null) {
        if ($update == null) {
            $query = $this->db->insert($table, $insert);
        } else {
            $this->db->where($update);
            $query = $this->db->update($table, $insert);
        }
        return $query;
    }

    function simpan_kelas($data) {
        $this->db->trans_start();
        if (is_numeric($data['id_kelas'])) {
            $this->db->where(array('id_kelas' => $data['id_kelas']));
            $this->db->update("kelas", array('id_matkul' => $data['id_matkul'], 'kelas' => $data['kelas']));
        } else {
            $this->db->insert("kelas", array('id_matkul' => $data['id_matkul'], 'kelas' => $data['kelas']));
            $data['id_kelas'] = $this->db->insert_id();
        }
        $this->db->delete("kelas_dosen", array('id_kelas' => $data['id_kelas']));
        foreach ($data['dosen'] as $v) {
            $this->db->insert("kelas_dosen", array('id_kelas' => $data['id_kelas'], 'id_dosen' => $v));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
    
    function bukan_peserta($id) {
        return $this->db->query("SELECT id_mahasiswa,nim,nama FROM mahasiswa WHERE id_mahasiswa not in (SELECT id_mahasiswa from kelas_mahasiswa WHERE id_kelas='$id')");
    }
    
    function tambah_peserta($id,$peserta) {
        $this->db->trans_start();
        foreach ($peserta as $p) {
            $this->db->insert("kelas_mahasiswa", array('id_kelas' => $id, 'id_mahasiswa' => $p));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
    
    function kuliah_dosen() {
        $id=$this->session->userdata('user_id');
        return $this->db->query("SELECT `id_kuliah`, `id_kelas`, `id_matkul`, `matkul`, `kelas`, `dosen`, `id_hari`, `hari`, `mulai`, `selesai`, `id_ruang`, `ruang` FROM `v_kuliah` "
                . "WHERE id_kelas in (SELECT id_kelas from kelas_dosen WHERE id_dosen='$id')");
    }
    
    function ujian_dosen($status) {
        $id=$this->session->userdata('user_id');
        return $this->db->query("SELECT `id_ujian`, `id_kelas`, `id_matkul`, `matkul`, `kelas`, `dosen`, `tgl`, `jam`, `id_ruang`, `ruang`, `status` FROM `v_ujian` "
                . "WHERE status='$status' AND id_kelas in (SELECT id_kelas from kelas_dosen WHERE id_dosen='$id')");
    }
    
    function kelas_dosen() {
        $id=$this->session->userdata('user_id');
        return $this->db->query("SELECT `id_kelas`, `id_matkul`, `matkul`, `kelas`, `dosen` FROM `v_kelas` "
                . "WHERE id_kelas in (SELECT id_kelas from kelas_dosen WHERE id_dosen='$id')");
    }
    
    function kuliah_mahasiswa() {
        $id=$this->session->userdata('user_id');
        return $this->db->query("SELECT `id_kuliah`, `id_kelas`, `id_matkul`, `matkul`, `kelas`, `dosen`, `id_hari`, `hari`, `mulai`, `selesai`, `id_ruang`, `ruang` FROM `v_kuliah` "
                . "WHERE id_kelas in (SELECT id_kelas from kelas_mahasiswa WHERE id_mahasiswa='$id')");
    }
    
    function ujian_mahasiswa($status) {
        $id=$this->session->userdata('user_id');
        return $this->db->query("SELECT `id_ujian`, `id_kelas`, `id_matkul`, `matkul`, `kelas`, `dosen`, `tgl`, `jam`, `id_ruang`, `ruang`, `status` FROM `v_ujian` "
                . "WHERE status='$status' AND id_kelas in (SELECT id_kelas from kelas_mahasiswa WHERE id_mahasiswa='$id')");
    }
    
    function kelas_mahasiswa() {
        $id=$this->session->userdata('user_id');
        return $this->db->query("SELECT `id_kelas`, `id_matkul`, `matkul`, `kelas`, `dosen` FROM `v_kelas` "
                . "WHERE id_kelas in (SELECT id_kelas from kelas_mahasiswa WHERE id_mahasiswa='$id')");
    }

}

?>
