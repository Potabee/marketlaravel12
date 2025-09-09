@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')
    <h1>Data Barang</h1>
@stop

@section('content')

    <body>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button id="tambahbarang" type="button" class="btn btn-primary">
                Tambah Data Barang
            </button>

            <select id="filter_kategori" class="form-control" style="width:500px; text-align: center">
                <option value="" style="text-align: center">-- Semua Kategori --</option>
                @foreach ($kategoribarang as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->kategoribarang }}</option>
                @endforeach
            </select>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="databarang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori Barang</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual 1</th>
                            <th>Harga Jual 2</th>
                            <th>Harga Jual 3</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
            </div>
        </div>
        <div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog"
            aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formTambahBarang">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kodebarang">Kode Barang</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="kodebarang" name="kodebarang"
                                        placeholder="Isi manual atau centang untuk generate otomatis" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="cek_auto_kode">
                                        </div>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Centang jika ingin generate otomatis
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="namabarang">Nama Barang</label>
                                <input type="text" class="form-control" id="namabarang" name="namabarang"
                                    placeholder="Masukkan nama barang" required>
                            </div>
                            <div class="form-group">
                                <label for="katbarang_id">Kategori Barang</label>
                                <select class="form-control" id="kategori_id" name="kategori_id" required>

                                    <option value="" disabled selected>-- Pilih Kategori Barang --</option>
                                    @foreach ($kategoribarang as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategoribarang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan"
                                    placeholder="Masukkan satuan barang" required>
                            </div>
                            <div class="form-group">
                                <label for="hargabeli">Harga Beli</label>
                                <input type="number" class="form-control" id="hargabeli" name="hargabeli"
                                    placeholder="Masukkan harga beli" required>
                            </div>
                            <div class="form-group">
                                <label for="hargajual1">Harga Jual 1</label>
                                <input type="number" class="form-control" id="hargajual1" name="hargajual1"
                                    placeholder="Masukkan harga jual 1" required>
                            </div>
                            <div class="form-group">
                                <label for="hargajual2">Harga Jual 2</label>
                                <input type="number" class="form-control" id="hargajual2" name="hargajual2"
                                    placeholder="Masukkan harga jual 2" required>
                            </div>
                            <div class="form-group">
                                <label for="hargajual3">Harga Jual 3</label>
                                <input type="number" class="form-control" id="hargajual3" name="hargajual3"
                                    placeholder="Masukkan harga jual 3" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEditBarang" tabindex="-1" role="dialog"
            aria-labelledby="modalEditBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document"> <!-- sama-sama lebar XL -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditBarangLabel">Edit Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEditBarang">
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id"> <!-- ID barang untuk update -->

                            <div class="form-group">
                                <label for="edit_kodebarang">Kode Barang</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="edit_kodebarang" name="kodebarang"
                                        readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="cek_edit_kodebarang">
                                        </div>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Centang untuk mengedit kode barang</small>
                            </div>


                            <div class="form-group">
                                <label for="edit_namabarang">Nama Barang</label>
                                <input type="text" class="form-control" id="edit_namabarang" name="namabarang"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_kategori_id">Kategori Barang</label>
                                <select class="form-control" id="edit_kategori_id" name="kategori_id" required>
                                    <option value="" disabled>-- Pilih Kategori Barang --</option>
                                    @foreach ($kategoribarang as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategoribarang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_satuan">Satuan</label>
                                <input type="text" class="form-control" id="edit_satuan" name="satuan" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_hargabeli">Harga Beli</label>
                                <input type="number" class="form-control" id="edit_hargabeli" name="hargabeli"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_hargajual1">Harga Jual 1</label>
                                <input type="number" class="form-control" id="edit_hargajual1" name="hargajual1"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_hargajual2">Harga Jual 2</label>
                                <input type="number" class="form-control" id="edit_hargajual2" name="hargajual2"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_hargajual3">Harga Jual 3</label>
                                <input type="number" class="form-control" id="edit_hargajual3" name="hargajual3"
                                    required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </body>
@stop

@section('css')
    {{-- CSS Kustom --}}
@stop

@section('js')
    <script>
        const modalTambahBarang = document.getElementById('modalTambahBarang');
        const formTambahBarang = document.getElementById('formTambahBarang');

        $(document).ready(function() {
            // default: kodebarang tidak bisa diubah
            $("#edit_kodebarang").prop("readonly", true);

            // toggle saat ceklis
            $("#cek_edit_kodebarang").on("change", function() {
                if ($(this).is(":checked")) {
                    $("#edit_kodebarang").prop("readonly", false);
                } else {
                    $("#edit_kodebarang").prop("readonly", true);
                }
            });
        });

        $('#databarang').on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/dataBarang/edit/' + id,
                type: 'GET',
                success: function(res) {
                    if (res.success) {
                        let data = res.data;
                        $('#edit_id').val(data.id);
                        $('#edit_kodebarang').val(data.kodebarang);
                        $('#edit_namabarang').val(data.namabarang);
                        $('#edit_kategori_id').val(data.kategori_id);
                        $('#edit_satuan').val(data.satuan);
                        $('#edit_hargabeli').val(data.hargabeli);
                        $('#edit_hargajual1').val(data.hargajual1);
                        $('#edit_hargajual2').val(data.hargajual2);
                        $('#edit_hargajual3').val(data.hargajual3);
                        $('#modalEditBarang').modal('show');
                    } else {
                        alert('Data tidak ditemukan');
                    }
                },
                error: function() {
                    alert('Gagal mengambil data.');
                }
            });
        });

        /// Reset kondisi setiap kali modal tambah dibuka
        $('#modalTambahBarang').on('show.bs.modal', function() {
            $('#kodebarang').val('').prop('readonly', false); // default manual
            $('#cek_auto_kode').prop('checked', false); // uncheck otomatis
        });

        // Jika ceklis diubah
        $(document).on('change', '#cek_auto_kode', function() {
            if ($(this).is(':checked')) {
                // Panggil route generate kode
                fetch("{{ route('databarang.generateKode') }}")
                    .then(response => response.json())
                    .then(data => {
                        $('#kodebarang').val(data.kode).prop('readonly', true);
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                // Balik ke manual
                $('#kodebarang').val('').prop('readonly', false);
            }
        });



        $('#tambahbarang').on('click', function() {
            $('#modalTambahBarang').modal('show');
        });

        $(document).ready(function() {
            $('#databarang').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: true,
                scrollx: true,
                ajax: {
                    url: '{{ route('databarang.index') }}',
                    type: 'GET',
                    data: function(d) {
                        d.kategori = $('#filter_kategori').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kodebarang',
                        name: 'kodebarang'
                    },
                    {
                        data: 'namabarang',
                        name: 'namabarang'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'hargabeli',
                        name: 'hargabeli',
                        searchable: false
                    },
                    {
                        data: 'hargajual1',
                        name: 'hargajual1',
                        searchable: false
                    },
                    {
                        data: 'hargajual2',
                        name: 'hargajual2',
                        searchable: false
                    },
                    {
                        data: 'hargajual3',
                        name: 'hargajual3',
                        searchable: false
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
            $('#filter_kategori').change(function() {
                $('#databarang').DataTable().ajax.reload();
            });
        });
        $('#formTambahBarang').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('databarang.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#modalTambahBarang').modal('hide');
                    $('#formTambahBarang')[0].reset();
                    $('#databarang').DataTable().ajax.reload();
                    alert('Data barang berhasil ditambahkan!');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menambahkan data barang.');
                }
            });
        });
        $('#formEditBarang').submit(function(e) {
            e.preventDefault();
            var id = $('#edit_id').val();
            $.ajax({
                url: '/admin/dataBarang/update/' + id,
                type: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#modalEditBarang').modal('hide');
                    $('#formEditBarang')[0].reset();
                    $('#databarang').DataTable().ajax.reload();
                    alert('Data barang berhasil diupdate!');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        if (errors.kodebarang) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kode Barang Duplikat',
                                text: errors.kodebarang[0],
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menyimpan data',
                            });
                        }
                    }
                }
            });
        });
        $('#databarang').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: '/admin/dataBarang/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#databarang').DataTable().ajax.reload();
                        alert('Data barang berhasil dihapus!');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data barang.');
                    }
                });
            }
        });
    </script>
@stop
