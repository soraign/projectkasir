<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php

use function PHPSTORM_META\map;


$nama = [
    'name' => 'nama',
    'class' => 'form-control',
    'autocomplete' => 'off'
];

$harga = [
    'name' => 'harga',
    'class' => 'form-control',
    'type'  => 'number',
    'autocomplete' => 'off'

];

$user_id = [
    'name' => 'user_id',
    'type' => 'hidden',
    'value' => session()->get('id')
];


$gambar = [
    'name' => 'image',
    'type' => 'file',
    'class' => 'form-control'
];

?>
<h1>Tambah Menu</h1>
<?= form_open('menu/create', [
    'enctype' => 'multipart/form-data'
]) ?>



<div class="form-group">
    <?= form_label('Nama Produk', 'nama') ?>
    <?= form_input($nama) ?>
</div>
<div class="form-group">
    <?= form_label('Harga', 'harga') ?>
    <?= form_input($harga) ?>
</div>
<?= form_input($user_id) ?>
<label for="kategori" class="mt-3">kategori</label>
<div class="form-check mt-3">
    <input value="Makanan" class="form-check-input" type="radio" name="kategori" id="flexRadioDefault1">
    <label class="form-check-label" for="flexRadioDefault1">
        Makanan
    </label>
</div>
<div class="form-check">
    <input value="Minuman" class="form-check-input" type="radio" name="kategori" id="flexRadioDefault2">
    <label class="form-check-label" for="flexRadioDefault2">
        Minuman
    </label>
</div>

<div class="form-group mt-3">
    <?= form_label('Gambar', 'gambar') ?>
    <?= form_upload($gambar) ?>
</div>

<div class="text-end mt-3">
    <?= form_submit('submit', 'Submit', ['class' => 'btn btn-primary']) ?>

</div>


<?= form_close() ?>
<?= $this->endSection() ?>