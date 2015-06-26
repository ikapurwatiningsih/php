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
                    <table class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 7%">
                            <col style="width: 15%">
                            <col style="width: 15%">
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
