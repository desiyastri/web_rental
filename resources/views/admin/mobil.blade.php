<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MoRental - Dashboard</title>
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
        Detail Mobil
        <small>Informasi setiap mobil yang ada di MoRental</small>
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
                <!-- START MODAL FOR ADD -->

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" style="width: 10rem; float: right; margin-bottom: 1rem">
                  Add
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" style="margin-bottom: -20px" id="exampleModalLabel">Tambah Data Pelanggan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @if(count($errors) > 0)
              				<div class="alert alert-danger">
              					@foreach ($errors->all() as $error)
              					{{ $error }} <br/>
              					@endforeach
              				</div>
              				@endif

                      <form role="form" id="formAdd" method="POST" action="/mobilAction" enctype="multipart/form-data"> 
                        <div class="modal-body">
                            <div class="box-body">
                              <div class="form-group">
                                {{csrf_field()}}
                                <label for="in__no">No Polisi</label>
                                <input type="text" class="form-control" placeholder="Masukan no_polisi" name="no_polisi">

                                <label for="in_merk">merk_mobil</label>
                                <br>
                                <select name="merk_mobil" class="form-control">
                                <option>--Pilih--</option>
                                <option>Daihatsu</option>
                                <option>Toyota</option>
                                <option>Suzuki</option>
                                <option>Honda</option>
                                <option>Nissan</option>
                                </select>

                                <label for="in_jenis">jenis_mobil</label>
                                <input type="text" class="form-control" placeholder="Masukan jenis" name="jenis_mobil">

                                <label for="in_harga">Harga</label><br>
                                <input type="text" class="form-control" placeholder="Masukan harga" name="harga">

                                <label for="in_trans">Transmisi</label>
                                <br>
                                <select name="transmisi" class="form-control">
                                <option>--Pilih--</option>
                                <option>Manual</option>
                                <option>Matic</option>
                                </select>

                                <label for="in_kps">Kapasitas</label>
                                <input type="text" class="form-control" placeholder="Masukan Kapasitas" name="kapasitas">

                                <label for="in_like">Like</label>
                                <input type="text" class="form-control" name="like">

                                <label for="in_use">Use</label>
                                <input type="text" class="form-control" name="use">

                                <label for="in_img">Image</label>
                                <input type="file" name="img">

                              </div><!-- /.box-body -->
                            </div>
                        </div>
                        <div class="modal-footer">
                          <input style="float:right;" type="submit" class="btn btn-primary" name="btn_submit" value="Submit"></input>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- END MODAL -->

                <!-- START MODAL FOR EDIT -->
                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" style="margin-bottom: -20px" id="exampleModalLabel">Edit Data Pelanggan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <form role="form" method="POST" id="edit-form" action="/mobilUpdate" enctype="multipart/form-data">

                        {{csrf_field()}}
                        {{ method_field('PUT') }}

                        <div class="modal-body">
                            <div class="box-body">
                              <div class="form-group">
                              <label for="in_id">Id</label>
                                <input type="hidden" class="form-control" id="in_id" placeholder="Masukkan nomor" name="id_mobil">

                                <label for="in_no">No Polisi</label>
                                <input type="text" class="form-control" id="in_no" placeholder="Masukkan nomor" name="no_polisi">

                                <label for="in_harga">Merk Mobil</label>
                                <select name="merk_mobil" class="form-control" id="in_merk">
                                <option>Daihatsu</option>
                                <option>Toyota</option>
                                <option>Suzuki</option>
                                <option>Honda</option>
                                <option>Nissan</option>
                                </select>

                                <label for="in_tujuan">Jenis Mobil</label>
                                <input type="text" class="form-control" id="in_jenis" placeholder="Masukan Jenis" name="jenis_mobil">

                                <label for="in_harga">Harga</label>
                                <input type="text" class="form-control" id="in_harga" placeholder="Masukan Harga" name="harga">

                                <label for="in_trans">Transmisi</label>
                                <select name="transmisi" class="form-control" id="in_trans">
                                <option>Manual</option>
                                <option>Matic</option>
                                </select>

                                <label for="in_kps">Kapasitas</label>
                                <input type="text" class="form-control" id="in_kps" placeholder="Masukkan Kapasitas" name="kapasitas">

                                <label for="in_like">Like</label>
                                <input type="text" class="form-control" id="in_like" name="like">

                                <label for="in_use">Use</label>
                                <input type="text" class="form-control" id="in_use" name="use">

                                <input type="hidden" class="form-control" id="in_ketersediaan" name="ketersediaan">

                                <label for="in_img">Image</label>
                                <input type="file" name="img" id="in_img">

                                
                              </div><!-- /.box-body -->
                            </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" name="btnUpdate" style="float:right;" class="btn btn-primary" value="Update">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- END MODAL -->
                <div class="input-group text-center" style="width: 250px;">
                    <input class="form-control form-control-sm" type="text">
                    <span class="input-group-addon"><a href="#"><i class="fa fa-search"></i></a></span>
                </div> <br>

                <table id="detailTable" class="table table-sm table-bordered table-hover attrTable">
                    <tr>
                      <th class="attrName">No Polisi</th>
                      <th class="attrName">Merk Mobil</th>
                      <th class="attrName">Jenis Mobil</th>
                      <th class="attrName">Harga</th>
                      <th class="attrName">Transmisi</th>
                      <th class="attrName">Kapasitas</th>
                      <th class="attrName">Like</th>
                      <th class="attrName">Use</th>
                      <th class="attrName">Status</th>
                      <th class="attrName">Image</th>
                      <th class="attrName">Action</th>
                    </tr>

                      @foreach($mobil as $d)
                      <tr class="row_data">
                        <td class="td_no">{{ $d->no_polisi }}</td>
                        <td class="td_merk">{{ $d->merk_mobil }}</td>
                        <td class="td_jenis">{{ $d->jenis_mobil }}</td>
                        <td class="td_harga">{{ $d->harga}}</td>
                        <td class="td_trans">{{ $d->transmisi }}</td>
                        <td class="td_kps">{{ $d->kapasitas }}</td>
                        <td class="td_like">{{ $d->like }}</td>
                        <td class="td_use">{{ $d->use }}</td>
                        <td class="td_status">{{ $d->ketersediaan}}</td>
                        <td class="td_img"><img width="150px" src="{{ url('/img_rental/'.$d->img) }}"></td>
                        <td>
                          <button type="button" class="btn btn-success" id="edit-item"
                          data-item-id="{{$d->id_mobil}}"
                          data-item-no="{{$d->no_polisi}}"
                          data-item-merk="{{$d->merk_mobil}}"
                          data-item-jenis="{{$d->jenis_mobil}}"
                          data-item-harga="{{$d->harga}}"
                          data-item-trans="{{$d->transmisi}}"
                          data-item-kps="{{$d->kapasitas}}"
                          data-item-like="{{$d->like}}"
                          data-item-use="{{$d->use}}"
                          data-item-ketersediaan="{{$d->ketersediaan}}"
                          data-item-img="{{$d->img}}"
                          
                          data-toggle="modal" data-target="#editModal">Edit</button>
                          <a href="/admin/mobil/hapus/{{ $d->id_mobil }}" onClick="return confirm('Are you sure want to delete?')">
                            <input type="submit" name="btnDelete" class="btn btn-danger" value="Delete">
                          </a>
                        </td>
                      </tr>
                      @endforeach
                </table>
              </div>
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


     <!-- SCRIPT FOR GETTING DATA FROM TABLE USING JQUERY -->
     <script>

         $(document).ready(function(){

           $(document).on('click', "#edit-item", function() {

             //alert("tombol edit telah diklik");

             $(this).addClass('edit-item-trigger-clicked');

             var options={
               'backdrop':'static'
             };
             //alert(options);

             $('#editModal').modal(options);

           })

           //on modal show

           $('#editModal').on('show.bs.modal', function(event) {

             //alert("Edit 2 telah aktif");

             var button=$(event.relatedTarget);
             //var edti_id=button.data('item-id');
             var edit_id=button.data('item-id');
             var edit_no=button.data('item-no');
             var edit_merk=button.data('item-merk');
             var edit_jenis=button.data('item-jenis');
             var edit_harga=button.data('item-harga');
             var edit_trans=button.data('item-trans');
             var edit_kps=button.data('item-kps');
             var edit_like=button.data('item-like');
             var edit_use=button.data('item-use');
             var edit_ketersediaan=button.data('item-ketersediaan');
             var edit_img=button.data('item-img');


             var modal=$(this)

             //modal.find('.modal-body #in_id').val(edit_id);
             modal.find('.modal-body #in_id').val(edit_id);
             modal.find('.modal-body #in_no').val(edit_no);
             modal.find('.modal-body #in_merk').val(edit_merk);
             modal.find('.modal-body #in_jenis').val(edit_jenis);
             modal.find('.modal-body #in_harga').val(edit_harga);
             modal.find('.modal-body #in_trans').val(edit_trans);
             modal.find('.modal-body #in_kps').val(edit_kps);
             modal.find('.modal-body #in_like').val(edit_like);
             modal.find('.modal-body #in_use').val(edit_use);
             modal.find('.modal-body #in_ketersediaan').val(edit_ketersediaan);
             modal.find('.modal-body #in_img').val(edit_img);


             })

             //on modal hide
             $('#editModal').on('hide.bs.modal',function() {
               //alert("modal hide");
               $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked');
               $("#editForm").trigger("reset");
           })

         })

     </script>

</body>
</html>
