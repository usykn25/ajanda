@extends('Backend/backend-master')
@section('css')
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Sipariş</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Listele</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead>
                            <tr>
                                <th class="align-middle">Sipariş No</th>
                                <th class="align-middle pe-7">Tarih</th>
                                <th class="align-middle" style="min-width: 12.5rem;">Okullar</th>
                                <th class="align-middle text-right">Telefon</th>
                                <th class="no-sort"></th>
                            </tr>
                            </thead>
                            <tbody id="orders">
                            @if($sipList)
                                @foreach($sipList as $sip)
                                    <tr class="btn-reveal-trigger">
                                <td class="py-2">
                                    <a href="{!! route('siparisFront',['id'=>$sip->id,'code'=>$sip->uniqCode]) !!}" target="_blank">
                                        <strong>{{ $sip->uniqCode }}#{{ $sip->id }}</strong></a>
                                    <br />
                                    {{ $sip->nameSurname }}</td>
                                <td class="py-2">
                                    <?php
                                    $source = $sip->crateDate;
                                    $date = new DateTime($source);
                                    echo $date->format('d.m.Y'); // 31.07.2012
                                    ?>
                                </td>
                                        <td class="py-2">
                                            @foreach($sip->schoolId as $school)
                                                {{ $school->schoolName }},
                                            @endforeach
                                        </td>
                                        <td class="py-2">
                                            {{ $sip->phone }}
                                        </td>
                                <td class="py-2 text-right">
                                    @if($sip->status == 1)
                                    <span class="badge badge-warning">Giriş Bekliyor<span class="ms-1 fas fa-stream"></span></span>
                                    @elseif($sip->status == 2)
                                    <span class="badge badge-primary">Onay Bekliyor<span class="ms-1 fa fa-redo"></span></span>
                                    @elseif($sip->status == 3)
                                    <span class="badge badge-secondary">İptal Edildi<span class="ms-1 fa fa-ban"></span></span>
                                    @elseif($sip->status == 4)
                                    <span class="badge badge-success">Onaylandı<span class="ms-1 fa fa-check"></span></span>
                                    @endif
                                </td>
                                <td class="py-2 text-right">
                                    <div class="dropdown text-sans-serif">
                                        <button class="btn btn-primary tp-btn-light sharp" type="button" id="order-dropdown-1" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></span></button>
                                        <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-1">
                                            <div class="py-2">
                                                @if($sip->status == 2)
                                                <a class="dropdown-item" onclick="statusUpdate({{ $sip->id}},1)">Siparişi Sıfırla</a>
                                                <a class="dropdown-item" onclick="statusUpdate({{ $sip->id}},4)">Onayla</a>
                                                @elseif($sip->status != 3)
                                                <a class="dropdown-item" onclick="statusUpdate({{ $sip->id}},3)">İptal Et</a>
                                                @endif
                                            </div>
                                        </div>
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
<script>
    function statusUpdate(id,status){

        Swal.fire({
            title: 'Emin misiniz?',
            text: "Sipariş Durumu Güncellenecek!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            confirmButtonText: 'Evet, Güncelle!',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Vazgeç',
        }).then((result) => {
            if (result.value) {
                if(id){
                    $(this).prop( "disabled", true );
                    $.ajax({
                        url: '{!! route("siparisUpdate") !!}',
                        type: "POST",
                        data: { id: id,status:status },
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
</script>
@endsection
