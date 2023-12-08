@extends('Backend/backend-master')
@section('css')

@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ürünler</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Listele</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-3">

            <div class="card">
                <div class="card-body">
                    <form action="{!! route('Products') !!}" method="get">
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Kategori</label>
                            <select class=" form-control wide js-category-select" id="categoryId" name="categoryId">
                                <option value="">Seçiniz</option>
                                @if($categoriesOptionList)
                                {!! $categoriesOptionList !!}
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Okul Bilgisi</label>
                            <select class=" form-control wide" name="schoolId" id="schoolId">
                                <option value="">Seçiniz</option>
                                @if($SchoolList)
                                @foreach($SchoolList as $school)
                                <option value="{{ $school->id }}" {{ Request::get('schoolId') == $school->id ? 'selected' : null }}>{{ $school->schoolName }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Şehir</label>
                            <select class=" form-control wide js-city-wrapper" name="cityId">
                                <option value="">Şehir Seçiniz</option>
                                @if($cities)
                                    @foreach($cities as $city)
                                        <option value="{{ $city->CityID }}" {{ Request::get('cityId') == $city->CityID ? 'selected' : null }}>{{ $city->CityName }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">İlçe</label>
                            <select class=" form-control wide js-district-wrapper" name="DistrictID" id="DistrictID">
                                <option value="">Şehir Seçiniz</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Kumaş Tipi</label>
                                    <select class=" form-control wide" name="kumasTipId" id="kumasTipId">
                                        <option value="">Seçiniz</option>
                                        @foreach($kumastype as $att)
                                        <option value="{{ $att->id }}" {{ Request::get('kumasTipId') == $att->id ? 'selected' : null }}>{{ $att->text }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Ana Beden Kodu</label>
                                    <select class=" form-control wide" name="anaBedenCodeId" id="anaBedenCodeId">
                                        <option value="">Seçiniz</option>
                                        @foreach($anabedencode as $att)
                                        <option value="{{ $att->id }}" {{ Request::get('anaBedenCodeId') == $att->id ? 'selected' : null }}>{{ $att->text }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Renk Kodu</label>
                                    <select class=" form-control wide" name="productColorCodeId" id="productColorCodeId">
                                        <option value="">Seçiniz</option>
                                        @foreach($productcolorcode as $att)
                                        <option value="{{ $att->id }}" {{ Request::get('productColorCodeId') == $att->id ? 'selected' : null }}>{{ $att->text }} ({{ $att->code }})</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Cep Modeli</label>
                                    <select class=" form-control wide" name="cepModelId" id="cepModelId" >
                                        <option value="">Seçiniz</option>
                                        @foreach($cepmodel as $att)
                                        <option value="{{ $att->id }}" {{ Request::get('cepModelId') == $att->id ? 'selected' : null }}>{{ $att->text }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Ribana</label>
                                    <select class=" form-control wide" name="ribanaId" id="ribanaId">
                                        <option value="">Seçiniz</option>
                                        @foreach($ribana as $att)
                                        <option value="{{ $att->id }}" {{ Request::get('ribanaId') == $att->id ? 'selected' : null }}>{{ $att->text }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Kol Tipi</label>
                                    <select class=" form-control wide" name="kolTipiId" id="kolTipiId">
                                        <option value="">Seçiniz</option>
                                        @foreach($koltipi as $att)
                                        <option value="{{ $att->id }}" {{ Request::get('kolTipiId') == $att->id ? 'selected' : null }}>{{ $att->text }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label">Ürün Bel Lastiği</label>
                                    <select class=" form-control wide" name="belLastikId" id="belLastikId">
                                        <option value="">Seçiniz</option>
                                        @foreach($bellastik as $att)
                                        <option value="{{ $att->id }}" {{ Request::get('belLastikId') == $att->id ? 'selected' : null }}>{{ $att->text }}</option>
                                        @endforeach
                                    </select>
                        </div>

                        <div>
                            <button type="submit" id="searchButton" value="true" name="ApplyFilter" class="btn btn-success" style="float: right;width: 160px;">Ara</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                @if($products)
                @foreach($products as $product)
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent" style="">
                                    <img class="img-fluid" src="{{ PUBLIC_DIR }}uploads/urun/{{ $product->gallery[0] }}" alt="" style="min-height: 150px;max-height: 150px;">
                                </div>
                                <div class="new-arrival-content text-center mt-3">
                                    <h6>{{ $product->school_name }}</h6>
                                    <h4>{{ $product->category_title }}</h4>
                                    <span class="price">{{ $product->product_name }}</span>
                                </div>
                                <hr>
                                <div class="d-flex" style="justify-content: center;">
                                    <a href="{!! route('ProductShow',['id'=>$product->product_id]) !!}" class="btn btn-info shadow  sharp me-1"><i class="fas fa-eye"></i></a>
                                    <a href="{!! route('ProductEdit',['id'=>$product->product_id]) !!}" class="btn btn-primary shadow  sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" onclick="productDelete({{ $product->product_id }});" class="btn btn-danger shadow  sharp"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            @if(isset($pageLinks) && $pageLinks)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <nav>
                                {!! $pageLinks !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection

@section('js')
<script>

    function productDelete(id){
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Ürün silinecektir!",
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
                        url: '{!! route("ProductDelete") !!}',
                        type: "POST",
                        data: { ProductID: id },
                        dataType: 'json',
                        success: function(s){
                            toastr[s.Type](s.Message, s.Title)
                            if(s.Redirect != null){
                                window.setTimeout( function(){
                                    window.location = s.Redirect
                                }, 500 );
                            }
                        }
                    });
                }
            }
        })
    }
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
    $(".js-city-wrapper").trigger("change");
    const myTimeout = setTimeout(myGreeting, 500);
    function myGreeting() {
        $("#categoryId").val({{ Request::get('categoryId') }}).change();
        $("#DistrictID").val({{ Request::get('DistrictID') }}).change();
    }
</script>
@endsection
