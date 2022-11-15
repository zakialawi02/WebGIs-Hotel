<?= $this->extend('_Layout/_template/_admin/templateAdmin'); ?>


<?= $this->section('content'); ?>

<!-- MAIN ISI -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blank Page</h1>
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

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center"> <img src="/img/user/<?= user()->user_image; ?>" alt="Profile" class="rounded-circle">
                        <h2 class="m-1 mt-2"><?= user()->full_name; ?></h2>

                        <?php if (in_groups('Admin' && 'SuperAdmin')) : ?>
                            <a class="badge bg-secondary"><?= user()->username; ?></a>
                        <?php else : ?>
                            <a class="badge bg-info"><?= user()->username; ?></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>


            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit-data">Edit Data</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>


                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic"><?= user()->user_about; ?></p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="mb-2 row">
                                    <div class="col-lg-3 col-md-4 label ">Username</div>
                                    <div class="col-lg-9 col-md-8"><?= user()->username; ?></div>
                                </div>

                                <div class="mb-2 row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8"><?= user()->full_name; ?></div>
                                </div>

                                <div class="mb-2 row">
                                    <div class="col-lg-3 col-md-4 label ">Email</div>
                                    <div class="col-lg-9 col-md-8"><?= user()->email; ?></div>
                                </div>

                                <div class="mb-2 row">
                                    <div class="col-lg-3 col-md-4 label ">Join at</div>
                                    <div class="col-lg-9 col-md-8"><?= user()->created_at; ?></div>
                                </div>

                            </div>


                            <div class="tab-pane fade pt-3" id="profile-edit-data">
                                <!-- Change my Data -->
                                <form action="/user/UpdateMyData" method="post" enctype="multipart/form-data">


                                    <input type="hidden" class="form-control" for="id" id="id" name="id" value="<?= user()->id; ?>">

                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control" type="text" value="<?= user()->username; ?>" name="username" type="text" class="form-control" id="username" disabled readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="emain" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control" type="text" value="<?= user()->email; ?>" name="email" type="text" class="form-control" id="email" disabled readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="full_name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="full_name" type="text" class="form-control" id="full_name" value="<?= user()->full_name; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="user_about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" name="user_about" id="user_about" rows="3"><?= user()->user_about; ?></textarea>
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </div>
                                </form><!-- End Change my Data -->

                            </div>



                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>


        </div>
    </section>

</main><!-- End #main -->


<?= $this->endSection(); ?>