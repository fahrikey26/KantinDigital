@extends('admin.index')
@section('judul', 'transaksi')
@section('konten')

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <button class="btn btn-info" data-toggle="modal" data-target="#databayar">Scan Data Bayar</button>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-danger mt-3">
                                {{ session('message') }}</b>
                            </div>
                        @endif
                        @if (session('message2'))
                            <div class="alert alert-success mt-3">
                                {{ session('message2') }}</b>
                            </div>
                        @endif
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    @if (Auth::user()->role == 'karyawan' or Auth::user()->role == 'admin')
                                        <th><button class="btn btn-success mb-2">Poin Terpakai :
                                                {{ $jumlahpoin }}</button><br>Data transaksi</th>
                                    @endif
                                    @if (Auth::user()->role == 'pedagang')
                                        <th><button class="btn btn-success mb-2">Poin Terkumpul :
                                                {{ $jumlahpoin }}</button><br>Data transaksi</th>
                                    @endif
                                    @if (Auth::user()->role == 'admin')
                                        <th>Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $k)
                                    <tr>
                                        <td class="text-center">
                                            <div class="text-left"><b><i>Waktu Jajan : {{ $k->created_at }}</i></b>
                                            </div>
                                            <div class="text-left"><b><i>Kode Transaksi :
                                                        {{ $k->id_transaksi }}</i></b>
                                                @if (Auth::user()->role != 'pedagang')
                                                    <br><button class="btn btn-info" data-toggle="modal"
                                                        data-target="#barcode{{ $k->id_transaksi }}">QR Code</button>
                                                @endif
                                            </div>
                                            <hr>
                                            @if (Auth::user()->role != 'karyawan')
                                                <div class="text-left fs-5"><i>Nama Karyawan : </i>{{ $k->nama_karyawan }}
                                                </div>
                                            @endif
                                            <div class="text-left"><i>Menu Jajan : </i>{{ $k->nama_menu }}</div>
                                            <div class="text-left"><i>Banyak : </i>{{ $k->banyak }} Porsi</div>
                                            @if (Auth::user()->role != 'pedagang')
                                                <div class="text-left"><i>Pengurangan Poin :
                                                        <button class="btn btn-success">{{ $k->jumlahpoin }}</button></i>
                                                </div>
                                            @endif
                                            @if (Auth::user()->role == 'pedagang')
                                                <div class="text-left"><i>Penambahan Poin :
                                                        <button class="btn btn-success">{{ $k->jumlahpoin }}</button></i>
                                                </div>
                                            @endif
                                        </td>
                                        @if (Auth::user()->role == 'admin')
                                            <td class="text-center">
                                                <!--<button class="btn btn-info" data-toggle="modal" data-target="#ModalUpdate{{ $k->id_transaksi }}">Update</button>-->
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#ModalDelete{{ $k->id_transaksi }}">Delete</button>

                                            </td>
                                        @endif
                                    </tr>
                                    <!-- Ini tampil form update user -->
                                    <div class="modal fade" id="ModalUpdate{{ $k->id_transaksi }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update
                                                        transaksi</h1>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/transaksi/storeupdate" method="post"
                                                        class="form-floating" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="idtransaksi" class="form-control"
                                                            value="{{ $k->id_transaksi }}">
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">Nama Karyawan</label>
                                                            <input type="text" name="idkaryawan" required="required"
                                                                class="form-control" value="{{ $k->id_karyawan }}">

                                                        </div>
                                                        <div class="form-floating p-1">
                                                            <label for="floatingInputValue">Nama Menu</label>
                                                            <input type="text" name="idmenu" required="required"
                                                                class="form-control" value="{{ $k->id_menu }}">

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
                                    <div class="modal fade" id="ModalDelete{{ $k->id_transaksi }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus
                                                        transaksi</h1>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/transaksi/delete/{{ $k->id_transaksi }}" method="get"
                                                        class="form-floating">
                                                        @csrf
                                                        <div>
                                                            <h3>Yakin mau menghapus data
                                                                <b>{{ $k->id_transaksi }}</b>
                                                                ?
                                                            </h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ini tampil barcode QR -->
                                    <div class="modal fade" id="barcode{{ $k->id_transaksi }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">QR
                                                        Code<br><b>{{ $k->id_transaksi }}</b></h1>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    {!! QrCode::size(300)->generate($k->id_transaksi) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ini tampil camera scanner -->
                                    <div class="modal fade" id="databayar" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Camera Scanner
                                                    </h1>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <div id="reader" width="600px"></div>
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
                                                <form action="/transaksi/storeinput" method="post" class="form-floating"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-floating p-1">
                                                        <label for="floatingInputValue">ID transaksi</label>
                                                        <input type="text" name="idtransaksi" required="required"
                                                            class="form-control">

                                                    </div>
                                                    <div class="form-floating p-1">
                                                        <label for="floatingInputValue">Nama Karyawan</label>
                                                        <input type="text" name="idkaryawan" required="required"
                                                            class="form-control">

                                                    </div>
                                                    <div class="form-floating p-1">
                                                        <label for="floatingInputValue">Nama Menu</label>
                                                        <input type="text" name="idmenu" required="required"
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
                                    @if (Auth::user()->role != 'pedagang')
                                        <th>Data transaksi<br><br><a href="/"><button class="btn btn-primary">Lanjut
                                                    Jajan</button></a></th>
                                    @endif
                                    @if (Auth::user()->role == 'admin')
                                        <th>Opsi</th>
                                    @endif
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
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script script type="text/javascript">
        new DataTable('#example');

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            //console.log(`Code matched = ${decodedText}`, decodedResult);
            var a = document.getElementById("hasil");
            a.value = decodedText;
            var id = a.value;
            window.location = '/transaksi/tampil/' + '${id}' + '/edit';
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            //console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
