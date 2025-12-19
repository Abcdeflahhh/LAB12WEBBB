<?php
// File: Module/Home/index.php

// Pastikan variabel $db tersedia (sudah di-instansiasi di index.php utama)
if (!isset($db)) {
    die("Error: Koneksi database tidak tersedia.");
}

// Instance Form dengan action ke URL yang sesuai routing
$form = new Form(BASE_URL . 'home/index', "Simpan Data"); 

// Definisikan Field Form
$form->addField("nama", "Nama Lengkap");
$form->addField("email", "Email");
$form->addField("pass", "Password", "password");
$form->addField("jenis_kelamin", "Jenis Kelamin", "radio", [
    'L' => 'Laki-laki',
    'P' => 'Perempuan'
]);
$form->addField("agama", "Agama", "select", [
    'Islam' => 'Islam', 'Kristen' => 'Kristen', 'Katolik' => 'Katolik',
    'Hindu' => 'Hindu', 'Budha' => 'Budha'
]);
$form->addField("hobi", "Hobi", "checkbox", [
    'Membaca' => 'Membaca', 'Coding' => 'Coding', 'Traveling' => 'Traveling'
]);
$form->addField("alamat", "Alamat Lengkap", "textarea");

// Logika penyimpanan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['pass'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $agama = $_POST['agama'] ?? '';
    $hobi_array = $_POST['hobi'] ?? [];
    $alamat = trim($_POST['alamat'] ?? '');
    
    $hobi = is_array($hobi_array) ? implode(',', $hobi_array) : ''; 

    // Set nilai form kembali agar user tidak mengetik ulang jika error
    $form->setFieldValue('nama', $nama);
    $form->setFieldValue('email', $email);
    $form->setFieldValue('jenis_kelamin', $jenis_kelamin);
    $form->setFieldValue('agama', $agama);
    $form->setFieldValue('hobi', $hobi_array);
    $form->setFieldValue('alamat', $alamat);

    // Validasi
    if (empty($nama) || empty($email) || empty($pass)) {
        echo "<div style='color:red; padding: 10px; border: 1px solid red;'>Error: Nama, Email, dan Password wajib diisi!</div>";
    } else {
        $data = [
            'nama' => $nama,
            'email' => $email,
            'pass' => password_hash($pass, PASSWORD_DEFAULT),
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama,
            'hobi' => $hobi,
            'alamat' => $alamat,
        ];

        // Lakukan insert menggunakan object $db dari index.php
        $simpan = $db->insert('users', $data);
        if ($simpan) {
            // Reset form jika sukses
            $form = new Form(BASE_URL . 'home/index', "Simpan Data"); 
            echo "<div style='color:green; padding: 10px; border: 1px solid green;'>Data berhasil disimpan!</div>";
        } else {
            echo "<div style='color:red; padding: 10px; border: 1px solid red;'>Gagal menyimpan data ke database.</div>";
        }
    }
}
?>

<h2>Form Input User</h2>
<div class="form-container">
    <?php $form->displayForm(); ?>
</div>
