@extends('Backend/backend-master')
@section('css')
<link rel="stylesheet" href="{!! get_asset('Backend/css/jquery.dataTables.min.css') !!}">
<style>
    .dataTables_filter { display: none; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Okullar</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Listele</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Okul Listesi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="width: 100%;" data-search="false">
                            <thead>
                            <tr>
                                <th>Okul No</th>
                                <th>Okul Adı</th>
                                <th data-orderable="false">Okul Arma</th>
                                <th>Okul İl/İlçe</th>
                                <th data-orderable="false">Okul Durumu</th>
                                <th data-orderable="false"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($schools)
                                    @foreach($schools as $school)
                                        <tr>
                                            <td>{{ $school->id }}</td>
                                            <td>{{ $school->schoolName }}</td>
                                            <td><div class="d-flex align-items-center"><img src="{{ PUBLIC_DIR }}uploads/school-arma/{{$school->schoolArma}}" class="rounded-lg me-2" width="48" alt=""/></div></td>
                                            <td>{{ $school->scCityDistrictName }}</td>
                                            <td><div class="d-flex align-items-center"><i class="fa fa-circle text-{{ $school->status == 1 ? 'success':'danger' }} me-1"></i> {{ $school->status == 1 ? 'Aktif':'Pasif' }}</div></td></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{!! route('ProductSchoolShow',['id'=>$school->id]) !!}" class="btn btn-info btn-xs shadow  sharp me-1"><i class="fas fa-eye"></i></a>
                                                    <a href="{!! route('SchoolEdit',['id'=>$school->id]) !!}" class="btn btn-primary btn-xs shadow  sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" onclick="schoolDelete({{ $school->id }})" class="btn btn-danger btn-xs shadow  sharp"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{!! get_asset('Backend/js/jquery.dataTables.min.js') !!}"></script>
<script>
    $(document).ready(function() {
        $('#example3 thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#example3 thead');
        $('#example3').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json',
            },
            "order": [[ 1, 'asc' ]],

            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var cell = $('.filters th').eq(
                        $(column.header()).index()
                    );
                    if($(column.header()).text() === 'Okul Durumu' || $(column.header()).text() === 'Okul Arma' || $(column.header()).text() === ''){
                        $(cell).html('');
                        return false;
                    }

                    if($(column.header()).text() === 'Okul İl/İlçe'){
                        $(cell).html('');
                        var select = $('<select><option value="">Seçiniz</option></select>')
                            .appendTo(  $(cell) )//$(column.header())
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    }
                    if($(column.header()).text() === 'Okul No' || $(column.header()).text() === 'Okul Adı' ){
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
                        $(
                            'input',
                            $('.filters th').eq($(column.header()).index())
                        )
                            .off('keyup change')
                            .on('change', function (e) {
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})';
                                column
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0];
                            });
                    }
                } );
            }
        });
    });
    function schoolDelete(id){
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Okul silinecektir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Vazgeç',
        }).then((result) => {
            if (result.value) {
                if(id){
                    $(this).prop( "disabled", true );
                    $.ajax({
                        url: '{!! route("SchoolDelete") !!}',
                        type: "POST",
                        data: { SchoolID: id },
                        dataType: 'json',
                        success: function(s){
                            toastr[s.Type](s.Message, s.Title)
                            if(s.Redirect != null){
                                window.setTimeout( function(){
                                    window.location = s.Redirect
                                }, 1500 );
                            }
                        }
                    });
                }
            }
        })
    }

</script>
@endsection
