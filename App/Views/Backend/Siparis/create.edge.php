@extends('Backend/backend-master')
@section('css')
<link rel="stylesheet" href="{{ PUBLIC_DIR }}/Backend/css/select2.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Sipariş</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Yeni Form Oluştur</a></li>
        </ol>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sipariş Formu Oluştur</h4>
                </div>
                <div class="card-body">
                    <form id="newSchoolForm">
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Müşteri Adı Soyadı</label>
                            <input type="text" id="nameSurname" name="nameSurname" class="form-control" placeholder="Müşteri Adı Soyadı" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Müşteri Telefon</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Müşteri Telefon" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Okul Bilgisi</label>
                            <select class=" form-control select select2-hidden-accessible select2-search--inline" name="schoolId[]" id="schoolId" multiple style="height: 120px !important;" required>
                                <option value="">Seçiniz</option>
                                @if($SchoolList)
                                @foreach($SchoolList as $school)
                                <option value="{{ $school->id }}">{{ $school->schoolName }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <button type="button" id="saveButton" class="btn btn-success" data-loading-text="<i class='fas fa-circle-notch fa-spin'></i>" style="float: right;width: 160px;">Oluştur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ PUBLIC_DIR }}/Backend/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select').select2({
            placeholder: 'Seçiniz',
        });
    });
    $('#saveButton').on('click', function() {
        $(this).prop( "disabled", true );
        if($('#schoolId').val() == ''){
            toastr['warning']('Okul Listesi boş bırakılamaz.', 'Uyarı !')
            $(this).prop( "disabled", false );
            return;
        }
        if($('#phone').val() == ''){
            toastr['warning']('Müşteri Telefon boş bırakılamaz.', 'Uyarı !')
            $(this).prop( "disabled", false );
            return;
        }
        if($('#nameSurname').val() == ''){
            toastr['warning']('Müşteri adı soyadı boş bırakılamaz.', 'Uyarı !')
            $(this).prop( "disabled", false );
            return;
        }
        var nameSurname= $('#nameSurname').val();
        var phone= $('#phone').val();
        var schoolId= $('#schoolId').val();
        $.ajax({
            type: 'POST',
            url: "{!! route('SiparisCreate') !!}",
            data: {
                nameSurname: nameSurname,
                phone: phone,
                schoolId: schoolId
            },
            dataType: 'json',
            success: function(s){
                toastr[s.Type](s.Message, s.Title)
                if(s.Redirect != null){
                    window.setTimeout( function(){
                        window.location = s.Redirect;
                    }, 1500 );
                }
            },error: function (){
                $(this).prop( "disabled", false );
                toastr['error']('Teknik bir hata oluştu yöneticiye başvurunuz', 'Teknik Hata')
            }
        });
    });
</script>
@endsection
