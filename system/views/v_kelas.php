<div class="page-title">
    <div>
        <h1><i class="icon-file-alt"></i> <?= $title ?></h1>
    </div>
</div>
<div class="row-fluid">
    <div class="box">
        <div class="box-content">
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
                                    <a href='javascript:mahasiswa($v[id_kelas])' class='btn btn-primary btn-small'><i class='fa icon-search'></i> MAHASISWA</a>
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
<script type="text/javascript">
    function mahasiswa(id) {
        $.get('<?= base_url() ?>service/mahasiswa/' + id, function (data, status) {
            $('#mahasiswa').html(data);
        });
        $('#dataPeserta').modal('show');
    }
</script>
<div class="modal fade" id="dataPeserta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Data Peserta Kelas</h4>
            </div>
            <div class="modal-body">
                <table style="width: 100%" class="table table-striped table-bordered table-hover">
                    <thead>
                    <th style="width: 30%">NIM</th>
                    <th>Nama</th>
                    </thead>
                    <tbody id="mahasiswa"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>