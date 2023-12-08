@extends('Backend/backend-master')
@section('css')
<link rel="stylesheet" href="{!! get_asset('Backend/css/jquery.dataTables.min.css') !!}">
<style>
    .treegrid-control-open{
        color: red;
        font-weight: bold;
    }
    .treegrid-control{
        color: green;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ürün Kategorileri</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Listele</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ürün Kategorileri</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="width: 100%;">
                            <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                            </thead>
                            <tbody>
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
<script src="{!! get_asset('Backend/js/dataTables.treeGrid.js') !!}"></script>
<script>
</script>
<script>
    var columns = [
        {
            orderable: false,
            title: '',
            target: 0,
            className: 'treegrid-control',
            data: function (item) {
                if (item.children) {
                    return '<span>+<\/span>';
                }
                return '';
            }
        },
        {
            title: 'Kategori No',
            target: 1,
            data: function (item) {
                return '<strong>'+item.id+'</strong>';
            }
        },
        {
            title: 'Kategori Adı',
            target: 2,
            data: function (item) {
                return '<div class="d-flex align-items-center"><span class="w-space-no">'+item.title+'</span></div>';
            }
        },
        {
            orderable: false,
            title: 'Kategori Resim',
            target: 3,
            data: function (item) {
                var pathUrl = "{{ PUBLIC_DIR }}uploads/urun-kategori/";
                return '<div class="d-flex align-items-center"><img src="'+pathUrl+item.image+'" class="rounded-lg me-2" width="48" alt=""/></div>';
            }
        },
        {
            title: 'Kategori Durumu',
            target: 4,
            data: function (item) {
                if (item.status === 1) {
                    return '<div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> Aktif</div></td>';
                }
                if (item.status === 0) {
                    return '<div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> Pasif</div></td>';
                }
            }
        },
        {
            orderable: false,
            title: '',
            target: 5,
            data: function (item) {
                var editUrl = "{!! route('ProductCategoryEdit',['id'=>null]) !!}";
                return '<div class="d-flex">'
                            +'<a href="'+editUrl+item.id+'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>'
                            +'<a href="#" onclick="categoryDelete('+item.id+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>'
                        +'</div>';
            }
        }
    ];
    $(document).ready(function() {
        $('#example3').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json',
            },
            "order": [[ 1, 'asc' ]],
            'columns': columns,
            'ajax': '{!! route("ProductCategoriesAjax") !!}',
            'treeGrid': {
                'left': 10,
                'expandIcon': '<span>+<\/span>',
                'collapseIcon': '<span>-<\/span>'
            }
        });
    });
    function categoryDelete(id){
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Kategori silinecektir!",
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
                            url: '{!! route("ProductCategoryDelete") !!}',
                            type: "POST",
                            data: { CategoryID: id },
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
