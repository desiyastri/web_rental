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
        Users
        <small>Data setiap user yang terdaftar</small>
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
                <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" style="width: 10rem; float: right; margin-bottom: 1rem">
                  Add
                </button> -->

                <!-- Modal -->
                <!-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" style="margin-bottom: -20px" id="exampleModalLabel">Tambah Data Pelanggan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form role="form" id="formAdd" method="POST" action="/pegawaiAction" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="box-body">
                              <div class="form-group">
                                {{csrf_field()}}
                                
                                <label for="in_name">Nama Pegawai</label>
                                <input type="text" class="form-control" placeholder="Masukan nama" name="name">

                                <label for="in_posisi">Posisi</label>
                                <input type="text" class="form-control" placeholder="Masukan posisi" name="posisi">

                                <label for="in_jk">Jenis Kelamin</label><br>
                                <select name="jk" class="form-control">
                                <option>Pria</option>
                                <option>Wanita</option>
                                </select>
                                
                                <label for="in_alamat">Alamat</label>
                                <textarea name="alamat" placeholder="Masukan alamat" cols="10" rows="5" class="form-control"></textarea>

                                <label for="in_email">Email</label>
                                <input type="email" class="form-control" placeholder="contoh123@email.com" name="email">

                                <label for="in_password">Password</label>
                                <input type="password" class="form-control" name="password">


                              </div> -->
                              <!-- /.box-body -->
                            <!-- </div>
                        </div>
                        <div class="modal-footer">
                          <input style="float:right;" type="submit" class="btn btn-primary" name="btn_submit" value="Submit"></input>
                        </div>
                      </form>
                    </div>
                  </div>
                </div> -->
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

                      <form role="form" method="POST" id="edit-form" action="/userUpdate" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('PUT')}}

                        <div class="modal-body">
                            <div class="box-body">
                              <div class="form-group">

                                
                                <input type="hidden" class="form-control" id="in_id" name="id_user">
                                
                                <label for="in_nama">Nama</label>
                                <input type="text" class="form-control" id="in_name" name="nama">

                                <label for="in_jk">Jenis Kelamin</label><br>
                                <select name="jk" class="form-control" id="in_jk">
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                                </select>

                                <label for="in_alamat">Alamat</label>
                                <textarea name="alamat" id="in_alamat" class="form-control"></textarea>

                                <label for="in_kode">Email</label>
                                <input type="text" class="form-control" id="in_email" name="email">

                                <label for="in_password">Password</label>
                                <input type="password" class="form-control" placeholder="Masukan password baru" name="password">
                              </div><!-- /.box-body -->
                            </div>
                        </div>
                        <div class="modal-footer">
                          <!-- <button type="submit" style="float:right;" class="btn btn-success" name="btn_udate2">Update</button> -->
                          <input type="submit" name="btnUpdate" style="float:right;" class="btn btn-primary" value="Update">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- END MODAL -->
                <div class="input-group" style="width: 250px;">
                    <input class="form-control form-control-sm" type="text">
                    <span class="input-group-addon"><a href="#"><i class="fa fa-search"></i></a></span>
                </div> <br>

                <table id="detailTable" class="table table-sm table-bordered table-hover attrTable">
                    <tr>
                      <th class="attrName">Nama</th>
                      <th class="attrName">Jenis Kelamin</th>
                      <th class="attrName">Alamat</th>
                      <th class="attrName">Email</th>
                      <th class="attrName">Action</th>
                    </tr>

                      @foreach($user as $d)
                      <tr class="row_data">
                        <td class="td_nama">{{ $d->nama }}</td>
                        <td class="td_jk">{{ $d->jk }}</td>
                        <td class="td_stelp">{{ $d->alamat }}</td>
                        <td class="td_email">{{ $d->email }}</td>
                        <td>
                          <button type="button" class="btn btn-success" id="edit-item"
                          data-item-id="{{$d->id_user}}"
                          data-item-nama="{{$d->nama}}"
                          data-item-jk="{{$d->jk}}"
                          data-item-alamat="{{$d->alamat}}"
                          data-item-email="{{$d->email}}"
                          data-toggle="modal" data-target="#editModal">Edit</button>
                          <a href="/admin/user/hapus/{{ $d->id_user }}" onClick="return confirm('Are you sure want to delete?')">
                            <input type="submit" name="btnDelete" class="btn btn-danger" value="Delete">
                          </a>
                        </td>
                      </tr>
                      @endforeach
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
             var edit_id=button.data('item-id');
             var edit_nama=button.data('item-nama');
             var edit_jk=button.data('item-jk');
             var edit_alamat=button.data('item-alamat');
             var edit_email=button.data('item-email');

             var modal=$(this)

             modal.find('.modal-body #in_id').val(edit_id);
             modal.find('.modal-body #in_nama').val(edit_nama);
             modal.find('.modal-body #in_jk').val(edit_jk);
             modal.find('.modal-body #in_alamat').val(edit_alamat);
             modal.find('.modal-body #in_email').val(edit_email);


             // ========================================

             // var el=$(".edit-item-trigger-clicked");

             // var row=el.closest(".row_data");

             //alert(row);

             //var myJSON=JSON.stringify(row);



             // var id=row.children(".td_id");
             // var harga=row.children(".td_harga");
             // var tujuan=row.children(".td_tujuan").text();
             // var kode=row.children(".td_kode").text();

             //alert(id);

             // $('#in_id').val("P00001");
             // $('#in_harga').val("100000");
             // $('#in_tujuan').val("Jakarta");
             // $('#in_kode').val("KT001");

             })

             //on modal hide
             $('#editModal').on('hide.bs.modal',function() {
               //alert("mdoal hide");
               $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked');
               $("#editForm").trigger("reset");
           })

         })

     </script>

</body>
</html>
