<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
.user-image {
    width: 100%;
    transition: width 0.3s ease; /* Atur durasi dan efek transisi */
}

.sidebar-collapse .user-image {
    width: 30px !important;
}

</style>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="user-profile" style="text-align: center;">
            <div class="pull-left image display-block" >
                <?php
                $d = $this->db->query("SELECT * FROM tbl_login WHERE id_login='$idbo'")->row();
                if (isset($d->foto)) {
                ?>
                    <img src="<?php echo base_url(); ?>assets_style/image/<?php echo $d->foto; ?>" alt="#" class="user-image" style="height:auto; width:25%;" />
                    <?php } else { ?>
                        <i class="fa fa-user fa-4x" style="color:#fff; width:30px;"></i>
                <?php } ?>
            </div>
            <div class="pull-left info" style="margin-top: 10px; margin-left: 60px; font-weight: bold; mix-blend-mode: multiply;">
                <p><?php echo $d->nama; ?> <span><?= $d->level; ?></span></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
		</div>
        <ul class="sidebar-menu" data-widget="tree">
			<?php if($this->session->userdata('level') == 'Petugas'){?>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if($this->uri->uri_string() == 'dashboard'){ echo 'active';}?>">
                <a href="<?php echo base_url('dashboard');?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php if($this->uri->uri_string() == 'user'){ echo 'active';}?>
                <?php if($this->uri->uri_string() == 'user/tambah'){ echo 'active';}?>
                <?php if($this->uri->uri_string() == 'user/edit/'.$this->uri->segment('3')){ echo 'active';}?>">
                <a href="<?php echo base_url('user');?>" class="cursor">
                    <i class="fa fa-user"></i> <span>Data Pengguna</span></a>
			</li>
			<li class="treeview <?php if($this->uri->uri_string() == 'data/kategori'){ echo 'active';}?>
				<?php if($this->uri->uri_string() == 'data/rak'){ echo 'active';}?>
				<?php if($this->uri->uri_string() == 'data'){ echo 'active';}?>
				<?php if($this->uri->uri_string() == 'data/bukutambah'){ echo 'active';}?>
				<?php if($this->uri->uri_string() == 'data/bukudetail/'.$this->uri->segment('3')){ echo 'active';}?>
				<?php if($this->uri->uri_string() == 'data/bukuedit/'.$this->uri->segment('3')){ echo 'active';}?>">
                <a href="#">
                    <i class="fa fa-pencil-square"></i>
                    <span>Data </span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($this->uri->uri_string() == 'data'){ echo 'active';}?>
                        <?php if($this->uri->uri_string() == 'data/bukutambah'){ echo 'active';}?>
                        <?php if($this->uri->uri_string() == 'data/bukudetail/'.$this->uri->segment('3')){ echo 'active';}?>
                        <?php if($this->uri->uri_string() == 'data/bukuedit/'.$this->uri->segment('3')){ echo 'active';}?>">
                        <a href="<?php echo base_url("data");?>" class="cursor">
                            <span class="fa fa-book"></span> Data Buku
                            
                        </a>
                    </li>
                    <li class=" <?php if($this->uri->uri_string() == 'data/kategori'){ echo 'active';}?>">
                        <a href="<?php echo base_url("data/kategori");?>" class="cursor">
                            <span class="fa fa-tags"></span> Kategori
                            
                        </a>
                    </li>
                    <li class=" <?php if($this->uri->uri_string() == 'data/rak'){ echo 'active';}?>">
                        <a href="<?php echo base_url("data/rak");?>" class="cursor">
                            <span class="fa fa-list"></span> Rak
                            
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview 
                <?php if($this->uri->uri_string() == 'transaksi'){ echo 'active';}?>
                <?php if($this->uri->uri_string() == 'transaksi/kembali'){ echo 'active';}?>
                <?php if($this->uri->uri_string() == 'transaksi/pinjam'){ echo 'active';}?>
                <?php if($this->uri->uri_string() == 'transaksi/detailpinjam/'.$this->uri->segment('3')){ echo 'active';}?>
                <?php if($this->uri->uri_string() == 'transaksi/kembalipinjam/'.$this->uri->segment('3')){ echo 'active';}?>">
                <a href="#">
                    <i class="fa fa-exchange"></i>
                    <span>Transaksi</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($this->uri->uri_string() == 'transaksi'){ echo 'active';}?>
                        <?php if($this->uri->uri_string() == 'transaksi/pinjam'){ echo 'active';}?>
                        <?php if($this->uri->uri_string() == 'transaksi/kembalipinjam/'.$this->uri->segment('3')){ echo 'active';}?>">
                        <a href="<?php echo base_url("transaksi");?>" class="cursor">
                            <span class="fa fa-upload"></span> Peminjaman
                            
                        </a>
                    </li>
                    <li class="<?php if($this->uri->uri_string() == 'transaksi/kembali'){ echo 'active';}?>">
                        <a href="<?php echo base_url("transaksi/kembali");?>" class="cursor">
                            <span class="fa fa-download"></span> Pengembalian
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($this->uri->uri_string() == 'transaksi/denda'){ echo 'active';}?>">
                <a href="<?php echo base_url("transaksi/denda");?>" class="cursor">
                    <i class="fa fa-money"></i> <span>Denda</span>
                </a>
            </li>
            <li class="<?php if($this->uri->uri_string() == 'backup'){ echo 'active';}?>">
                <a href="<?php echo base_url('backup/index');?>">
                    <i class="fa fa-hdd-o" aria-hidden="true"></i> <span>Backup</span>
                </a>
            </li>
			<?php }?>
			<?php if($this->session->userdata('level') == 'Anggota'){?>
				<li class="<?php if($this->uri->uri_string() == 'transaksi'){ echo 'active';}?>">
					<a href="<?php echo base_url("transaksi");?>" class="cursor">
						<i class="fa fa-upload"></i> <span>Data Peminjaman </span>
					</a>
				</li>
				<li class="<?php if($this->uri->uri_string() == 'transaksi/kembali'){ echo 'active';}?>">
					<a href="<?php echo base_url("transaksi/kembali");?>" class="cursor">
						<i class="fa fa-upload"></i> <span>Data Pengambilan</span>
					</a>
				</li>
				<li class="<?php if($this->uri->uri_string() == 'data'){ echo 'active';}?>
				<?php if($this->uri->uri_string() == 'data/bukudetail/'.$this->uri->segment('3')){ echo 'active';}?>">
					<a href="<?php echo base_url("data");?>" class="cursor">
						<i class="fa fa-search"></i>  <span>Cari Buku</span>
					</a>
				</li>
				<li class="<?php if($this->uri->uri_string() == 'user/edit/'.$this->uri->segment('3')){ echo 'active';}?>">
					<a href="<?php echo base_url('user/edit/'.$this->session->userdata('ses_id'));?>" class="cursor">
						<i class="fa fa-user"></i>  <span>Data Anggota</span>
					</a>
				</li>
				<li class="">
					<a href="<?php echo base_url('user/detail/'.$this->session->userdata('ses_id'));?>" target="_blank" class="cursor">
						<i class="fa fa-print"></i> <span>Cetak kartu Anggota</span>
					</a>
				</li>
			<?php }?>
        </ul>
        <div class="clearfix"></div>
        <br/>
        <br/>
    </section>
    <!-- /.sidebar -->
  </aside>
