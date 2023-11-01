@extends('admin.index')
@section('judul', 'Menu')
@section('konten')

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><button class="btn btn-primary" data-toggle="modal"
                                    data-target="#ModalTambah">Tambah
                                    menu</button></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Data Menu</th>
                                        <th>Harga Poin</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $k)
                                        <tr>
                                            <td class="text-center">
                                                {{ $k->id_menu }}<br>Kantin {{ $k->nama_kantin }}
                                            </td>
                                            <td class="text-center"><b>{{ $k->nama_menu }}</b><br><img
                                                    src="/assets/img/{{ $k->foto }}" alt="" width="90px"
                                                    height="120px"><br>Harga : {{ $k->point }} poin</td>
                                            <td class="text-center">
                                                <button class="btn btn-info" data-toggle="modal"
                                                    data-target="#ModalUpdate{{ $k->id_menu }}">Update</button>
                                                @if (Auth::user()->role == 'admin')
                                                    <button class="btn btn-danger" data-toggle="modal"
                                                        data-target="#ModalDelete{{ $k->id_menu }}">Delete</button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!-- Ini tampil form update user -->
                                        <div class="modal fade" id="ModalUpdate{{ $k->id_menu }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update
                                                            menu</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/menu/storeupdate" method="post"
                                                            class="form-floating" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="idmenu" class="form-control"
                                                                value="{{ $k->id_menu }}">
                                                            <div class="form-floating p-1">
                                                                <label for="floatingInputValue">Nama Menu</label>
                                                                <input type="text" name="nama" required="required"
                                                                    class="form-control" value="{{ $k->nama_menu }}">

                                                            </div>
                                                            <div class="form-floating p-1">
                                                                <label for="floatingInputValue">Nama Kantin</label>
                                                                <select name="idkantin" class="form-control">
                                                                    @foreach ($kantin as $ka)
                                                                        <option value="{{ $ka->id_kantin }}">
                                                                            {{ $ka->nama_kantin }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <div class="form-floating p-1">
                                                                <label for="floatingInputValue">Poin</label>
                                                                <input type="number" name="point" required="required"
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
                                        <div class="modal fade" id="ModalDelete{{ $k->id_menu }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus
                                                            menu</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/menu/delete/{{ $k->id_menu }}" method="get"
                                                            class="form-floating">
                                                            @csrf
                                                            <div>
                                                                <h3>Yakin mau menghapus data
                                                                    <b>{{ $k->nama_menu }}</b>
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu
                                                    </h1>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/menu/storeinput" method="post" class="form-floating"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                </div>
                                                <div class="form-floating p-1">
                                                    <label for="floatingInputValue">Nama Menu</label>
                                                    <input type="text" name="nama" required="required"
                                                        class="form-control">

                                                </div>
                                                <div class="form-floating p-1">
                                                    <label for="floatingInputValue">Nama Kantin</label>
                                                    <select name="idkantin" class="form-control">
                                                        @foreach ($kantin as $ka)
                                                            <option value="{{ $ka->id_kantin }}">
                                                                {{ $ka->nama_kantin }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="form-floating p-1">
                                                    <label for="floatingInputValue">Poin</label>
                                                    <input type="number" name="point" required="required"
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
                                <th>Data menu</th>
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

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        new DataTable('#example');
    </script>
@endsection
