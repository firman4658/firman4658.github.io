<?php
$aksi = "module/admin/aksi_admin.php";

switch ($_GET['act']) {

	default:
		// Tampil Data - mengambil file adminshow.php
		echo "<a href='?module=admin&act=tambahuser' class='nav-link text-black'><i class='fa fa-plus-circle fa-lg' ></i> Tambah</a>
		 <table align='left' cellpadding='5px'  class='table table-striped jambo_table bulk_action table-bordered cellspacing='0' width='130%'>
		 <thead>
			<tr>
				<th>NO</th> <th>Username</th> <th>Nama Lengkap</th> <th>Password</th> <th>Foto</th> <th>Aksi</th>
			</tr></thead>";
		$no = 0;

		$data = mysqli_query($konek, "SELECT * FROM admin");
		while ($r = mysqli_fetch_array($data)) {
			$no++;
			echo "<tr>
				<td>$no</td> <td>$r[username]</td> <td>$r[nm_lengkap]</td> <td>$r[password]</td> <td><img src=build/images/dokter/$r[foto] width= 80px></td> 
				<td> 
					<a href='?module=admin&act=edituser&id=$r[username]' onclick='return confirm('Hapus Data Ini ?');' > <i class='fa fa-pencil-square-o fa-2x' aria-hidden='true' onclick = 'return confirm('Yakin Data Akan Dihapus');'></i> </a> | 
					<a href='$aksi?module=admin&act=hapus&id=$r[username]'> <i class='fa fa-trash-o fa-2x' aria-hidden='true'></i> </a>
				</td>
			</tr>";
		}
		echo "</table>";
		break;
		// Tambah Data - memanggil file adminfm.php
	case "tambahuser":
		echo "<form action='$aksi?module=admin&act=input' method='POST'>
			<table class='table table-striped table-bordered'>
				<tr>
					<td>Username</td> <td><input class='form-control' type=text name=username></td>
				</tr>
				<tr>
					<td>Nama Lengkap</td> <td><input  class='form-control' type=text name=nm_lengkap></td>
				</tr>
				<tr>
					<td>Password</td> <td><input class='form-control' type=password name=password></td>
				</tr>
				<tr>
					<td>Foto</td> <td> <input  class='btn btn-default' type=file name=foto> 
				</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input class='btn btn-success' type=submit name=simpan value='Kirim'>
						<input class='btn btn-danger' type=reset name=batal value='Batal'>
					</td>
				</tr>
			</table>
		</form>";
		break;

		// Edit Data - memanggil file admineditfm.php
	case "edituser":

		$data = mysqli_query($konek, "SELECT * FROM admin where username='$_GET[id]'");
		$r = mysqli_fetch_array($data);

		echo "<form action='$aksi?module=admin&act=update' method='POST'>
			<table class='table table-striped table-bordered'>
				<tr>
					<td>Username</td> 
					<td>
						<input  class='form-control' type=text name=username value='$r[username]' disabled>
						<input  class='form-control' type=hidden name='idh' value='$r[username]'>
					</td>
				</tr>
				<tr>
				<td>Nama Lengkap</td> <td><input  class='form-control' type=text name=nm_lengkap value=$r[nm_lengkap]></td>
			</tr>
			<tr>
				<td>Password</td> <td><input class='form-control' type=password name=password value=$r[password]></td>
			</tr>
			<tr>
				<td>Foto</td> <td> <input  class='btn btn-default' type=file name=foto> 
			</td>
			</tr>
				<tr>
					<td></td> 
					<td>
						<input type=submit class='btn btn-success' name=simpan value='Update'>
						<input type=reset class='btn btn-danger' name=batal value='Batal'>
					</td>
				</tr>
			</table>
		</form>";
		break;
}
