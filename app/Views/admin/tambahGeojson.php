<?= $this->extend('_Layout/_template/_admin/templateAdmin'); ?>


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
                    <h3 class="card-title">Tambah Data</h3>

                    <form class="row g-3" action="/admin/tambah_Geojson" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label for="kodeG" class="form-label">Kode Wilayah</label>
                            <input type="text" class="form-control" id="kodeG" aria-describedby="textlHelp" name="kodeG">
                        </div>
                        <div class="mb-3">
                            <label for="Nkec" class="form-label">Nama Wilayah</label>
                            <input type="text" class="form-control" id="Nkec" aria-describedby="textlHelp" name="Nkec">
                        </div>
                        <div class="col-md-10">
                            <label for="formFile" class="form-label">Upload File GeoJSON</label>
                            <input class="form-control" type="file" name="Fjson" id="Fjson" accept=".geojson, .json">
                            <div id="FileHelp" class="form-text">.GeoJSON</div>
                        </div>
                        <div class="col-md-2">
                            <label for="exampleColorInput" class="form-label">Color</label>
                            <input type="color" class="form-control form-control-color" name="Kwarna" id="Kwarna" value="#4383F0" title="Choose your color">
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>


        </div>
        </div>
    </section>

</main><!-- End #main -->


<?= $this->endSection(); ?>