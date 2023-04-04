<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">




    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CRUD LARAVEL</title>
</head>

<body>
    <h1 class="text-center mb-8">Data Pegawai</h1>


    <div class="container">
        <div class="row justify-content-between mb-4">
            <div class="col-md-4">
                <form action="/pegawai" method="GET" class="form-inline">
                    <div class="form-group">
                        <input type="name" id="inputPassword6" name="search" placeholder="Cari Pegawai"
                            class="form-control mr-sm-2" aria-describedby="passwordHelpInline">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <a href="/tambahpegawai" type="button" class="btn btn-success float-right">Tambah Data</a>
                <a href="/eksportpdf" type="button" class="btn btn-info float-right mr-2">Export PDF</a>
            </div>
        </div>
    </div>



    <div class="row" type=>
    </div>
    @if ($messege = Session::get('succes'))
        <div class="alert alert-danger" role="alert">
            {{ $messege }}
        </div>
    @endif
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Foto</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">NO HP</th>
                <th scope="col">Dibuat</th>
                <th scope="col">AKSI</th>
            </tr>
        </thead>
        <tbody>

            @php
                $no = 1;
            @endphp
            @foreach ($data as $index => $row)
                <tr>
                    <th scope="row">{{ $index + $data->FirstItem() }}</th>
                    <td>{{ $row->nama }}</td>
                    <td>
                        <img src="{{ asset('fotopegawai/' . $row->foto) }}" style="width: 40px;" alt="">
                    </td>
                    <td>{{ $row->jeniskelamin }}</td>
                    <td>0{{ $row->notelpon }}</td>
                    <td>{{ $row->created_at->diffForhumans() }}</td>
                    <td>
                        <a href="/tampilkandata/{{ $row->id }}" type="button" class="btn btn-warning">Edit</a>
                        <a href="#" type="button" class="btn btn-danger delete" data-id="{{ $row->id }}"
                            data-nama="{{ $row->nama }}">Delete</a>
                    </td>
                </tr>
            @endforeach








        </tbody>
    </table>

    <table class="table">
        <thead class="thead-light">

        </thead>
        <tbody>
            <tr>
            </tr>

    </table>
    {{ $data->links() }}


    </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>


<script>
    $('.delete').click(function() {
        var pegawaiid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        swal({
                title: "Yakin? ",
                text: "Kamu akan menghapus data " + nama + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete/" + pegawaiid + ""
                    swal("Data Telah Dihapus!", {
                        icon: "success",
                    });
                } else {
                    swal("Data Tidak Jadi Dihapus!");
                }
            });


    });
</script>
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif
</script>







</html>
