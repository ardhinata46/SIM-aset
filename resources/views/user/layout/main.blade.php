<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{URL::asset('assets/img/logo/logo.png')}}" rel="icon">
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset($profil->logo) }}" type="image/x-icon">
    <link href="{{URL::asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('assets/css/ruang-admin.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
        .img-profil {
            width: 100px;
            height: auto;
        }

        table {
            padding: 0;
        }

        th,
        td {
            font-size: 13px;
            text-align: left;
        }

        th {
            text-align: left;
        }

        .logo {
            border-radius: 50%;
        }

        a:hover {
            text-decoration: none;
        }


        .card-img,
        .nota-image,
        .ikon,
        .img-profil {
            transition: transform 0.3s;
        }

        .nota-image {
            width: 100px;
        }


        .nota-image:hover {
            transform: scale(1.1);
        }

        .img-profil {
            transform: scale(1.1);
        }

        .card-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
            /* Tambahkan jarak atas */
        }

        .card-img:hover {
            transform: scale(1.1);
        }

        .sosmed {
            display: flex;
            justify-content: center;
        }

        .sosmed .fab {
            padding-left: 20px;
            padding-right: 20px;
        }

        .sosmed .ikon:hover {
            transform: scale(1.2);
        }

        .table-detail {
            max-width: 50%;
        }

        @media screen and (max-width: 767px) {
            .table-detail {
                max-width: 100%;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <img class="logo" src="{{ asset($profil->logo) }}">
                </div>
                <div class="sidebar-brand-text mx-3">{{ $profil->nama_aplikasi }}</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Data Inventaris
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.inventaris_tanah.index')}}">
                    <i class="fas fa-fw fa-map"></i>
                    <span>Aset Tanah</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.inventaris_bangunan.index')}}">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Aset Bangunan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('inventaris_barang.index')}}">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Aset Barang</span></a>
            </li>

        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button><span style="color: white;">{{ $profil->nama_organisasi }}</span>

                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    @yield ('user.content')
                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <span>copyright &copy; <script>
                                    document.write(new Date().getFullYear());
                                </script> - developed by
                                <b><a href="https://www.instagram.com/berkati.t__/" target="_blank">Berkati Telaumbanua</a></b>
                            </span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>


    <script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/ruang-admin.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#addModal').on('hidden.bs.modal', function() {
                $('#error-container').hide();
            });

            $('#addForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        $('#addModal').modal('hide');
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        var errorMessage = 'Terjadi kesalahan:<br><ul>';

                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                errorMessage += '<li>' + message + '</li>';
                            });
                        });

                        errorMessage += '</ul>';
                        $('#error-container').html(errorMessage).show();
                        $('#addModal').animate({
                            scrollTop: 0
                        }, 'slow');
                    }
                });
            });
        });
    </script>

    <script>
        function formatRupiah(input) {
            // Menghapus semua karakter non-digit dari input
            var angka = input.value.replace(/\D/g, '');

            // Menambahkan titik sebagai pemisah ribuan
            var formattedAngka = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Memasukkan nilai yang diformat ke dalam input
            input.value = formattedAngka;
        }
    </script>

    @yield('footer')
</body>

</html>