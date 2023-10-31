@extends('admin.index')
@section('judul', 'Karyawan')
@section('konten')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><button class="btn btn-primary" data-toggle="modal"
                                    data-target="#ModalTambah">Tambah
                                    Karyawan</button></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Data Karyawan</th>
                                        <th>Poin</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan as $k)
                                        <tr>
                                            <td class="text-center">
                                                {{ $k->id_karyawan }}<br>
                                                <b>{{ $k->nama_karyawan }}</b><br>
                                                <img src="/assets/img/{{ $k->foto }}" alt="" width="90px"
                                                    height="120px">
                                            </td>
                                            <td class="text-center">{{ $k->point }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-info" data-toggle="modal"
                                                    data-target="#ModalUpdate{{ $k->id_karyawan }}">Update</button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#ModalDelete{{ $k->id_karyawan }}">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- Ini tampil form update user -->
                                        <div class="modal fade" id="ModalUpdate{{ $k->id_karyawan }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update
                                                            Karyawan</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/karyawan/storeupdate" method="post"
                                                            class="form-floating" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="idkaryawan" class="form-control"
                                                                value="{{ $k->id_karyawan }}">
                                                            <div class="form-floating p-1">
                                                                <label for="floatingInputValue">Nama</label>
                                                                <input type="text" name="nama" required="required"
                                                                    class="form-control" value="{{ $k->nama_karyawan }}">

                                                            </div>
                                                            <div class="form-floating p-1">
                                                                <label for="floatingInputValue">Poin</label>
                                                                <input type="number" name="poin" required="required"
                                                                    class="form-control" value="{{ $k->point }}">

                                                            </div>
                                                            <div class="form-floating p-1">
                                                                <label for="floatingInputValue">Foto</label>
                                                                <input type="file" name="foto" required="required"
                                                                    class="form-control" value="{{ $k->foto }}">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Updates</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Ini tampil form delete user -->
                                        <div class="modal fade" id="ModalDelete{{ $k->id_karyawan }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus
                                                            Karyawan</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/karyawan/delete/{{ $k->id_karyawan }}"
                                                            method="get" class="form-floating">
                                                            @csrf
                                                            <div>
                                                                <h3>Yakin mau menghapus data
                                                                    <b>{{ $k->nama_karyawan }}</b>
                                                                    ?
                                                                </h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Ini tampil form tambah user -->
                                    <div class="modal fade" id="ModalTambah" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User
                                                    </h1>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/karyawan/storeinput" method="post"
                                                        class="form-floating" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">ID Karyawan</label>
                                                            <input type="text" name="idkaryawan" required="required"
                                                                class="form-control">
                                                            @foreach ($errors->get('idkaryawan') as $error)
                                                                <span class="help-block">{{ $error }}</span>
                                                            @endforeach
                                                        </div>
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">Nama</label>
                                                            <input type="text" name="nama" required="required"
                                                                class="form-control">

                                                        </div>
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">Email</label>
                                                            <input type="email" name="email" required="required"
                                                                class="form-control">

                                                        </div>
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">Password</label>
                                                            <input type="password" name="password" required="required"
                                                                class="form-control">

                                                        </div>
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">Poin</label>
                                                            <input type="number" name="poin" required="required"
                                                                class="form-control">

                                                        </div>
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">Foto</label>
                                                            <input type="file" name="foto" required="required"
                                                                class="form-control">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Data Karyawan</th>
                                        <th>Poin</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    </body>

    </html>
@endsection
