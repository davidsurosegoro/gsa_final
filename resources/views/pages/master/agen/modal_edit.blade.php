<div class="modal fade" id="modal-edit-agen" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        
    <form method="POST" action="{{ url('master/agen/update') }}" id="frm-save">
      
      <input type="hidden" name="id" id="idagen" value="">
      {{ csrf_field() }}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">FORM UBAH DATA AGEN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label>Nama Agen:</label>
                <input type="text" id="nama" name="nama" class="form-control form-control-solid" placeholder="Inpur Nama Agen" required>
              </div>
              
              <div class="form-group">
                <label>Kode Agen:</label>
                <input type="text" id="kode" name="kode" class="form-control form-control-solid" placeholder="Inpur Kode Agen" required>
              </div>
              
              <div class="form-group">
                <label>Alamat :</label>
                <input type="text" name="alamat" id="alamat" class="form-control form-control-solid" placeholder="Inpur Alamat Agen" >
              </div>
              <div class="form-group">
                <label>No Telp :</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control form-control-solid" placeholder="Inpur Nomor Telpon Agen" >
              </div>
              <div class="form-group">
                <label>Presentase Bagi Hasil :</label>
                <input type="number" name="presentase" id="presentase" class="form-control form-control-solid" placeholder="Input Presentase Bagi Hasil. . ." >
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-custom alert-outline-dark" role="alert">
                <div class="alert-icon">
                  <i class="flaticon-info"></i>
                </div>
                <div class="alert-text">Dibawah ini adalah isian untuk wilayah coverage agen. Mohon diisi dengan urutan ya</div>
                <div class="alert-close">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                      <i class="ki ki-close"></i>
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <div class="form-group row">
                <label class="col-md-12">Kota 1:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota1" name="idkota1" data-live-search="true" required>
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group row">
                <label class="col-md-12">Kota 3:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota3" name="idkota3" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group row">
                <label class="col-md-12">Kota 5:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota5" name="idkota5" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group row">
                <label class="col-md-12">Kota 7:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota7" name="idkota7" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
            <div class="form-group row">
              <label class="col-md-12">Kota 9:</label>
              <select style="width: 90%;" class="form-control select2" id="idkota9" name="idkota9" data-live-search="true">
                <option value="">--Pilih Kota--</option>
                @foreach($kota as $k)
                  <option value="{{ $k->id }}">{{ $k->nama}}</option>
                @endforeach
              </select>
            </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <div class="form-group row">
                <label class="col-md-12">Kota 2:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota2" name="idkota2" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group row">
                <label class="col-md-12">Kota 4:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota4" name="idkota4" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group row">
                <label class="col-md-12">Kota 6:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota6" name="idkota6" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group row">
                <label class="col-md-12">Kota 8:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota8" name="idkota8" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group row">
                <label class="col-md-12">Kota 10:</label>
                <select style="width: 90%;" class="form-control select2" id="idkota10" name="idkota10" data-live-search="true">
                  <option value="">--Pilih Kota--</option>
                  @foreach($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary font-weight-bold">SIMPAN</button>
        </div>
        
    </form>
      </div>
  </div>
</div>