<?php
function tgl($tgl) {
    $tgl=explode("-", $tgl);
    return "$tgl[2]/$tgl[1]/$tgl[0]";
}
$title = isset($title)?$title . " | " . $this->config->item('title'):$this->config->item('title');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/normalize/normalize.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/bootstrap-timepicker/timepicker.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/bootstrap-datepicker/css/datepicker.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/flaty.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/flaty-responsive.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/select/select2.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/css/chosen.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
        <script src="<?= base_url() ?>assets/bootstrap/modernizr/modernizr-2.6.2.min.js"></script>
        <style>
            .dataTables_filter{
                float : right;
            }
        </style>
        <script>window.jQuery || document.write('<script src="<?= base_url() ?>assets/bootstrap/jquery/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/nicescroll/jquery.nicescroll.min.js"></script>
        <!--page specific plugin scripts-->
        <script src="<?= base_url() ?>assets/js/select/select2.min.js"></script>
        <script src="<?= base_url() ?>assets/js/chosen.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/bootstrap-timepicker/timepicker.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.resize.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.pie.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.stack.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.crosshair.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/bootstrap-switch/static/js/bootstrap-switch.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/bootstrap-daterangepicker/date.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/data-tables/DT_bootstrap.js"></script>
    </head>
    <body class="skin-blue">
        <div id="navbar" class="navbar navbar-fixed">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN Brand -->
                    <a href="<?= base_url() ?>" class="brand">
                        <small style="font-weight: bold">
                            <i class="icon-calendar"></i>
                            SISTEM PENJADWALAN
                        </small>
                    </a>
                    <a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                    <ul class="nav flaty-nav pull-right">
                        <li class="user-profile">
                            <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                                <span class="hidden-phone" id="user_info">
                                    <?= $this->session->userdata('real_name'); ?>
                                </span>
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                                <li class="nav-header">
                                    <i class="icon-time"></i>
                                    Logined From <?= $this->session->userdata('user_time'); ?>
                                </li>
                                <?php
                                if($level=='admin'){
                                ?>
                                <li>
                                    <a href="<?= base_url() . "$level" ?>/settings">
                                        <i class="icon-cogs"></i>
                                        Account Settings
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                                <li>
                                    <a href="<?= base_url() ?>gateway/logout">
                                        <i class="icon-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid skin-black" id="main-container">
            <?php
            if ($this->session->userdata('sidebar') == "show") {
                $sidebar = array("", "left");
            } else {
                $sidebar = array("sidebar-collapsed", "right");
            }
            ?>
            <div id="sidebar" class="nav-collapse <?= $sidebar[0] ?> sidebar-fixed">
                <?php
                $menu['level'] = $level;
                $this->load->view($level . "/sidebar", $menu);
                ?>
                <div id="sidebar-collapse" class="visible-desktop">
                    <i onclick="sidebar()" class="icon-double-angle-left"></i>
                </div>
            </div>
            <div id="main-content" style="min-height: 750px">
                <?php $this->load->view("$content_name", $content_data); ?>
                <footer>
                    <p>UMJ &copy 2015</p>
                </footer>
                <a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        if($(".select2").length>0){
            $(".select2").select2();
        }
        if ($(".multipleselect").length > 0) {
            $('.multipleselect').chosen();
        }
    });
    function sidebar() {
        $.get('<?= base_url() . "service/sidebar" ?>', function (data, status) {});
    }
</script>
<script src="<?= base_url() ?>assets/js/flaty.js"></script>
</body>
</html>