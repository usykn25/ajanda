@extends('Backend/backend-master')
@section('css')
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! route('Schools') !!}">Okul Listesi</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Ekle</a></li>
        </ol>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Yeni Okul Ekle</h4>
                </div>
                <div class="card-body">
                    <form id="newSchoolForm">
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Okul Adı</label>
                            <input type="text" id="schoolName" name="schoolName" class="form-control" placeholder="Okul Adı" required>
                        </div>
                        <div class="custom_file_input mb-3">
                            <label class="col-sm-3 col-form-label">Okul Arma</label>
                            <div class="form-file">
                                <input type="file" name="schoolArma" id="schoolArma" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Şehir</label>
                            <select class=" form-control wide js-city-wrapper" name="cityId" required>
                                <option value="">Şehir Seçiniz</option>
                                @if($cities)
                                @foreach($cities as $city)
                                <option value="{{ $city->CityID }}">{{ $city->CityName }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">İlçe</label>
                            <select class=" form-control wide js-district-wrapper" name="DistrictID" id="DistrictID" required>
                                <option value="">Şehir Seçiniz</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Okul Durumu</label>
                            <select class=" form-control wide" name="status" required>
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                        <div>
                            <button type="button" id="saveButton" class="btn btn-success" data-loading-text="<i class='fas fa-circle-notch fa-spin'></i>" style="float: right;width: 160px;">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    $('.js-city-wrapper').on('change',function(e){
        e.preventDefault();
        const cityID = $(this).val();
        const $targetElement = $('.js-district-wrapper');
        if(cityID){
            $.ajax({
                type: 'GET',
                url: "{!! route('GetDistrictByCity') !!}",
                data: {
                    'CityID': cityID
                },
                dataType: 'json',
                success: function (response) {
                    $targetElement.removeClass('d-none');
                    $targetElement.find('option').remove();
                    if (response && response.DistrictList) {
                        $targetElement.append('<option value="">İlçe Seçiniz.</option>');
                        $.each(response.DistrictList, function (i, e) {
                            $targetElement.append($('<option>', {
                                value: e.DistrictID,
                                text: e.DistrictName
                            }));
                        });
                    }else{
                        $targetElement.removeClass('d-none');
                        $targetElement.find('option').remove();
                        $targetElement.append('<option value="">İlçe bilgisi bulunamadi.</option>');
                    }
                },error: function (){
                    $targetElement.removeClass('d-none');
                    $targetElement.find('option').remove();
                    $targetElement.append('<option value="">İlçe bilgisi bulunamadi.</option>');
                }
            });
        }
    });
    $('#saveButton').on('click', function() {
        $(this).prop( "disabled", true );
        if($('#schoolName').val() == ''){
            toastr['warning']('Okul adı boş bırakılamaz.', 'Uyarı !')
            $(this).prop( "disabled", false );
            return;
        }
        if($('#DistrictID').val() == ''){
            toastr['warning']('İlçe boş bırakılamaz.', 'Uyarı !')
            $(this).prop( "disabled", false );
            return;
        }
        if($('#schoolArma').val() == ''){
            toastr['warning']('Okul arması boş bırakılamaz.', 'Uyarı !')
            $(this).prop( "disabled", false );
            return;
        }
        var form = $('#newSchoolForm')[0];
        var formData = new FormData(form);
        formData.append( 'schoolArma', $('#schoolArma')[0].files );
        $.ajax({
            type: 'POST',
            url: "{!! route('SchoolAdd') !!}",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
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