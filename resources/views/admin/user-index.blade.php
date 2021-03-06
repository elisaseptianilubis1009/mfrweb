@extends('/layouts/adminlayout')

@section('modal')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" id="myForm" action="{{url('/save')}}">
        @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group row">
                <label for="nama" class="col-sm-3 text-right control-label col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-3 text-right control-label col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-3 text-right control-label col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="foto" class="col-sm-3 text-right control-label col-form-label">Foto</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
            </div>
            <div class="form-group row">
                <label for="foto2" class="col-sm-3 text-right control-label col-form-label"></label>
                <div class="col-sm-9">
                    <img id="foto2" height="100" width="100" src="{{url('/storage/kegiatan/default.jpg')}}">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="button" id="btn-simpan" class="btn btn-primary">Simpan</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('container')
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" id="tabel">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data</h5>
            <div class="table-responsive">
                <div class="col-sm-12 col-md-6">
                    <label>
                        Search:<br>
                        <input type="search" id="cari" class="form-control form-control-sm">
                    </label>
                </div>
                <table class="table table-striped table-bordered">
                    <thead id="tabel-head">
                        
                    </thead>
                    <tbody id="tabel-body">
                        
                    </tbody>    
                </table>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<script type="text/javascript">

    let mf = new MyFetch();

    let id = document.getElementById('id');
    let name = document.getElementById('name');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let foto = document.getElementById('foto');
    let foto2 = document.getElementById('foto2');
      
    function isi(data2) {
        let thead = document.getElementById('tabel-head');
        thead.innerHTML = `
            <tr>
                <th style="text-align: center;" scope="col">No</th>
                <th style="text-align: center;" scope="col">Nama</th>
                <th style="text-align: center;" scope="col">Email</th>
                <th style="text-align: center;" scope="col">Foto</th>
                <th style="text-align: center;" scope="col">
                    <a data-toggle="modal" data-target="#exampleModal" id="btn-tambah" class="btn btn-primary text-white mt-2 btn-tambah">Tambah</a>
                </th>
            </tr>
        `;
        let tbody = document.getElementById('tabel-body');
        tbody.innerHTML = "";
        for (var i = 0; i < data2.length; i++) {
            let foto = '/storage/user/default.jpg';
            if (data2[i].foto != null) {
                foto = '/storage/' + data2[i].foto;
            }
            tbody.innerHTML += `
                <tr>
                    <td style="text-align: center;">` + (i + 1) + `</td>
                    <td style="text-align: center;">` + data2[i].name + `</td>
                    <td style="text-align: center;">` + data2[i].email + `</td>
                    <td class="text-center">
                        <img height="100" width="100" src="${foto}">
                    </td>
                    <td style="text-align: center;">
                        <a data-toggle="modal" data-id="` + data2[i].id + `" data-target="#exampleModal" class="btn btn-sm btn-success text-white btn-ubah">Ubah</a>
                        <a data-id="` + data2[i].id + `" class="btn btn-sm btn-danger btn-hapus">Hapus</a>
                    </td>
                </tr>
            `;
        }
    }

    async function loadData() {
        let data = await mf.getData('/api/user');
        isi(data);
    }
    loadData();

    let btnSimpan = document.getElementById('btn-simpan');
    btnSimpan.addEventListener('click', async function() {
        let myForm = document.getElementById('myForm');
        let dataForm = new FormData(myForm);
        let simpan = await mf.postData(myForm.action, dataForm);
        if (simpan) {
            loadData();
        }else{
            alert('Gagal menyimpan');
        }
        $('#exampleModal').modal('hide');
    })

    document.addEventListener('click',async function(e) {
        if (e.target.classList.contains('btn-tambah')) {
            $('#exampleModal').modal('show');  
            let myForm = document.getElementById('myForm');
            myForm.setAttribute('action', '/api/user');
            id.value = "";
            name.value = "";
            email.value = "";
            foto.value = "";
            password.value = "";
            foto2.src = "/storage/user/default.jpg";
        }
    });

    
    document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('btn-hapus')) {
            let result = confirm('Hapus data?');
            let idUser = e.target.dataset.id;
            if (result == true) {
                let hapus = await mf.deleteData('/api/user/delete/' + idUser);
                if (hapus) {
                    loadData();    
                }
            }else{
                alert('Data tidak ditemukan');
            }
        }
    });

    document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('btn-ubah')) {
            let idUser = e.target.dataset.id;
            let dataUser = await mf.getData('/api/user/detail/' + idUser);
            id.value = dataUser.id;
            name.value = dataUser.name;
            email.value = dataUser.email;
            password.value = dataUser.password;
            foto.value = "";
            if (dataUser.foto != null) {
                foto2.src = '/storage/' + dataUser.foto;
            } else {
                foto2.src = '/storage/user/default.jpg';
            }
            let myForm = document.getElementById('myForm');
            myForm.setAttribute('action', '/api/user/' + dataUser.id);
        }
    });
</script>
@endsection