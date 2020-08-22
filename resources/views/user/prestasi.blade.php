@extends('/user/single-blog')

@section('post')
<div class="section-top-border">
	<h3 class="mb-30">Prestasi Santri</h3>
	<aside class="single_sidebar_widget search_widget">
		<div class="row">
            <div class="form-group col-3">
               <div class="input-group mb-3">
                	<select class="form-control" id="select-periode">
                  		
                	</select>
               </div>
            </div>	
            <div class="col-5"></div>
            <div class="form-group col-4">
               <div class="input-group mb-3">
                  <input type="text" id="cari" class="form-control" placeholder='Search Keyword'
                     onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                  <div class="input-group-append">
                     <button class="btn" type="button"><i class="ti-search"></i></button>
                  </div>
               </div>
            </div>	
		</div>
    </aside>
	<div class="progress-table-wrap">
		<table class="table table-strip" id="tabel-body">
			
		</table>
	</div>
</div>

<script type="text/javascript">

	let data = "";
	let id = document.getElementById('id');
	let nama = document.getElementById('nama');
	let alamat = document.getElementById('alamat');


	let mf = new MyFetch();
	  
	function isi(data2) {
	    let tbody = document.getElementById('tabel-body');
	    tbody.innerHTML = `
	    	<tr class="table-head">
				<td class="serial">No</td>
				<td class="country">Kegiatan</td>
				<td class="visit">Tahun</td>
				<td class="percentage">Prestasi</td>
			</tr>
	    `;
	    for (var i = 0; i < data2.length; i++) {
	        tbody.innerHTML += `
	        	<tr class="table-row">
					<td class="serial">${i + 1}</td>
					<td>${data2[i].kegiatan}</td>
					<td>${data2[i].tahun}</td>
					<td>${data2[i].prestasi}</td>	
				</tr>
	        `;
	    }
	}


	async function loadData(){
        data = await mf.getData('/api/prestasi');
	    isi(data);
	}

	loadData();

	let pilihPeriode = document.getElementById('select-periode');
	pilihPeriode.addEventListener('change', function() {
	    loadData();
	})

	let cari = document.getElementById('cari');
	cari.addEventListener('keyup', async function() {
	    let periode = document.getElementById('select-periode').value;
	    if (this.value == "") {
	        loadData();
	    }else{
	        data = await myFetch.getData('/santri/like/'+ periode + '/' + this.value);
	        isi(data)
	    }
	})

</script>
@endsection