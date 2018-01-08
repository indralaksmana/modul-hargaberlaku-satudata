@extends('hargaberlaku::layout')

@section('title','Satu Data | Harga Berlaku')

@section('content')
    <div class="container">
        {!! $header !!}
        <div class="card">
            <div class="card-header">
                <h4>Daftar PDRB Harga Berlaku<small>&nbsp;Daftar PDRB Harga Berlaku yang telah dibuat.</small></h4>
            </div>

            <div class="card-body card-padding">
                <table id="table1" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kota</th>
                        @foreach($year as $item)
                            <th>{!! $item->tahun !!}</th>
                        @endforeach
                        {{--<th style="width: 50px; text-align: center"><center>Aksi</center></th>--}}
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var tbl = $('#table1').DataTable({
                    // "order": [[ 0, "desc" ]],
                    // "aoColumns": [],
                    "ordering": false,
                    "searching": false,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "{!! route('hargaberlaku.list') !!}",
                    "fnServerData": function( sUrl, aoData, fnCallback, oSettings ) {
                        oSettings.jqXHR = $.ajax({
                            "url": sUrl,
                            "data": aoData,
                            "success": fnCallback,
                            "dataType": "jsonp",
                            "cache": false
                        });
                    },
                    "fnDrawCallback": function (e) {
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            });
        });
    </script>
@endpush