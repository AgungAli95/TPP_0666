<?php
session_start();
include "template/header.php";
include "template/footer.php";
?>
 	 	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="signup-form" ><!--sign up form-->
						<h2>PROFIL MEMBER</h2>
						<?php 
						$idMember = $_SESSION['idMember'];
						$queryGetProfilmember = mysqli_query($koneksi,"SELECT * FROM tbl_customer WHERE id_customer = '$idCustomer'");
						$res = mysqli_fetch_array($queryGetProfilmember);
						?>
						<form action="aksi_edit_member.php" method="POST">
							<!--<input type="text" placeholder="username" name="id_member" value="<?php echo $res['id_member'];?>"  hidden />-->
							<input  type="text" placeholder="username" name="username" value="<?php echo $res['username'];?> " />
							<input  type="password" placeholder="password" name="password" value="<?php echo $res['password'];?> " />
							<input type="text" placeholder="Nama Lengkap" name="nama" value="<?php echo $res['nama'];?>" />
							<input type="text" placeholder="Alamat" name="alamat" value="<?php echo $res['alamat'];?>" />
							<select name="idKota">
								<?php  
									$getKota = mysqli_query($koneksi,"SELECT * FROM tbl_customer INNER JOIN tbl_kota WHERE tbl_customer.id_kota=tbl_kota.id_kota AND tbl_member.id_customer='$idCustomer' ");
									while ($itemKota=mysqli_fetch_array($getKota)) {
										?>
										<option value="<?php echo $itemKota['id_kota']?>"><?php echo $itemKota['nama_kota'] ?></option>
									<?php } ?>
							</select>
							<hr>
							<input type="email" name="email" placeholder="Email" value="<?php echo $res['email']; ?>" />
							<input type="text" name="hp" placeholder="Nomor Handphone" value="<?php echo $res['no_hp'];?>" />
							<button type="submit" class="btn btn-default">edit member</a></button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

