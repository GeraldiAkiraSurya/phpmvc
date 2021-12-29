<?php

class About extends Controller {
    public function index($nama = 'Geraldi', $pekerjaan = 'Mahasiswa', $umur = '21') {
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $data['active'] = 'About';
        $data['judul'] = 'About Me';
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }

    public function page() {
        $data['judul'] = 'Pages';
        $data['active'] = 'About';
        $this->view('templates/header', $data);
        $this->view('about/page');
        $this->view('templates/footer');
    }
}