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
                    <a href="<?= base_url() . $level ?>/addujian/uts" class="btn btn-primary"><i class='fa icon-plus'></i> Entry Jadwal UTS</a>
                </div>
                <div style="clear: both"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 7%">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 8%">
                        </colgroup>
                        <tbody>
                            <?php
                            $temp = "";
                            foreach ($data->result_array() as $v) {
                                if ($temp != $v['tgl']) {
                                    echo "<tr>
                                    <td style='text-align:left' colspan='6'><h4>" . tgl($v['tgl']) . "</h4></td>
                                    </tr>";
                                    $temp = $v['tgl'];
                                }
                                echo "<tr>
                                        <td style='text-align:center'>$v[jam]</td>
                                        <td>$v[matkul]</td>
                                        <td style='text-align:center'>$v[kelas]</td>
                                        <td>$v[dosen]</td>
                                        <td>$v[ruang]</td>
                                        <td style='text-align:center'>
                                        <a href='" . base_url() . $level . "/uts/$v[id_ujian]' onclick=\"return confirm('Yakin Hapus Data?');\" class='btn btn-danger btn-small'><i class='fa icon-trash'></i></a>
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
