<!DOCTYPE html>
@include('components.library')
<html>
    <body>
        <div class="container">
            <div class="m-t-50">
                <h1 class="top-title">Sumatra Unggul Transaksi</h1>
            </div>
            <div class="data-tabels" id="data-tabels">
                <div class="row">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nama_customer</th>
                                <th>No Plat Kendaraan</th>
                                <th>Tanggal Mulai Sewa</th>
                                <th>Tanggal Selesai Sewa</th>
                                <th>Harga Sewa</th>
                                <th>Tanggal Buat Order</th>
                                <th>Tanggal Update Order</th>
                                <th>Action Delete</th>
                                <th>Action Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($transaksi) ; $i++)
                                <tr>
                                    <td class="text-center">{{ $transaksi[$i]->id }}</td>
                                    <td class="text-center">{{ $transaksi[$i]->nama_customer }}</td>
                                    <td class="text-center">{{ $transaksi[$i]->no_plat_kendaraan }}</td>
                                    <td class="text-center">{{ $transaksi[$i]->tanggal_mulai_sewa }}</td>
                                    <td class="text-center">{{ $transaksi[$i]->tanggal_selesai_sewa }}</td>
                                    <td class="text-center">Rp. {{ $transaksi[$i]->harga_sewa }}</td>
                                    <td class="text-center">{{ $transaksi[$i]->created_at }}</td>
                                    <td class="text-center">{{ $transaksi[$i]->updated_at }}</td>
                                    <td class="text-center">
                                        <form
                                            id="formDeleteTransaksi{{ $transaksi[$i]->id }}"
                                            action="{{ url('/delete/transaksi/'. $transaksi[$i]->id ) }}"
                                            class="form-delete-transaksi"
                                            method="POST"
                                        >
                                        @csrf
                                        @method('DELETE')
                                            <button id="delete-button-transaksi" class="delete-button" onclick="deleteTransaksi({{ $transaksi[$i]->id }})">
                                                DELETE
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button class="edit-button"  onclick="editTransaksi({{ $transaksi[$i]->id }}">
                                            EDIT
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="m-t-50">
                <h1 class="top-title">Sumatra Unggul Kendaraan</h1>
            </div>
            <div class="data-tabels" id="data-tabels">
                <div class="row">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>No Plat Kendaraan</th>
                                <th>Action Delete</th>
                                <th>Action Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($kendaraan) ; $i++)
                                <tr id="data{{ $kendaraan[$i]->id }}">
                                    <td class="text-center">{{ $kendaraan[$i]->id }}</td>
                                    <td class="text-center" id="no-plat-{{ $kendaraan[$i]->id }}">{{ $kendaraan[$i]->no_plat }}</td>
                                    <td class="text-center">
                                        <form
                                            id="formDeleteKendaraan{{ $kendaraan[$i]->id }}"
                                            action="{{ url('/delete/kendaraan/'. $kendaraan[$i]->id ) }}"
                                            class="form-delete-kendaraan"
                                            method="POST"
                                        >
                                        @csrf
                                        @method('DELETE')
                                            <button id="delete-button-kendaraan" class="delete-button" onclick="deleteKendaraan()">
                                                DELETE
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center"><button class="edit-button" onclick="editKendaraan({{ $kendaraan[$i]->id }}">EDIT</button></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="m-t-50">
                <h1 class="">
                    Insert Kendaraan Section
                </h1>
                <form action="{{ url('/add/kendaraan') }}" method="POST" class="form-insert" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="min-width :600px">
                        <input id="input-no-plat" class="input-form" type="text" name="plat_nomor" value="" placeholder="Plat Nomor Kendaraan" required>
                    </div>
                    <button class="button-submit" type="submit">Tambahkan Plat Nomor</button>
                </form>
            </div>
            <div class="m-t-50">
                <h1 class="">
                    Insert Section
                </h1>
                <form id="insertTransaksiForm" action="{{ url('/add/transaksi') }}" method="POST" class="form-insert-transaksi" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Customer</label>
                        <input id="nama" class="input-form" type="text" name="nama" value="" placeholder="Nama Customer" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">No Plat</label>
                        <select name="no_plat" id="no_plat">
                            @for($i = 0; $i < count($kendaraan) ; $i++)
                                <option value="{{ $kendaraan[$i]->no_plat }}">{{ $kendaraan[$i]->no_plat }}</option>
                            @endfor
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai_sewa">Tanggal Mulai Sewa</label>
                        <input id="tanggal_mulai_sewa" class="input-form" type="date" name="tanggal_mulai_sewa" value="" placeholder="Tanggal Mulai Sewa" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai_sewa">Tanggal Selesai Sewa</label>
                        <input id="tanggal_selesai_sewa" class="input-form" type="date" name="tanggal_selesai_sewa" value="" placeholder="Tanggal Selesai Sewa" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_sewa">Harga Sewa</label>
                        <input id="harga_sewa" class="input-form" type="text" name="harga_sewa" value="" placeholder="Harga Sewa" required>
                    </div>
                    <button class="button-submit" style="margin-top : 20px;" type="submit">Tambahkan Transaksi</button>
                </form>
            </div>
        </div>
    </body>
    <script>
        function deleteTransaksi(idTransaksi){
            var deleteForm = document.getElementByID("formDeleteTransaksi"+idTransaksi)
            deleteForm.submit();
        }
        function deleteKendaraan(idKendaraan){
            var deleteForm = document.getElementByID("formDeleteKendaraan"+idKendaraan)
            deleteForm.submit();
        }
        function editKendaraan(idKendaraan){
            var row = $("#data"+idKendaraan);
            $('#input-no-plat').val(row.find("#no-plat-"+idKendaraan).html())
        }
    </script>
</html>
