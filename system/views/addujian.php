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
                <form action="<?= base_url()."$level/$status" ?>" role="form" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Tanggal</label>
                        <div class="controls">
                            <input type="text" name="tgl" required="" value="<?=date('Y-m-d')?>" class="date-picker form-control span4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Matakuliah</label>
                        <div class="controls">
                            <select id="matkul" class="select2 span4" onchange="updatekelas()">
                                <?php
                                foreach ($matkul->result_array() as $v) {
                                    echo "<option value='$v[id_matkul]'>$v[kode] - $v[nama]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Kelas</label>
                        <div class="controls">
                            <select name="id_kelas" required=""></select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Waktu</label>
                        <div class="controls">
                            <input type="text" name="jam" class="timepicker-24 span2" required="">    
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Lokasi</label>
                        <div class="controls">
                            <select name="id_ruang" required="" class="select2 span4">
                                <?php
                                foreach ($ruang->result_array() as $v) {
                                    echo "<option value='$v[id_ruang]'>$v[ruang]</option>";
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
<script type="text/javascript">
function updatekelas(){
    var id=$('#matkul').val();
    $.get('<?=base_url()?>service/kelas/' + id, function (data, status) {
        $('select[name=id_kelas]').html(data);
    });
}
$(function(){
    updatekelas();
});
</script>