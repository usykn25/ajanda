@extends('Backend/backend-master')
@section('css')
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! route('ProductCategories') !!}">Ürün Kategorileri</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Düzenle</a></li>
        </ol>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $category->title }} - Ürün Kategorisini Düzenle</h4>
                </div>
                <div class="card-body">
                    <form id="newProductCategoryForm">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Kategori Adı</label>
                            <input type="email" id="title" name="title" class="form-control" placeholder="Kategori Adı" required value="{{ $category->title }}">
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Üst Kategori</label>
                            <select class=" form-control wide" name="maincategoryId" required>
                                <option value="0">Ana Kategori</option>
                                @if($categoriesOptionList)
                                {!! $categoriesOptionList !!}
                                @endif
                            </select>
                        </div>
                        <div class="custom_file_input mb-3">
                            <label class="col-sm-3 col-form-label">Kategori Resmi</label>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-file">
                                        <input type="file" name="image" id="image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img src="{!! get_asset('uploads/urun-kategori/'.$category->image) !!}" alt="" style="   width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Kategori Durumu</label>
                            <select class=" form-control wide" name="status" required>
                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Pasif</option>
                            </select>
                        </div>
                        <div>
                            <button type="button" id="saveButton" class="btn btn-success" data-loading-text="<i class='fas fa-circle-notch fa-spin'></i>" style="float: right;width: 160px;">Güncelle</button>
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

    $('#saveButton').on('click', function() {
        $(this).prop( "disabled", true );
        if($('#title').val() == ''){
            toastr['warning']('Ürün kategori adı boş bırakılamaz.', 'Uyarı !')
            $(this).prop( "disabled", false );
            return;
        }
        var form = $('#newProductCategoryForm')[0];
        var formData = new FormData(form);
        formData.append( 'image', $('#image')[0].files );
        $.ajax({
            type: 'POST',
            url: "{!! route('ProductCategoryUpdate') !!}",
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
