<div class="page-title">
    <div>
        <h1><i class="icon-file-alt"></i> <?= $title ?></h1>
    </div>
</div>
<div class="row-fluid">
    <div class="box">
        <div class="box-content">
            <?php
            include 'alert.php';
            ?>
            <div class="panel-body">
                <div style="float: right">
                    <a href="<?= base_url() . $level ?>/addmahasiswa" class="btn btn-primary"><i class='fa icon-plus'></i> Tambah Data</a>
                </div>
                <div style="clear: both"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th style="width: 5%;text-align: center">#</th>
                                <th style="width: 15%;text-align: center">NIM</th>
                                <th style="">Nama</th>
                                <th style="width: 20%;text-align: center">Tanggal Lahir</th>
                                <th style="width: 10%;text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data->result_array() as $v) {
                                echo "<tr>
                                    <td>" . ( ++$i) . "</td>
                                    <td style='text-align:center'>$v[nim]</td>
                                    <td>$v[nama]</td>
                                    <td style='text-align:center'>".tgl($v['tgllahir'])."</td>
                                    <td style='text-align:center'>
                                    <a href='" . base_url() . $level . "/addmahasiswa/$v[id_mahasiswa]' class='btn btn-warning btn-small'><i class='fa icon-pencil'></i></a>
                                    <a href='" . base_url() . $level . "/mahasiswa/$v[id_mahasiswa]' onclick=\"return confirm('Yakin Hapus Data?');\" class='btn btn-danger btn-small'><i class='fa icon-trash'></i></a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
