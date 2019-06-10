<div class="container">
<div class="row">
		
    <div class="col-md-8">
    <h2>Detail Customer</h2>
            <div class=" col-md-9 col-lg-9 ">
        <table class="table table-user-information">
            <tbody>
                <tr>
                    <td>Kode Customer :</td>
                    <td><?= $detail['kd_cst']; ?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?= $detail['nama']; ?></td>
                </tr>
                <tr>
                    <td>KTP :</td>
                    <td><?= $detail['no_ktp']; ?></td>
                </tr>
                <tr>
                    <tr>
                        <td>Alamat :</td>
                        <td><?= $detail['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><a href="mailto:<?= $detail['email']; ?>"><?= $detail['email']; ?></a></td>
                    </tr>
                    <td>Phone Number :</td>
                    <td><?= $detail['telp']; ?></td>                    
                </tr>
                    <tr>
                        <td>Dibuat :</td>
                        <td><?= $detail['date_created']; ?></td>
                    </tr>
                    <tr>                        
                        <td><a href="<?= base_url('customer'); ?>" class="btn btn-success">Kembali</a></td>
                    </tr>
            </tbody>
        </table>
    </div>
	</div>
</div>