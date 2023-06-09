<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));
if ($data_user['username'] == 'admin') {
    $sertifikat = mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat ORDER BY judul ASC");

    $total_sertifikat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, count(sertifikat.id_sertifikat) as total_sertifikat FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat ORDER BY judul ASC"))['total_sertifikat'];

    $total_nilai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, sum(penilaian.nilai) as total_nilai FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat ORDER BY judul ASC"))['total_nilai'];

    $nilai_terendah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, min(penilaian.nilai) as nilai_terendah FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat ORDER BY judul ASC"))['nilai_terendah'];

    $nilai_tertinggi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, max(penilaian.nilai) as nilai_tertinggi FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat ORDER BY judul ASC"))['nilai_tertinggi'];

    $rata_rata = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, avg(penilaian.nilai) as rata_rata FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat ORDER BY judul ASC"))['rata_rata'];

    if (isset($_POST['btnCari'])) {
        $keyword = $_POST['keyword'];
        $sertifikat = mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE judul LIKE '%$keyword%' 
            OR keterangan LIKE '%$keyword%'
            OR tanggal_diterima LIKE '%$keyword%'
            OR tanggal_kedaluwarsa LIKE '%$keyword%'
            OR nilai LIKE '%$keyword%'
            OR file_sertifikat LIKE '%$keyword%'
            ORDER BY tanggal_diterima DESC");
    }
} else {
    $sertifikat = mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_user = '$id_user' ORDER BY judul ASC");

    $total_sertifikat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, count(sertifikat.id_sertifikat) as total_sertifikat FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_user = '$id_user' ORDER BY judul ASC"))['total_sertifikat'];

    $total_nilai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, sum(penilaian.nilai) as total_nilai FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_user = '$id_user' ORDER BY judul ASC"))['total_nilai'];

    $nilai_terendah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, min(penilaian.nilai) as nilai_terendah FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_user = '$id_user' ORDER BY judul ASC"))['nilai_terendah'];

    $nilai_tertinggi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, max(penilaian.nilai) as nilai_tertinggi FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_user = '$id_user' ORDER BY judul ASC"))['nilai_tertinggi'];

    $rata_rata = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat, avg(penilaian.nilai) as rata_rata FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_user = '$id_user' ORDER BY judul ASC"))['rata_rata'];

    if (isset($_POST['btnCari'])) {
        $keyword = $_POST['keyword'];
        $sertifikat = mysqli_query($koneksi, "SELECT *, sertifikat.id_sertifikat AS sertifikat_id_sertifikat FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_user = '$id_user' 
            AND user.id_user = '$id_user' 
            AND (judul LIKE '%$keyword%' 
            OR keterangan LIKE '%$keyword%'
            OR tanggal_diterima LIKE '%$keyword%'
            OR tanggal_kedaluwarsa LIKE '%$keyword%'
            OR nilai LIKE '%$keyword%'
            OR file_sertifikat LIKE '%$keyword%')
            ORDER BY tanggal_diterima DESC");
    }

}

?>


<html>
<head>
    <title>Dashboard - Manajemen Sertifikat Digital</title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <h1 class="text-center">Daftar Sertifikat</h1>
        <?php if ($data_user['username'] == 'admin'): ?>
            <h2 class="text-center">Selamat Datang Administrator</h2>
        <?php endif ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <h4>Total Sertifikat: <?= str_replace(",", ".", number_format($total_sertifikat)); ?></h4>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h4>Total Nilai: <?= str_replace(",", ".", number_format($total_nilai)); ?></h4>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h4>Nilai Terendah: <?= str_replace(",", ".", number_format($nilai_terendah)); ?></h4>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h4>Nilai Tertinggi: <?= str_replace(",", ".", number_format($nilai_tertinggi)); ?></h4>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h4>Rata-rata: <?= str_replace(",", ".", number_format($rata_rata)); ?></h4>
                </div>
            </div>
        </div>
        <form method="post" class="form-search">
            <input type="text" name="keyword" id="keyword" required value="<?= (isset($_POST['btnCari'])) ? $keyword : ''; ?>">
            <button type="submit" name="btnCari" class="btn">Cari</button>
            <?php if (isset($_POST['btnCari'])): ?>
                <button type="button" onclick="return window.location.href='index.php'" class="btn">Reset</button>
            <?php endif ?>
        </form>
        <div class="btn-tambah">
            <a class="btn" href="tambah_sertifikat.php">Tambah Sertifikat</a>
        </div>
        <?php if (isset($_POST['btnCari'])): ?>
            <div class="clear-both">
                <h2>Cari: <?= $keyword; ?></h2>
                <h2>Terdapat: <?= mysqli_num_rows($sertifikat); ?></h2>
            </div>
        <?php endif ?>
        <div class="table-responsive clear-both">
            <table border="1" cellpadding="10" cellspacing="0">
            	<thead>
            		<tr>
            			<th>No</th>
            			<th>Judul</th>
            			<th>Keterangan</th>
            			<th>Tanggal Diterima</th>
            			<th>Tanggal Kedaluwarsa</th>
                        <th>Jangka Waktu</th>
                        <th>File Sertifikat</th>
            			<th>Nilai</th>
                        <th>Aksi</th>
            		</tr>
            	</thead>
            	<tbody>
            		<?php $i = 1; ?>
            		<?php foreach ($sertifikat as $data_sertifikat): ?>
            			<tr>
            				<td><?= $i++; ?></td>
            				<td><?= $data_sertifikat['judul']; ?></td>
            				<td><?= strip_tags($data_sertifikat['keterangan']); ?></td>
            				<td><?= date("d-m-Y", strtotime($data_sertifikat['tanggal_diterima'])); ?></td>
            				<td>
            					<?php if ($data_sertifikat['tanggal_kedaluwarsa'] == '0000-00-00'): ?>
    	        					Tidak ada Kedaluwarsa	
            					<?php else: ?>
            						<?= date("d-m-Y", strtotime($data_sertifikat['tanggal_kedaluwarsa'])); ?>
            					<?php endif ?>
            				</td>
                            <td>
                                <?php if ($data_sertifikat['tanggal_kedaluwarsa'] == '0000-00-00'): ?>
                                    Tidak ada Kedaluwarsa   
                                <?php else: ?>
                                    <?php 
                                        $tanggal_diterima = new DateTime($data_sertifikat['tanggal_diterima']);
                                        $tanggal_kedaluwarsa = new DateTime($data_sertifikat['tanggal_kedaluwarsa']);
                                        $difference = $tanggal_diterima->diff($tanggal_kedaluwarsa);

                                        echo $difference->format('%a Hari');
                                    ?>
                                <?php endif ?>
                            </td>
                            <td>
                                <a href="file/<?= $data_sertifikat['file_sertifikat']; ?>" target="_blank"><?= $data_sertifikat['file_sertifikat']; ?></a>
                            </td>
                            <td>
                                <?php if ($data_sertifikat['nilai']): ?>
                                    <?= $data_sertifikat['nilai']; ?>
                                <?php else: ?>
                                    -
                                <?php endif ?>
                            </td>
                            <td>
                                <a href="file/<?= $data_sertifikat['file_sertifikat']; ?>" target="_blank" class="btn">Unduh</a>
                                <a href="ubah_sertifikat.php?id_sertifikat=<?= $data_sertifikat['sertifikat_id_sertifikat']; ?>" class="btn">Ubah</a>
                                <a href="hapus_sertifikat.php?id_sertifikat=<?= $data_sertifikat['sertifikat_id_sertifikat']; ?>" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus Sertifikat <?= $data_sertifikat['judul'] ?>?')">Hapus</a>
                            </td>
            			</tr>
            		<?php endforeach ?>
            	</tbody>
            </table>
        </div>
    </div>

</body>
</html>