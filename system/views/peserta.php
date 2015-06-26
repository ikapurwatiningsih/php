<div class="page-title">
    <div>
        <h1><i class="icon-file-alt"></i> <?= $title ?></h1>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3><i class="icon-reorder"></i></h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form role="form" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Kelas</label>
                        <div class="controls">
                            <select name="kelas" class="select2 span4">
                                <?php
                                foreach ($kelas->result_array() as $v) {
                                    echo "<option value='$v[id_kelas]' " . ($v['id_kelas'] == $id_kelas ? "selected" : "") . ">$v[matkul] - $v[kelas]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-info"><i class="icon icon-search"></i> Lihat Peserta</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($data)) {
                    ?>
                    <hr>
                    <?php
                    include 'alert.php';
                    ?>
                    <div style="float: right">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambahPeserta">
                            <i class='fa icon-plus'></i> Tambah Peserta
                        </button>
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
                                    <td style='text-align:center'>" . tgl($v['tgllahir']) . "</td>
                                    <td style='text-align:center'>
                                    <a href='javascript:hapus($v[id_mahasiswa])' onclick=\"return confirm('Hapus dari peserta kelas?');\" class='btn btn-danger btn-small'><i class='fa icon-trash'></i></a>
                                    </td>
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function hapus(id) {
            var f = '<form method="post"><input type=hidden name=kelas value="<?= $id_kelas ?>"><input type=hidden name=hapus value="' + id + '"></form>';
            $('body').append(f);
            $(f).submit();
        }
    </script>
    <form method="post">
        <div class="modal fade" id="tambahPeserta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Tambah Peserta Kelas</h4>
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <label class="control-label">Nama Mahasiswa</label>
                            <div class="controls">
                                <select name="peserta[]" multiple="" class="multipleselect span12">
                                    <?php
                                    if(isset($mahasiswa)){
                                        foreach ($mahasiswa->result_array() as $v) {
                                            echo "<option value='$v[id_mahasiswa]'>$v[nim] - $v[nama]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="kelas" value="<?= $id_kelas ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>