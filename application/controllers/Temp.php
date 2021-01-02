<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Temp extends CI_Controller
{
    public function tambah()
    {
        $i = $this->input->post();
        $kat = $i['kat'];
        $data = $this->db->where('id_barang', $i['id_barang'])->get('barang')->row();

        if ($kat == 'L') {
            $harga = $data->harga_laundry_barang;
        } else {
            $harga = $data->harga_dry_barang;
        }

        $input = array(
            'id_barang'             => $data->id_barang,
            'banyak_barang_temp'    => $i['jumlah'],
            'harga_barang_temp'     => $harga,
            'kategori_temp'         => $kat,
            'id_user'               => $this->session->id_user
        );

        $this->db->insert('temp', $input);
        return redirect(base_url($i['link']));
    }

    public function hapus($id, $link)
    {
        if (!$id) {
            $this->session->set_flashdata('error', 'URL tidak valid');
            return redirect(base_url($link));
        }
        $this->db->where('id_temp', $id)->delete('temp');
        $this->session->set_flashdata('success', 'Daftar berhasil dihapus');
        return redirect(base_url($link));
    }

    public function clear($link)
    {
        $this->db->truncate('temp');
        $this->session->set_flashdata('success', 'Seluruh Daftar berhasil dihapus');
        return redirect(base_url($link));
    }
}
