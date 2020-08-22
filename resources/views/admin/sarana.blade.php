@extends('/admin/template')

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
                        <input type="text" class="form-control" id="sarana" name="sarana">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 text-right control-label col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
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
    <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Tables</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
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
                        <div class="row mb-3">
                            <div class="col-4">
                                <input type="text" name="cari" id="cari" class="form-control" placeholder="cari">
                            </div>
                        </div>
                        <div class="table-responsive">
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
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    <script type="text/javascript">

        let mf = new MyFetch();

        let id = document.getElementById('id');
        let sarana = document.getElementById('sarana');
        let keterangan = document.getElementById('keterangan');
        let foto = document.getElementById('foto');
        let foto2 = document.getElementById('foto2');
          
        function isi(data2) {
            let thead = document.getElementById('tabel-head');
            thead.innerHTML = `
                <tr>
                    <th style="text-align: center;" scope="col">No</th>
                    <th style="text-align: center;" scope="col">Sarana</th>
                    <th style="text-align: center;" scope="col">Keterangan</th>
                    <th style="text-align: center;" scope="col">Foto</th>
                    <th style="text-align: center;" scope="col">
                        <a data-toggle="modal" data-target="#exampleModal" id="btn-tambah" class="btn btn-primary text-white mt-2 btn-tambah">Tambah</a>
                    </th>
                </tr>
            `;
            let tbody = document.getElementById('tabel-body');
            tbody.innerHTML = "";
            for (var i = 0; i < data2.length; i++) {
                let foto = '/storage/sarana/default.jpg';
                if (data2[i].foto != null) {
                    foto = '/storage/' + data2[i].foto;
                }
                tbody.innerHTML += `
                    <tr>
                        <td style="text-align: center;">` + (i + 1) + `</td>
                        <td style="text-align: center;">` + data2[i].sarana + `</td>
                        <td style="text-align: center;">` + data2[i].keterangan + `</td>
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
            let data = await mf.getData('/api/sarana');
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
                myForm.setAttribute('action', '/api/sarana');
                id.value = "";
                sarana.value = "";
                keterangan.value = "";
                foto.value = "";
                foto2.src = "/storage/sarana/default.jpg";
            }
        });

        
        document.addEventListener('click', async function(e) {
            if (e.target.classList.contains('btn-hapus')) {
                let result = confirm('Hapus data?');
                let idSarana = e.target.dataset.id;
                if (result == true) {
                    let hapus = await mf.deleteData('/api/sarana/delete/' + idSarana);
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
                let idSarana = e.target.dataset.id;
                let dataSarana = await mf.getData('/api/sarana/detail/' + idSarana);
                id.value = dataSarana.id;
                sarana.value = dataSarana.sarana;
                keterangan.value = dataSarana.keterangan;
                foto.value = "";
                if (dataSarana.foto != null) {
                    foto2.src = '/storage/' + dataSarana.foto;
                } else {
                    foto2.src = '/storage/sarana/default.jpg';
                }
                let myForm = document.getElementById('myForm');
                myForm.setAttribute('action', '/api/sarana/' + dataSarana.id);
            }
        });
    </script>
    @endsection