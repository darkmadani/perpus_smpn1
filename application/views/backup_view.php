<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-edit" style="color:green"></i> <?= $title_web; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Backup</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Menampilkan pesan jika ada -->
        <?php if (isset($message)) { ?>
            <div class="alert alert-info mb-4">
                <?= $message; ?>
            </div>
        <?php } ?>

        <!-- Tombol untuk memulai backup -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Backup Database</h3>
            </div>
            <div class="box-body">
                <!-- Form Backup Manual -->
                <div class="mb-1">
                    <form action="<?= site_url('backup/manual_backup'); ?>" method="post">
                        <button type="submit" class="btn btn-success btn-lg w-20" style="margin-bottom: 15px;" name="backup" value="true">
                            <i class="fa fa-database"></i> Backup Database Via Manual
                        </button>
                    </form>
                </div>

                <!-- Form Backup Google Drive -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
