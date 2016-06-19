<nav class="blue-grey darken-1">

    <!-- Menu on medium and small screen START -->
    <ul id="slide-out" class="side-nav" data-simplebar-direction="vertical">
        <li class="no-padding fixed">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">account_circle</i> Administrator</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="profil.php">Profil</a></li>
                            <li><a href="edit_user.php">Ubah Password</a></li>
                            <li><a href="./">Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li><a href="admin.php"><i class="material-icons middle">dashboard</i> Beranda</a></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">repeat</i> Transaksi Surat</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="transaksi_surat_masuk.php">Surat Masuk</a></li>
                            <li><a href="transaksi_surat_keluar.php">Surat Keluar</a></li>
                        </ul>
                    </div>
               </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">book</i> Buku Agenda</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="agenda_surat_masuk.php">Surat Masuk</a></li>
                            <li><a href="agenda_surat_keluar.php">Surat Keluar</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
             <ul class="collapsible collapsible-accordion">
               <li>
                 <a class="collapsible-header"><i class="material-icons">description</i> Buat Surat Baru</a>
                 <div class="collapsible-body">
                   <ul>
                     <li><a href="buat_surat_edaran.php">Surat Edaran</a></li>
                     <li><a href="buat_surat_tugas.php">Surat Tugas</a></li>
                     <li><a href="buat_surat_keterangan.php">Surat Keterangan</a></li>
                     <li><a href="buat_surat_keputusan.php">Surat Keputusan</a></li>
                   </ul>
                 </div>
               </li>
             </ul>
           </li>
           <li><a href="klasifikasi.php"><i class="material-icons middle">bookmark</i> Referensi</a></li>
           <li><a href="klasifikasi.php"><i class="material-icons middle">people</i> Data Guru</a></li>
           <li class="no-padding">
             <ul class="collapsible collapsible-accordion">
               <li>
                 <a class="collapsible-header"><i class="material-icons">settings</i> Pengaturan</a>
                 <div class="collapsible-body">
                   <ul>
                     <li><a href="instansi.php">Instansi</a></li>
                     <li><a href="user.php">User</a></li>
                    <!-- <li><a href="backup_data.php">Backup Data</a></li>
                     <li><a href="restore_data.php">Restore Data</a></li> -->
                   </ul>
                 </div>
               </li>
             </ul>
           </li>
         </ul>
         <!-- Menu on medium and small screen END -->

         <!-- Menu on large screen START -->
         <ul class="center hide-on-med-and-down">
           <li><a href="admin.php"><i class="material-icons">dashboard</i>&nbsp; Beranda</a></li>
           <li><a class="dropdown-button" href="#!" data-activates="transaksi">Transaksi Surat <i class="material-icons md-18">arrow_drop_down</i></a></li>
           <ul id='transaksi' class='dropdown-content'>
             <li><a href="transaksi_surat_masuk.php">Surat Masuk</a></li>
             <li><a href="transaksi_surat_keluar.php">Surat Keluar</a></li>
           </ul>
           <li><a class="dropdown-button" href="#!" data-activates="agenda">Buku Agenda <i class="material-icons md-18">arrow_drop_down</i></a></li>
           <ul id='agenda' class='dropdown-content'>
             <li><a href="agenda_surat_masuk.php">Surat Masuk</a></li>
             <li><a href="agenda_surat_keluar.php">Surat Keluar</a></li>
           </ul>
           <li><a class="dropdown-button" href="#!" data-activates="buat_surat">Buat Surat Baru<i class="material-icons md-18">arrow_drop_down</i></a></li>
           <ul id='buat_surat' class='dropdown-content'>
             <li><a href="buat_surat_edaran.php">Surat Edaran</a></li>
             <li><a href="buat_surat_tugas.php">Surat Tugas</a></li>
             <li><a href="buat_surat_keterangan.php">Surat Keterangan</a></li>
             <li><a href="buat_surat_keputusan.php">Surat Keputusan</a></li>
           </ul>
           <li><a href="./klasifikasi.php">Referensi</a></li>
           <li><a href="./klasifikasi.php">Data Guru</a></li>
           <li><a class="dropdown-button" href="#!" data-activates="pengaturan">Pengaturan <i class="material-icons md-18">arrow_drop_down</i></a></li>
           <ul id='pengaturan' class='dropdown-content'>
             <li><a href="instansi.php">Instansi</a></li>
             <li><a href="user.php">User</a></li>
           </ul>
           <li class="right"><a class="dropdown-button" href="#!" data-activates="logout"><i class="material-icons">account_circle</i> Administrator <i class="material-icons md-18">arrow_drop_down</i></a></li>
           <ul id='logout' class='dropdown-content'>
             <li><a href="profil.php">Profil</a></li>
             <li><a href="edit_user.php">Ubah Password</a></li>
             <li class="divider"></li>
             <li><a href="./"><i class="material-icons">settings_power</i> Logout</a></li>
           </ul>
         </ul>
         <!-- Menu on large screen END -->

         <a href="#" data-activates="slide-out" class="button-collapse" id="menu"><i class="material-icons">menu</i></a>
</nav>