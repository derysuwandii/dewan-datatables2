<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
	<title>Dewan Datatables JSON - www.dewankomputer.com</title>
	<!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-dark bg-primary">
	  <a class="navbar-brand text-white" href="index.php">
	    Dewan Komputer
	  </a>
	</nav>
	
	<div class="container mb-5">
		<h2 align="center" style="margin: 30px;">Menampilkan Data dari File .json ke Tabel dengan Datatables</h2>

		<div class="table-responsive">
			<table id="data" class="table table-striped table-bordered" style="width:100%">
			</table>
		</div>

		<div id="viewModal" class="modal fade mr-tp-100" role="dialog">
		    <div class="modal-dialog modal-lg flipInX animated">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h4 class="modal-title" id="myModalLabel" >View Data</h4>
		                <button type="button" class="close" data-dismiss="modal" >
		                    <span aria-hidden="true">&times;</span>
		                    <span class="sr-only">Close</span>
		                </button>
		            </div>
		            <div class="modal-body">
		            	<div class="form-group">
		            		<label>ID</label>
		            		<input type="text" id="id" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Nama Mahasiswa</label>
		            		<input type="text" id="nama_mahasiswa" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Alamat</label>
		            		<input type="text" id="alamat" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Jurusan</label>
		            		<input type="text" id="jurusan" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Jenis Kelamin</label>
		            		<input type="text" id="jenis_kelamin" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Tanggal Masuk</label>
		            		<input type="text" id="tgl_masuk" class="form-control" readonly="">
		            	</div>
		            </div>
		            <div class="modal-footer">
		            	<button class="btn btn-default" data-dismiss="modal">
		            		Close
		            	</button>
		            </div>
		        </div>
		    </div>
		</div>
		
    </div>

    <div class="p-2 text-white bg-secondary text-center">© <?php echo date('Y'); ?> Copyright:
	    <a href="https://dewankomputer.com/"> Dewan Komputer</a>
	</div>
	
    <script src="js/jquery.min.js"></script>
    <script src="js/datatables.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {
	        var table = $('#data').DataTable({
		        responsive: true,
		        "ajax": {
		            "type": "POST",
		            "url": "data.json",
		            "timeout": 120000,
		            "dataSrc": function (json) {
		                if(json != null){
		                    return json
		                } else {
		                    return "";
		                }
		            }
		        },
		        "sAjaxDataProp": "",
		        "width": "100%",
		        "order": [[ 0, "asc" ]],
		        "aoColumns": [
		            {
		                "mData": null,
		                "title": "No",
		                render: function (data, type, row, meta) {
		                    return meta.row + meta.settings._iDisplayStart + 1;
		                }
		            },
		            {
		                "mData": null,
		                "title": "Nama Mahasiswa",
		                "render": function (data, row, type, meta) {
		                    return data.nama_mahasiswa;
		                }
		            },
		            {
		                "mData": null,
		                "title": "Alamat",
		                "render": function (data, row, type, meta) {
		                    return data.alamat;
		                }
		            },
		            {
		                "mData": null,
		                "title": "Jurusan",
		                "render": function (data, row, type, meta) {
		                    return data.jurusan;
		                }
		            },
		            {
		                "mData": null,
		                "title": "Jenis Kelamin",
		                "render": function (data, row, type, meta) {
		                    return data.jenis_kelamin;
		                }
		            },
		            {
		                "mData": null,
		                "title": "Tanggal Masuk",
		                "render": function (data, row, type, meta) {
		                    return data.tgl_masuk;
		                }
		            },
		            {
                        "mData": null,
                        "title": "Aksi",
                        "sortable": false,
                        "render": function (data, row, type, meta) {
                            let btn = '';

                            if(data.nama_mahasiswa != "Dery"){
                                btn += "<button style='font-size: 11px;' class='btn btn-primary' id='detail' name='detail' title='Lihat Detail'><i class='fa fa-search'></i></button>";
                            }

                            return btn;
                        }
                    }
		        ]
		    });

		    $('#data tbody').on( 'click', '#detail', function () {
		        var current_row = $(this).parents('tr');
		        if (current_row.hasClass('child')) {
		            current_row = current_row.prev();
		        }
		        var data = table.row( current_row ).data();

		        document.getElementById("id").value = data["id"];
		        document.getElementById("nama_mahasiswa").value = data["nama_mahasiswa"];
		        document.getElementById("alamat").value = data["alamat"];
		        document.getElementById("jurusan").value = data["jurusan"];
		        document.getElementById("jenis_kelamin").value = data["jenis_kelamin"];
		        document.getElementById("tgl_masuk").value = data["tgl_masuk"];

		        $("#viewModal").modal("show");
		    });

	    });
	</script>
</body>
</html>