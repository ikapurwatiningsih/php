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
                <form action="<?= base_url()."$level" ?>/matkul" role="form" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Kode</label>
                        <div class="controls"><input type="text" name="kode" required="" maxlength="6" value="<?= $kode ?>" class="form-control span4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Matakuliah</label>
                        <div class="controls">
                            <input type="text" name="nama" required="" value="<?= $nama ?>" class="form-control span8">
                            <input type="hidden" name="id_matkul" value="<?= $id_matkul ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">SKS</label>
                        <div class="controls"><input type="number" name="sks" required="" value="<?=$sks?>" min="1" class="form-control span4">
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