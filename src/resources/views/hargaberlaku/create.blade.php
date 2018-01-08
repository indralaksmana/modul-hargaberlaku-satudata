@extends('hargaberlaku::layout')

@section('title','Satu Data | Harga Berlaku')

@section('content')
    <div class="container">
        {!! $header !!}
        <div class="card">
            <div class="card-header">
                <h4>Tambah PDRB Harga Berlaku <small>&nbsp;Tambah PDRB Harga Berlaku yang anda butuhkan dengan mengisi form di bawah.</small></h4>
            </div>
            <div class="card-body card-padding">
                <form id="formValidate" action="{{ route('hargaberlaku.create.save')  }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-float">
                                <div class="fg-line">
                                    <select class="selectpicker form-control" data-live-search="true" id="hargaberlakuProvinceKode" name="hargaberlakuProvinceKode" title='Pilih Provinsi' data-validate="required" data-message-required="Opsi ini wajib diisi">
                                        @foreach($provinsis as $provinsi)
                                            <option value="{{ $provinsi->provinsi_kode }}" @if($provinsi->provinsi_kode == '36') selected @endif>{{ $provinsi->provinsi_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-float">
                                <div class="fg-line">
                                    <select class="selectpicker form-control" data-live-search="true" id="hargaberlakuKotaKode" name="hargaberlakuKotaKode" title='Pilih Kota' data-validate="required" data-message-required="Opsi ini wajib diisi"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-float">
                                <label class="fg-label">Tanggal</label>
                                <div class="fg-line">
                                    <input type="text" class="form-control fg-input date-picker" id="hargaberlakuTgl" name="hargaberlakuTgl" data-validate="required" data-message-required="Opsi ini wajib diisi">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-float">
                                <label class="fg-label">Jumlah</label>
                                <div class="fg-line">
                                    <input id="hargaberlakuValue" name="hargaberlakuValue" class="form-control fg-input" value="" type="number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="{{ route('hargaberlaku') }}" class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-arrow-back"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            kota();

            $("#hargaberlakuTgl").datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });

        $('#hargaberlakuProvinceKode').change(function () {
            kota();
        });

        function kota() {
            var hargaberlakuProvinceKode = $('#hargaberlakuProvinceKode').val();
            $('#hargaberlakuKotaKode').empty();

            $.ajax({
                url: '{!! url('hargaberlaku/getKota') !!}/' + hargaberlakuProvinceKode,
                type: "GET",
                data:'_token = {{  csrf_token() }}',
                success: function (datas) {
                    var obj = new Object(datas);
                        // alert(datas[0].length);
                        // alert(Object.keys(datas).length);
                        // console.log(datas);
                    var select = document.querySelector('#hargaberlakuKotaKode');
                    for (var i = 0; i < Object.keys(datas).length; i++) {
                    //     // console.log(datas[i]);
                        select.innerHTML += "<option value='" + datas[i]['kota_kode'] + "'>" + datas[i]['kota_nama'] + "</option>";
                    }
                    $('#hargaberlakuKotaKode').selectpicker('refresh');
                }
            });
        }

        $(function(){
            $('#link-btn').on('click',function (e) {
                e.preventDefault();
                $('.link').show();
                $('.file-field').hide();
                $(this).hide();
            });
            $('#link-close').on('click',function (e) {
                e.preventDefault();
                $('#link-btn').show();
                $('.file-field').show();
                $(this).hide();
                $('.link').hide();
            });
        });
    </script>
@endpush