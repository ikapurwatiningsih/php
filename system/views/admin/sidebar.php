<ul class="nav nav-list">
    <li class="<?=$home?>">
        <a href="<?= base_url() . $level ?>">
            <i class="icon-home"></i>
            <span>Home</span>
        </a>
    </li>
    <li class="<?=$master?>">
        <a href="#" class="dropdown-toggle">
            <i class="icon-cog"></i>
            <span>Data Master</span>
            <b class="arrow icon-angle-right"></b>
        </a>
        <ul class="submenu">
            <li class="<?=$dosen?>"><a href="<?= base_url() . $level ?>/dosen">Data Dosen</a></li>
            <li class="<?=$matkul?>"><a href="<?= base_url() . $level ?>/matkul">Data Matakuliah</a></li>
            <li class="<?=$mahasiswa?>"><a href="<?= base_url() . $level ?>/mahasiswa">Data Mahasiswa</a></li>  
            <li class="<?=$ruang?>"><a href="<?= base_url() . $level ?>/ruang">Data Ruangan</a></li>
        </ul>
    </li>
    <li class="<?=$kls?>">
        <a href="#" class="dropdown-toggle">
            <i class="icon-bookmark-empty"></i>
            <span>Data Kelas</span>
            <b class="arrow icon-angle-right"></b>
        </a>
        <ul class="submenu">
            <li class="<?=$datakelas?>"><a href="<?= base_url() . $level ?>/kelas">Data Kelas</a></li>
            <li class="<?=$peserta?>"><a href="<?= base_url() . $level ?>/peserta">Peserta Kelas</a></li>
        </ul>
    </li>
    <li class="<?=$jadwal?>">
        <a href="#" class="dropdown-toggle">
            <i class="icon-bullhorn"></i>
            <span>Data Jadwal</span>
            <b class="arrow icon-angle-right"></b>
        </a>
        <ul class="submenu">
            <li class="<?=$kuliah?>"><a href="<?= base_url() . $level ?>/kuliah">Perkuliahan</a></li>
            <li class="<?=$uts?>"><a href="<?= base_url() . $level ?>/uts">UTS</a></li>
            <li class="<?=$uas?>"><a href="<?= base_url() . $level ?>/uas">UAS</a></li>
        </ul>
    </li>
</ul>