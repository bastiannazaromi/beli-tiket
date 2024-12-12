<div class="container mt-4">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Judul Film</th>
							<th>Cinema</th>
							<th>Jadwal Tayang</th>
							<th>No. Kursi</th>
							<th>Jumlah</th>
							<th>Harga</th>
							<th>Total Harga</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($order as $data) : ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->judul; ?></td>
								<td><?= $data->namaCinema; ?></td>
								<td><?= date('d M Y', strtotime($data->tanggal)) . ' - ' . date('H:i', strtotime($data->jamTayang)) . ' WIB'; ?></td>
								<td><?= $data->no_kursi; ?></td>
								<td><?= $data->jumlah; ?></td>
								<td><?= 'Rp. 40.000'; ?></td>
								<td><?= 'Rp. ' . number_format($data->harga, 0, ',', '.'); ?></td>
								<td>
									<div class="btn-group">
										<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit" data-id="<?= $data->id; ?>" data-jumlah="<?= $data->jumlah; ?>" data-no_kursi="<?= $data->no_kursi; ?>" title="Edit Data"><i class="fas fa-edit"></i></a>
										<a href="<?= base_url('order/delete/' . $data->id); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin data akan dihapus?')" title="Hapus Data"><i class="fas fa-trash"></i></a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>