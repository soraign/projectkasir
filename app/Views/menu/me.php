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
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover table-sm table-borderless">
                <caption class="caption-top">Selamat Datang <?= session()->get('username') ?>!.</caption>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
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
                        <td><?= $item->kategori; ?></td>
                        <?php if (!isset($pager)) : ?>
                        <?php endif; ?>
                        <td><a value="<?= $item->id ?>" class="text-decoration-none m-1 hapus" href="#"
                                data-bs-target="#confirm_hapus" data-bs-toggle="modal"><span
                                    class="badge bg-danger">Hapus</span></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div>
                    <div class="col-md">
                        <button onclick="window.print()" class="btn btn-outline-secondary shadow float-right">Print Data<i class="fa fa-print"></i></button>
                    </div>
                    </div>


<div id="confirm_hapus" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus</h4><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Kamu yakin ingin menghapus menu ini dari daftar?</p>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                <?= form_open(); ?>
                <button class="btn btn-primary form_delete" type="submit">Hapus</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script'); ?>
<script>
$(".hapus").click(function(e) {
    e.preventDefault();
    $('form').attr("action", "/menu/" + $(this).attr("value") + "/delete");
});
</script>
<?= $this->endSection() ?>