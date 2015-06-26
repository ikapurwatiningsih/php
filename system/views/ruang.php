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
                    <a href="javascript:addruang()" class="btn btn-primary"><i class='fa icon-plus'></i> Tambah Data</a>
                </div>
                <div style="clear: both"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th style="width: 5%;text-align: center">#</th>
                                <th style="">Nama Ruangan</th>
                                <th style="width: 15%;text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data->result_array() as $v) {
                                echo "<tr>
                                    <td>" . ( ++$i) . "</td>
                                    <td>$v[ruang]</td>
                                    <td style='text-align:center'>
                                    <a href='javascript:addruang($v[id_ruang])' class='btn btn-warning btn-small'><i class='fa icon-pencil'></i></a>
                                    <a href='" . base_url() . $level . "/ruang/$v[id_ruang]' onclick=\"return confirm('Yakin Hapus Data?');\" class='btn btn-danger btn-small'><i class='fa icon-trash'></i></a>
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
    function addruang(id){
        if(id==undefined){
            $(".modal-title").html('Entry Data Ruangan');
                $('input[name=id_ruang]').val("");
                $('input[name=ruang]').val("");
        }else{
            $(".modal-title").html('Update Data Ruangan');            
            $.get('<?=base_url()?>service/ruang/' + id, function (data, status) {
                obj = JSON.parse(data);
                $('input[name=id_ruang]').val(obj.id_ruang);
                $('input[name=ruang]').val(obj.ruang);
            });
        }
        $('#detail').modal('show');
    }
</script>
<form method="post">
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Nama Ruangan</label>
                        <div class="controls">
                            <input type="hidden" name="id_ruang">
                            <input type="text" name="ruang" required="" maxlength="20" value="" class="form-control span4">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
