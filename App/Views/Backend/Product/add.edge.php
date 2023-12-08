@extends('Backend/backend-master')
@section('css')
<link rel="stylesheet" href="{{ PUBLIC_DIR }}/Backend/css/step.css">
<link rel="stylesheet" href="{{ PUBLIC_DIR }}/Backend/css/upload.css">
<style>
    .uploadifive-button {
        float: left;
        margin-right: 10px;
    }
    #queue {
        border: 1px solid #E5E5E5;
        height: 177px;
        overflow: auto;
        margin-bottom: 10px;
        padding: 0 3px 3px;
    }
    #uploadCompleted div img{
        max-height: 100px;
        min-height: 100px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! route('Products') !!}">Ürünler</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Ekle</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ürün Ekle</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <ul class="nav nav-wizard">
                            <li><a class="nav-link" href="#wizard_Service">
                                    <span>1</span>
                                </a></li>
                            <li><a class="nav-link" href="#wizard_Time">
                                    <span>2</span>
                                </a></li>
                            <li><a class="nav-link" href="#wizard_Details">
                                    <span>3</span>
                                </a></li>
                        </ul>
                        <form id="newProductForm">
                            <div class="tab-content">
                                <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                    <div class="row" style="margin-top: 15px;margin-left: 7px;">
                                        <h4>Ürün Ana Bilgileri</h4>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">Ürün Adı</label>
                                            <input type="text" id="productName" name="productName" class="form-control" placeholder="Ürün Adı" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">Ürün Kategori</label>
                                            <select class=" form-control wide js-category-select" id="categoryId" name="categoryId" required>
                                                <option value="">Seçiniz</option>
                                                @if($categoriesOptionList)
                                                {!! $categoriesOptionList !!}
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter a username.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">Okul Bilgisi</label>
                                            <select class=" form-control wide" name="schoolId" id="schoolId" required>
                                                <option value="">Seçiniz</option>
                                                @if($SchoolList)
                                                @foreach($SchoolList as $school)
                                                    <option value="{{ $school->id }}">{{ $school->schoolName }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">Ürün Barkodu</label>
                                            <input type="text" id="productBarkod" name="productBarkod" class="form-control" placeholder="Ürün Barkodu" required>
                                        </div>
                                    </div>
                                </div>
                                <div id="wizard_Time" class="tab-pane" role="tabpanel">
                                    <div class="row" style="margin-top: 15px;margin-left: 7px;">
                                        <h4>Ürün Bilgileri</h4>
                                        <div class="mb-3" id="divCinsiyet">
                                            <label class="col-sm-3 col-form-label">
                                                Ürün Cinsiyet
                                            </label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cinsiyet" id="inlineRadio11" value="1" checked>
                                                <label class="form-check-label" for="inlineRadio11">Bay</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cinsiyet" id="inlineRadio21" value="0">
                                                <label class="form-check-label" for="inlineRadio21">Bayan</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">
                                                Ürün File/Astar Durumu
                                            </label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="fileAstar" id="inlineRadio1" value="3" >
                                                <label class="form-check-label" for="inlineRadio1">File/Astar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="fileAstar" id="inlineRadio1" value="2" >
                                                <label class="form-check-label" for="inlineRadio1">File</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="fileAstar" id="inlineRadio2" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Astar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="fileAstar" id="inlineRadio2" value="0" checked>
                                                <label class="form-check-label" for="inlineRadio2">Yok</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">Ürün Kumaş Tipi</label>
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <select class=" form-control wide" name="kumasTipId" id="kumasTipId" required>
                                                        <option value="">Seçiniz</option>
                                                        @foreach($kumastype as $att)
                                                        <option value="{{ $att->id }}">{{ $att->text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a type="button" class="btn btn-rounded btn-info js-attribute-modal" style="width: 53px;" id="addkumasTipId" data-attribute-type="addkumasTipId"  data-bs-toggle="modal" data-bs-target="#attributeFormModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">Ürün Ana Beden Kodu</label>
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <select class=" form-control wide" name="anaBedenCodeId" id="anaBedenCodeId" required>
                                                        <option value="">Seçiniz</option>
                                                        @foreach($anabedencode as $att)
                                                        <option value="{{ $att->id }}">{{ $att->text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a type="button" class="btn btn-rounded btn-info js-attribute-modal" style="width: 53px;" id="addanaBedenCodeId" data-attribute-type="addanaBedenCodeId"  data-bs-toggle="modal" data-bs-target="#attributeFormModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-sm-3 col-form-label">Ürün Renk Kodu</label>
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <select class=" form-control wide" name="productColorCodeId" id="productColorCodeId" required>
                                                        <option value="">Seçiniz</option>
                                                        @foreach($productcolorcode as $att)
                                                        <option value="{{ $att->id }}">{{ $att->text }} ({{ $att->code }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a type="button" class="btn btn-rounded btn-info js-attribute-modal" style="width: 53px;" id="addproductColorCodeId" data-attribute-type="addproductColorCodeId"  data-bs-toggle="modal" data-bs-target="#attributeFormModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3" id="divcepModelId">
                                            <label class="col-sm-3 col-form-label">Ürün Cep Modeli</label>
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <select class=" form-control wide" name="cepModelId" id="cepModelId"  required>
                                                        <option value="">Seçiniz</option>
                                                        @foreach($cepmodel as $att)
                                                        <option value="{{ $att->id }}">{{ $att->text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a type="button" class="btn btn-rounded btn-info js-attribute-modal" style="width: 53px;" id="addcepModelId" data-attribute-type="addcepModelId"  data-bs-toggle="modal" data-bs-target="#attributeFormModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3" id="divribanaId">
                                            <label class="col-sm-3 col-form-label">Ürün Ribana</label>
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <select class=" form-control wide" name="ribanaId" id="ribanaId" required>
                                                        <option value="">Seçiniz</option>
                                                        @foreach($ribana as $att)
                                                        <option value="{{ $att->id }}">{{ $att->text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a type="button" class="btn btn-rounded btn-info js-attribute-modal" style="width: 53px;" id="addribanaId" data-attribute-type="addribanaId"  data-bs-toggle="modal" data-bs-target="#attributeFormModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3" id="divkolTipiId">
                                            <label class="col-sm-3 col-form-label">Ürün Kol Tipi</label>
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <select class=" form-control wide" name="kolTipiId" id="kolTipiId" required>
                                                        <option value="">Seçiniz</option>
                                                        @foreach($koltipi as $att)
                                                        <option value="{{ $att->id }}">{{ $att->text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a type="button" class="btn btn-rounded btn-info js-attribute-modal" style="width: 53px;" id="addkolTipiId" data-attribute-type="addkolTipiId"  data-bs-toggle="modal" data-bs-target="#attributeFormModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3" id="divbelLastikId">
                                            <label class="col-sm-3 col-form-label">Ürün Bel Lastiği</label>
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <select class=" form-control wide" name="belLastikId" id="belLastikId" required>
                                                        <option value="">Seçiniz</option>
                                                        @foreach($bellastik as $att)
                                                        <option value="{{ $att->id }}">{{ $att->text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a type="button" class="btn btn-rounded btn-info js-attribute-modal" style="width: 53px;" id="addbelLastikId" data-attribute-type="addbelLastikId"  data-bs-toggle="modal" data-bs-target="#attributeFormModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                    <div class="row" style="margin-top: 15px;margin-left: 7px;">
                                        <h4>Ürün Resim İşlemler</h4>
                                        <div class="mb-3 custom_file_input">
                                            <label class="col-lg-3 control-label text-semibold">Resim Galerisi:</label>
                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div id="queue"></div>
                                                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                                                        <a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Yükle</a>
                                                    </div>
                                                    <div class="col-md-9 ml-2">
                                                        <div id="uploadCompleted" class="row">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" id="saveButton" class="btn btn-success" data-loading-text="<i class='fas fa-circle-notch fa-spin'></i>" style="float: right;width: 160px;position: relative;right: 30px;">Ekle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="attributeFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attributeModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive-md" id="attributeTable">
                    <thead>
                    <tr>
                        <th><strong>Seçenek Adı</strong></th>
                        <th class="attributeImage"><strong>Resim</strong></th>
                        <th class="colorCode"><strong>Renk Kodu</strong></th>
                        <th><strong>Durumu</strong></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <hr>
                <div id="attNewDiv">
                    <h4>Yeni Ekle</h4>
                    <form action="" id="attributeForm" class="js-att-save-form" method="post">
                        <input type="hidden" id="attributeFormType" name="attributeFormType">
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Seçenek Adı</label>
                            <input type="text" id="text" name="text" class="form-control" placeholder="Seçenek Adı">
                        </div>
                        <div class="mb-3 colorCode" style="display: none;">
                            <label class="col-sm-3 col-form-label " >Renk Kodu</label>
                            <input type="text" id="code" name="code" class="form-control" placeholder="Renk Kodu" value="">
                        </div>
                        <div class="custom_file_input mb-3 attributeImage">
                            <label class="col-sm-3 col-form-label">Seçenek Resmi</label>
                            <div class="form-file">
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Seçenek Durumu</label>
                            <select class=" form-control wide" name="status" required>
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>

                    </form>
                    <button type="submit" form="attributeForm" class="btn btn-primary btn-xs edit-form-btn" style="float: right;">
                        Kaydet
                    </button>
                </div>
                <div id="attEditDiv" style="display: none;">
                    <h4>Düzenle</h4>
                    <form action="" id="attributeEditForm" class="js-att-edit-form" method="post">
                        <input type="hidden" id="attributeEditFormType" name="attributeFormType">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Seçenek Adı</label>
                            <input type="text" id="textEdit" name="text" class="form-control" placeholder="Seçenek Adı">
                        </div>
                        <div class="mb-3 colorCode" style="display: none;">
                            <label class="col-sm-3 col-form-label " >Renk Kodu</label>
                            <input type="text" id="codeEdit" name="code" class="form-control" placeholder="Renk Kodu" value="">
                        </div>
                        <div class="custom_file_input mb-3 attributeImage">
                            <label class="col-sm-3 col-form-label">Seçenek Resmi</label>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-file">
                                        <input type="file" name="image" id="imageEdit" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img id="editShowImage" src="" alt="" style="   width: 100%;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Seçenek Durumu</label>
                            <select class=" form-control wide" name="status" id="statusEdit" required>
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                    </form>
                    <button type="submit" form="attributeEditForm" class="btn btn-primary btn-xs edit-form-btn" style="float: right;">
                        Kaydet
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-bs-dismiss="modal">
                    Kapat
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ PUBLIC_DIR }}/Backend/js/jquery.step.js"></script>
<script src="{{ PUBLIC_DIR }}/Backend/js/step.js"></script>
<script src="{{ PUBLIC_DIR }}/Backend/js/upload.js"></script>
<script>

    $(document).ready(function(){
        /*if($('#productName').val()=='' && (window.location.hash !== "#wizard_Service")){
            window.location = '{{ route("ProductAdd") }}#wizard_Service'
        }*/
        <?php $timestamp = time();?>
        $(function() {
            $('#file_upload').uploadifive({
                'auto'             : false,
                'fileType'         : '.jpg,.jpeg,.gif,.png',
                'formData'         : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
                },
                'queueID'          : 'queue',
                'uploadScript'     : '{!! route("ProductimageUpload") !!}',
                'onUploadComplete' : function(file, data) {
                    var uploadDiv = $('#uploadCompleted');
                    var addrow ='<div class="col-md-4 mt-2">'
                        +'<span class="btn btn-danger shadow  sharp" onclick="$(this).parent().remove();" data-image-url="'+data+'" style="position:absolute;"><i class="fa fa-trash"></i></span>'
                        +'<img src="{{PUBLIC_DIR}}/uploads/urun/'+data+'" alt="" style="width: 100%;">'
                        +'<input type="hidden" class="imagex" name="image[]" value="'+data+'">'
                        +'</div>';
                    uploadDiv.append(addrow);
                }
            });
        });
        $('#smartwizard').smartWizard();
        $('.js-category-select').on('change',function(e) {
            e.preventDefault();
            const catId = $(this).val();
            if(catId){
                if(catId == 24){
                    $("#divcepModelId").css("display", "none");
                }else{
                    $("#divcepModelId").css("display", "block");
                }
                if(catId == 24 || catId == 27){
                    $("#divribanaId").css("display", "none");
                    $("#divkolTipiId").css("display", "none");
                    $("#divbelLastikId").css("display", "block");
                }else{
                    $("#divribanaId").css("display", "block");
                    $("#divkolTipiId").css("display", "block");
                    $("#divbelLastikId").css("display", "none");
                }
                if(catId == 27){
                    $("#divCinsiyet").css("display", "block");
                }else{
                    $("#divCinsiyet").css("display", "none");
                }
            }
        });
        $('.sw-btn-next').on('click',function (e){
            e.preventDefault();
            if($('#productName').val()==''){
                toastr['warning']('Ürün Adı Zorunludur!', 'Uyarı !');
                $('.sw-btn-prev')[0].click();
                $('.nav-wizard li a').removeClass('active')
                $('.nav-wizard li a').removeClass('done')
            }
            if($('#categoryId').val()==''){
                toastr['warning']('Ürün Kategorisi Zorunludur!', 'Uyarı !');
                $('.sw-btn-prev')[0].click();
                $('.nav-wizard li a').removeClass('active')
                $('.nav-wizard li a').removeClass('done')
            }
            if($('#schoolId').val()==''){
                toastr['warning']('Ürün Okul Bilgisi Zorunludur!', 'Uyarı !');
                $('.sw-btn-prev')[0].click();
                $('.nav-wizard li a').removeClass('active')
                $('.nav-wizard li a').removeClass('done')
            }
            if($('#productBarkod').val()==''){
                toastr['warning']('Ürün Barkod Girişi Zorunludur!', 'Uyarı !');
                $('.sw-btn-prev')[0].click();
                $('.nav-wizard li a').removeClass('active')
                $('.nav-wizard li a').removeClass('done')
            }
        });
        $(".js-attribute-modal").on("click", function (e) {
            e.preventDefault();
            const attributeType = $(this).data("attribute-type");
            $('#attributeFormType').val(attributeType);
            $('#attributeEditFormType').val(attributeType);
            if(attributeType == 'addkumasTipId'){
                $('#attributeFormModal h5').text('Kumaş Tipleri');
                $(".attributeImage").css("display", "none");
                $(".colorCode").css("display", "none");
            }
            if(attributeType == 'addanaBedenCodeId'){
                $('#attributeFormModal h5').text('Ana Beden Kodları');
                $(".attributeImage").css("display", "none");
                $(".colorCode").css("display", "none");
            }
            if(attributeType == 'addproductColorCodeId'){
                $('#attributeFormModal h5').text('Ürün Ana Renkleri');
                $(".attributeImage").css("display", "none");
                $(".colorCode").css("display", "");
            }
            if(attributeType == 'addcepModelId'){
                $('#attributeFormModal h5').text('Cep Modelleri');
                $(".attributeImage").css("display", "");
                $(".colorCode").css("display", "none");
            }
            if(attributeType == 'addribanaId'){
                $('#attributeFormModal h5').text('Ribanalar');
                $(".attributeImage").css("display", "");
                $(".colorCode").css("display", "none");
            }
            if(attributeType == 'addkolTipiId'){
                $('#attributeFormModal h5').text('Kol Tipleri');
                $(".attributeImage").css("display", "");
                $(".colorCode").css("display", "none");
            }
            if(attributeType == 'addbelLastikId'){
                $('#attributeFormModal h5').text('Bel Lastik Tipleri');
                $(".attributeImage").css("display", "");
                $(".colorCode").css("display", "none");
            }
            $.ajax({
                type: 'GET',
                url: "{!! route('GetAttribute') !!}",
                data: {
                    'AtrributeName': attributeType
                },
                dataType: 'json',
                success: function (response) {
                    $('#attributeTable tbody').empty();
                    if (response) {
                        $.each(response, function (i, e) {
                            /*console.log(e);*/
                            var row = '<tr>';
                            row += '<td><div class="d-flex align-items-center">'+e.text+'</div></td>';
                            if($(".attributeImage").css("display") == 'table-cell'){
                                row += '<td class="attributeImage"><div class="d-flex align-items-center"><img src="{{ PUBLIC_DIR}}/uploads/urun-ozellik/'+e.image+'" class="rounded-lg me-2" width="48" alt=""/></div></td>';
                            }
                            if($(".colorCode").css("display") == 'table-cell'){
                                row += '<td><div class="d-flex align-items-center">'+e.code+'</div></td>';
                            }
                            if(e.status == 1){
                                row += '<td><div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> Aktif</div></td>';
                            }
                            if(e.status == 0){
                                row += '<td><div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> Pasif</div></td>';
                            }
                            row += '<td><div class="d-flex"><a onclick="getEditAtt('+e.id+',\''+attributeType+'\')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a  onclick="attDelete('+e.id+',\''+attributeType+'\')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div></td>';
                            row += '</tr>';
                            $('#attributeTable tbody').append(row);
                        });
                    }
                }
            });
        });
        $(".js-att-save-form").submit(function(e){
            e.preventDefault();
            $('form button').prop("disabled", true);
            var attributeType = $('#attributeFormType').val();
            var attType = $('#attributeFormType').val();
            if($('#text').val()==''){
                toastr['warning']('Seçenek Adı Zorunludur!', 'Uyarı !');
                $('form button').prop("disabled", true);
                return;
            }
            if($('#image').val()=='' && $(".attributeImage").css("display") == 'table-cell'){
                toastr['warning']('Seçenek Resmi Zorunludur!', 'Uyarı !');
                $('form button').prop("disabled", true);
                return;
            }

            var form = $('.js-att-save-form')[0];
            var formData = new FormData(form);
            formData.append( 'image', $('#image')[0].files );
            $.ajax({
                type: 'POST',
                url: "{!! route('ProductAttAdd') !!}",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (s) {
                    toastr[s.Type](s.Message, s.Title);if(s.IsSuccess){
                        $.ajax({
                            type: 'GET',
                            url: "{!! route('GetAttribute') !!}",
                            data: {
                                'AtrributeName': attType
                            },
                            dataType: 'json',
                            success: function (response) {
                                var x = null;
                                if(attType == 'addkumasTipId'){
                                    x = document.getElementById("kumasTipId");
                                }
                                if(attType == 'addanaBedenCodeId'){
                                    x = document.getElementById("anaBedenCodeId");
                                }
                                if(attType == 'addproductColorCodeId'){
                                    x = document.getElementById("productColorCodeId");
                                }
                                if(attType == 'addcepModelId'){
                                    x = document.getElementById("cepModelId");
                                }
                                if(attType == 'addribanaId'){
                                    x = document.getElementById("ribanaId");
                                }
                                if(attType == 'addkolTipiId'){
                                    x = document.getElementById("kolTipiId");
                                }
                                if(attType == 'addbelLastikId'){
                                    x = document.getElementById("belLastikId");
                                }
                                $(x).empty()
                                    .append('<option value="" selected>Seçiniz</option>')
                                    .val('');
                                if (response) {
                                    $.each(response, function (i, e) {
                                        var option = document.createElement("option");
                                        /*console.log(e);*/
                                        option.text = e.text;
                                        option.id = e.id;
                                        if(attType == 'addproductColorCodeId'){
                                            option.text = e.text+'('+e.code+')';
                                        }
                                        x.add(option, x[0]);
                                    });
                                    $(".btn-close").click();
                                    $('.js-att-save-form')[0].reset();
                                }
                            }
                        });

                    }
                }
            });
        });
        $(".js-att-edit-form").submit(function(e){
            e.preventDefault();
            $('form button').prop("disabled", true);
            var attributeType = $('#attributeEditFormType').val();
            var attType = $('#attributeEditFormType').val();
            if($('#textEdit').val()==''){
                toastr['warning']('Seçenek Adı Zorunludur!', 'Uyarı !');
                $('form button').prop("disabled", true);
                return;
            }

            var form = $('.js-att-edit-form')[0];
            var formData = new FormData(form);
            formData.append( 'image', $('#imageEdit')[0].files );
            $.ajax({
                type: 'POST',
                url: "{!! route('ProductAttEdit') !!}",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (s) {
                    toastr[s.Type](s.Message, s.Title);
                    if(s.IsSuccess){
                        $.ajax({
                            type: 'GET',
                            url: "{!! route('GetAttribute') !!}",
                            data: {
                                'AtrributeName': attType
                            },
                            dataType: 'json',
                            success: function (response) {
                                var x = null;
                                if(attType == 'addkumasTipId'){
                                    x = document.getElementById("kumasTipId");
                                }
                                if(attType == 'addanaBedenCodeId'){
                                    x = document.getElementById("anaBedenCodeId");
                                }
                                if(attType == 'addproductColorCodeId'){
                                    x = document.getElementById("productColorCodeId");
                                }
                                if(attType == 'addcepModelId'){
                                    x = document.getElementById("cepModelId");
                                }
                                if(attType == 'addribanaId'){
                                    x = document.getElementById("ribanaId");
                                }
                                if(attType == 'addkolTipiId'){
                                    x = document.getElementById("kolTipiId");
                                }
                                if(attType == 'addbelLastikId'){
                                    x = document.getElementById("belLastikId");
                                }
                                $(x).empty()
                                    .append('<option value="" selected>Seçiniz</option>')
                                    .val('');
                                if (response) {
                                    $.each(response, function (i, e) {
                                        var option = document.createElement("option");
                                        /*console.log(e);*/
                                        option.text = e.text;
                                        option.id = e.id;
                                        if(attType == 'addproductColorCodeId'){
                                            option.text = e.text+'('+e.code+')';
                                        }
                                        x.add(option, x[0]);
                                    });
                                    $(".btn-close").click();
                                    $('.js-att-edit-form')[0].reset();
                                    $("#attEditDiv").css("display", "none");
                                    $("#attNewDiv").css("display", "");
                                }
                            }
                        });

                    }
                }
            });
        });
        $('#attributeFormModal').on('hidden.bs.modal', function () {
            $("#attEditDiv").css("display", "none");
            $("#attNewDiv").css("display", "");
            $('.js-att-save-form')[0].reset();
            $('.js-att-edit-form')[0].reset();
            $('#editShowImage').attr('src', '');
        });
    });
    function attDelete(id,attType){
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Seçenek silinecektir!",
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
                        url: '{!! route("ProductAttDelete") !!}',
                        type: "POST",
                        data: { id: id,attType:attType },
                        dataType: 'json',
                        success: function(s){
                            toastr[s.Type](s.Message, s.Title)
                            if(s.IsSuccess){
                                $.ajax({
                                    type: 'GET',
                                    url: "{!! route('GetAttribute') !!}",
                                    data: {
                                        'AtrributeName': attType
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        var x = null;
                                        if(attType == 'addkumasTipId'){
                                             x = document.getElementById("kumasTipId");
                                        }
                                        if(attType == 'addanaBedenCodeId'){
                                             x = document.getElementById("anaBedenCodeId");
                                        }
                                        if(attType == 'addproductColorCodeId'){
                                             x = document.getElementById("productColorCodeId");
                                        }
                                        if(attType == 'addcepModelId'){
                                             x = document.getElementById("cepModelId");
                                        }
                                        if(attType == 'addribanaId'){
                                             x = document.getElementById("ribanaId");
                                        }
                                        if(attType == 'addkolTipiId'){
                                             x = document.getElementById("kolTipiId");
                                        }
                                        if(attType == 'addbelLastikId'){
                                             x = document.getElementById("belLastikId");
                                        }
                                        $(x).empty()
                                            .append('<option value="" selected>Seçiniz</option>')
                                            .val('');
                                        if (response) {
                                            $.each(response, function (i, e) {
                                                var option = document.createElement("option");
                                                /*console.log(e);*/
                                                option.text = e.text;
                                                option.id = e.id;
                                                if(attType == 'addproductColorCodeId'){
                                                    option.text = e.text+'('+e.code+')';
                                                }
                                                x.add(option, x[0]);
                                            });
                                            $(".btn-close").click();
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            }
        })
    }
    function getEditAtt(id,attType){
        $("#attEditDiv").css("display", "");
        $("#attNewDiv").css("display", "none");
        $.ajax({
            type: 'GET',
            url: "{!! route('GetAttributeRow') !!}",
            data: {
                'AtrributeName': attType,id:id
            },
            dataType: 'json',
            success: function (response) {
                if (response) {
                    $('#editId').val(response.id);
                    $('#textEdit').val(response.text);
                    if($(".colorCode").css("display") == 'table-cell') {
                        $('#codeEdit').val(response.code);
                    }
                    if($(".attributeImage").css("display") == 'table-cell') {
                        $('#editShowImage').attr('src', '{{ PUBLIC_DIR}}/uploads/urun-ozellik/' + response.image);
                    }

                    $( "#statusEdit" ).val(response.status);
                }
            }
        });
    }
    $('#saveButton').on('click', function() {
        $(this).prop( "disabled", true );
        if($('.imagex').length < 1 ){
            toastr['warning']('Ürüne ait en az 1 (bir) resim girilmelidir.', 'Uyarı !');
            $(this).prop( "disabled", false );
            return;
        }
        var form = $('#newProductForm')[0];
        var formData = new FormData(form);
        $.ajax({
            type: 'POST',
            url: "{!! route('ProductAdd') !!}",
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
