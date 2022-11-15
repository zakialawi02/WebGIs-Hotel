<?= $this->extend('_Layout/_template/_admin/templateSettingMap'); ?>


<?= $this->section('content'); ?>

<!-- MAIN ISI -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Blank</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">

                <div class="card-body">
                    <div class="card-title"></div>
                    <?php if (session()->getFlashdata('alert')) : ?>
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('alert'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($tampilData as $D) : ?>

                        <form class="row g-3" action="/admin/UpdateSetting" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>

                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">Website Name</label>
                                <input type="text" class="form-control" name="nama_web" value="<?= $D->nama_web; ?>" id="inputAddress2" placeholder="site name">
                            </div>
                            <div class="col-md-8">
                                <label for="inputAddress2" class="form-label">Coordinate</label>
                                <input type="text" class="form-control" name="coordinat_wilayah" value="<?= $D->coordinat_wilayah; ?>" id="inputAddress2" placeholder="Latitude, Longitude">
                                <div id="passwordHelpBlock" class="form-text">
                                    example: -7.0385384, 112.8998345
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress2" class="form-label">Zoom</label>
                                <input type="number" min="1" max="20" class="form-control" name="zoom_view" id="inputAddress2" value="<?= $D->zoom_view; ?>">
                                <div id="passwordHelpBlock" class="form-text">
                                    min: 1, Max: 20
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    <?php endforeach ?>
                </div>
            </div>

            <div class="card card-title">

                <div class="card-body">
                    <div class="map" id="map"></div>
                </div>
            </div>



        </div>
        </div>
    </section>

</main><!-- End #main -->


<?= $this->endSection(); ?>