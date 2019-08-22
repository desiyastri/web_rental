<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Goodwill - Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-red for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-red.min.css')}}">

  <!-- DataTables CDN -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

  <!-- JQuery for modal box -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>-->
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <!--[endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-red                                |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <!--Including Header from header.blade.php-->
  @include('admin/header')
  <!--./header-->

  <!-- Left side column. contains the logo and sidebar -->

  @include('admin/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Peminjaman
        <small>Informasi setiap data mobil yang dipinjam oleh pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="content">
          <div class="container-fluid">
            @yield('content')

            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Pinjam</th>
                                <td>:</td>
                                <td>{{ $data['kode_pinjam'] }}</td>
                                <input type="hidden" name="kode_pinjam" value="{{ $data['kode_pinjam'] }}" required>
                            </tr>
                        </thead>
                        <tr>
                            <th>Name</th>
                            <td>:</td>
                            <td>{{ $pelanggan->nama }}</td>
                            <input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id_pelanggan }}" required>
                        </tr>
                        <tr>
                            <th>Mobil</th>
                            <td>:</td>
                            <td>{{ $mobil->merk_mobil }} - {{ $mobil->jenis_mobil }}</td>
                            <input type="hidden" name="id_mobil" value="{{ $mobil->id_mobil }}" required>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai</th>
                            <td>:</td>
                            <td>{{ $data['tgl_mulai'] }}</td>
                            <input type="hidden" name="tgl_mulai" value="{{ $data['tgl_mulai'] }}" required>
                        </tr>
                        <tr>
                            <th>Lama Pinjam</th>
                            <td>:</td>
                            <td>{{ $data['lama_pinjam'] }} hari</td>
                            <input type="hidden" name="lama_pinjam" value="{{ $data['lama_pinjam'] }}" required>
                        </tr>
                        <tr>
                            <th>Tanggal Selesai</th>
                            <td>:</td>
                            <td>{{ $data['tgl_selesai'] }}</td>
                            <input type="hidden" name="tgl_selesai" value="{{ $data['tgl_selesai'] }}" required>
                        </tr>
                        <tr>
                            <th>Harga per hari</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($mobil->harga) }}</td>
                            <input type="hidden" name="harga" value=" {{ $data['price'] }}" required>
                        </tr>
                        <tr>
                            <th>Jumlah Harga</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($data['jumlah_bayar']) }}</td>
                            <input type="hidden" name="jumlah_bayar" value="{{ $data['jumlah_bayar'] }}" required>
                        </tr>
                        <tr>
                            <th>Denda</th>
                            <td>:</td>
                            @if($denda != null)
                            <td style="color: red">Rp. {{ number_format($denda) }} (Telat {{$telat}} hari)</td>
                            @else
                            <td>0</td>
                            @endif
                            <input type="hidden" name="denda" value="{{ $denda }}" required>
                        </tr>
                        <tr>
                            <th colspan="3" style="border-bottom: 3px dashed rgb(121, 121, 121)"></th>
                        </tr>
                        <tr><td colspan="3"></td></tr>
                        <tr>
                        <th colspan="2">TOTAL</th>
                        <td>Rp. {{ number_format($total) }}</td>
                        <input type="hidden" name="bayar" id="bayar" value="{{ $total }}">
                        </tr>
                        <tr class="text-center">
                            <td colspan="3"><button class="btn btn-success" style="width: 300px;" type="button">Transakisi</button></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
@include('admin/footer')

<!-- Control Sidebar -->
@include('admin/control-sidebar')
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->



<!-- CDN DataTables Script -->
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
   Both of these plugins are recommended to enhance the
   user experience. -->

   <!-- JQuery for getting data from table -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" /> -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

   <script type="text/javascript" src="{{asset('js/app.js')}}"></script>

</body>
</html>