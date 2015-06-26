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
                <?php
                include 'alert.php';
                ?>
                <form action="<?= base_url().$level?>/user" role="form" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Realname</label>
                        <div class="controls">
                            <input type="text" name="realname" required="" <?=$nonaktiv?> value="<?= $realname ?>" class="form-control span8">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Username</label>
                        <div class="controls"><input type="text" name="username" <?=$nonaktiv?> required="" value="<?= $username ?>" class="form-control span4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Current Password</label>
                        <div class="controls"><input type="password" name="password" required="" value="" class="form-control span4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">New Password</label>
                        <div class="controls"><input type="password" name="password1" value="" class="form-control span4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Confirm Password</label>
                        <div class="controls"><input type="password" name="password2" value="" class="form-control span4">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>