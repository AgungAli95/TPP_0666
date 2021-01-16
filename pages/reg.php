        <div class="login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10">    
                        <div class="register-form">
                            <div class="row">
                                <div class="col-md-6">
                                  <form action="aksi_daftar.php" method="POST">
                                    <label>Username</label>
                                    <input type="form-control" type="text" name="username" placeholder="Username" />
                                </div>
                                <div class="col-md-6">
                                    <label>Password"</label>
                                    <input type="form-control" type="text" name="password" placeholder="Password" />
                                </div>
                                <div class="col-md-6">
                                    <label>Nama</label>
                                    <input type="form-control" type="text" name="nama" placeholder="Nama" />
                                </div>
                                <div class="col-md-6">
                                    <label>Alamat</label>
                                    <input  type="text" name="alamat" placeholder="Alamat" />
                                </div>
                                <div class="col-md-6">
                                    <label>Kota</label>
                                     <select type="form-control" name="idkota">
                              <?php
                              $getKota = mysqli_query($koneksi, "SELECT * FROM tbl_kota");
                              while ($itemKota = mysqli_fetch_array($getKota)) {
                              ?>
                               <option value="<?php echo $itemKota['id_kota'] ?>"><?php echo $itemKota['nama_kota'] ?></option>

                              <?php } ?>
                          </select>
                           <hr>
                                <div class="col-md-6">
                                    <label>email</label>
                                   <input type="form-control" type="email" name="email" placeholder="Email" />
                                </div>
                        <div class="col-md-6">
                                    <label>Nomor Handphone</label>
                                      <input type="form-control" type="text" name="hp" placeholder="Nomer Handphone" />
                                </div>
                                <div class="col-md-12">
                                    <button class="btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login End -->
        