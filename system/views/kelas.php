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
                <div style="clear: both"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th style="width: 5%;text-align: center">#</th>
                                <th style="">Mata Kuliah</th>
                                <th style="width: 15%;text-align: center">Kelas</th>
                                <th style="">Dosen</th>
                                <th style="width: 15%;text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data->result_array() as $v) {
                                echo "<tr>
                                    <td>" . ( ++$i) . "</td>
                                    <td>$v[matkul]</td>
                                    <td style='text-align:center'>$v[kelas]</td>
                                    <td>$v[dosen]</td>
                                    <td style='text-align:center'>
                                    <a href='" . base_url() . $level . "/addkelas/$v[id_matkul]/$v[id_kelas]' class='btn btn-warning btn-small'><i class='fa icon-pencil'></i></a>
                                    <a href='" . base_url() . $level . "/kelas/$v[id_kelas]' onclick=\"return confirm('Yakin Hapus Data?');\" class='btn btn-danger btn-small'><i class='fa icon-trash'></i></a>
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
