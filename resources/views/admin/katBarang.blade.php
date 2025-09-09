@extends('adminlte::page')

@section('title', 'Kategori Barang')

@section('content_header')
    <h1>Kategori Barang</h1>
@stop

@section('content')

    <body>
        <button id="tambahkategori" type="button" class="btn btn-primary mb-3">Tambah Kategori Barang</button>
        <div class="card">
            <div class="card-body">
                <table id="kategoribarang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
            </div>
        </div>
        <div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog"
            aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formTambahKategori">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="namakategoribarang">Nama Kategori Barang</label>
                                <input type="text" class="form-control" id="namakategoribarang" name="kategoribarang"
                                    placeholder="Masukkan nama kategori barang" required>
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
        <div class="modal fade" id="modalEditKategori" tabindex="-1" role="dialog"
            aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditKategoriLabel">Edit Kategori Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEditKategori">
                        <div class="modal-body">
                            <div class="form-group  ">
                                <label for="editNamakategoribarang">Nama Kategori Barang</label>
                                <input type="text" class="form-control" id="editNamakategoribarang" name="kategoribarang"
                                    placeholder="Masukkan nama kategori barang" required>
                                <input type="hidden" id="editKategoriId" name="id">
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
    </body>
@stop

@section('css')
    {{-- CSS Kustom --}}
@stop

@section('js')
    <script>
        const modalTambahKategori = document.getElementById('modalTambahKategori');
        const formTambahKategori = document.getElementById('formTambahKategori');
        const modalEditKategori = document.getElementById('modalEditKategori');

        $(document).ready(function() {
            $('#kategoribarang').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('katbarang.index') }}',
                    type: 'GET'
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'kategoribarang',
                        name: 'kategoribarang'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }

                ]
            });
        });
        $('#tambahkategori').click(function() {
            $('#modalTambahKategori').modal('show');
        });
        $('#formTambahKategori').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('katbarang.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#modalTambahKategori').modal('hide');
                    $('#formTambahKategori')[0].reset(); // reset form setelah simpan
                    $('#kategoribarang').DataTable().ajax.reload(null,
                        false); // reload tanpa reset paging
                    alert('Kategori barang berhasil ditambahkan!');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat menambahkan kategori barang.');
                }
            });
        });
        $('#kategoribarang').on('click', '.btn-delete', function() {
            const id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                $.ajax({
                    url: `/admin/katbarang/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kategoribarang').DataTable().ajax.reload(null, false);
                        alert('Kategori barang berhasil dihapus!');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat menghapus kategori barang.');
                    }
                });
            }
        });

        $('#kategoribarang').on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            $.ajax({
                url: `/admin/katbarang/edit/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#editNamakategoribarang').val(data.kategoribarang);
                    $('#editKategoriId').val(data.id);
                    $('#modalEditKategori').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat mengambil data kategori.');
                }
            });
        });
        $('#formEditKategori').submit(function(e) {
            e.preventDefault();
            const id = $('#editKategoriId').val();
            $.ajax({
                url: `/admin/katbarang/update/${id}`,
                type: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#modalEditKategori').modal('hide');
                    $('#formEditKategori')[0].reset(); // reset form setelah simpan
                    $('#kategoribarang').DataTable().ajax.reload(null,
                        false); // reload tanpa reset paging
                    alert('Kategori barang berhasil diperbarui!');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat memperbarui kategori barang.');
                }
            });
        });
    </script>
@stop
