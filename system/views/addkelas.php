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
                <form action="<?= base_url()."$level" ?>/kelas" role="form" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Matakuliah</label>
                        <div class="controls">
                            <input type="text" disabled="" value="<?= "$mk[kode]-$mk[nama]" ?>" class="form-control span5">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Kelas</label>
                        <div class="controls">
                            <input type="text" name="kelas" maxlength="10" required="" value="<?= $kelas ?>" class="form-control span4">
                            <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                            <input type="hidden" name="id_matkul" value="<?= $id_matkul ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Dosen</label>
                        <div class="controls">
                            <select name="dosen[]" multiple="" class="multipleselect span7">
                                <?php
                                foreach ($dosen->result_array() as $v) {
                                    echo "<option value='$v[id_dosen]' ".(in_array($v['id_dosen'], $id_dosen)?"selected":"").">$v[nip] - $v[nama]</option>";
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="javascript:window.history.back()" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>