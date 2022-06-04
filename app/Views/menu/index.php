<?php
function validate_url($url)
{
    return preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $url);
}
function rupiah($angka)
{
    $angka = (int) $angka;
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless data">
                <caption class="caption-top">Daftar menu</caption>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Add By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menu as $item) : ?>
                    <tr>
                        <td><?= $item->nama; ?></td>
                        <td><?= rupiah($item->harga); ?></td>
                        <td><img src="<?= validate_url($item->gambar) ? $item->gambar : "/uploads/{$item->gambar}"; ?>"
                                width="100" height="100" class="img-fluid img-thumbnail img-responsive rounded-box"
                                alt="<?= $item->nama; ?>">
                        </td>
                        <td><?= $item->kategori; ?></td>
                        <?php if (!isset($pager)) : ?>
                        <td><a class="text-decoration-none" href="<?= "/user/" . $item->id; ?>"
                                data-bs-target="#maintenance" data-bs-toggle="modal"><?= $item->username; ?></a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (isset($pager)) : ?>
<div class="row">
    <div class="col">
        <?= $pager->links(); ?>
    </div>
</div>
<?php endif; ?>


<div id="maintenance" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informasi!</h4><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Ini adalah anggota yang menambahkan produk</p>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
