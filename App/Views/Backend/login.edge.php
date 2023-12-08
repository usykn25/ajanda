@extends('Backend/shared/Main')
@section('main')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div style="text-align: center">
                                    <img src="{!! get_asset('img/titan.png') !!}" alt="" height="50">
                                </div>
                                <hr>
                                <h4 class="text-center mb-4">Hesabına Giriş Yap</h4>
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="mb-1"><strong>E-Posta</strong></label>
                                    <input type="email" class="form-control" id="userMail" name="userMail"  placeholder="info@ygtweb.com.tr">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><strong>Şifre</strong></label>
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Şifre">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block" id="btnLogin">Giriş Yap</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        document.getElementsByTagName('html')[0].classList.add('h-100');
        document.body.classList.add('h-100');
        $('#btnLogin').on('click', function() {
            var _token = $("#_token").val();
            var userMail = $("#userMail").val();
            var password = $("#password").val();
            var rememberMe = $('#rememberMe').is(':checked');
            if(userMail !="" && password !=""){
                var data = { "_token": _token, "userMail": userMail, "password": password,"rememberMe": rememberMe };
                $.ajax({
                    type: 'POST',
                    url: "{!! route('adminLoginPost') !!}",
                    data: data,
                    dataType: 'json',
                    success: function (s) {
                        toastr[s.Type](s.Message, s.Title);
                        if(s.Redirect != null){
                            window.setTimeout( function(){
                                window.location = s.Redirect
                            }, 750 );
                        }
                    },error: function (){
                        toastr['error']('Teknik bir hata oluştu yöneticiye başvurunuz', 'Teknik Hata')
                        window.setTimeout( function(){
                            window.location = "{!! route('adminLogin') !!}"
                        }, 750 );
                    }
                });
            }else{
                toastr['error']('Kullanıcı Adı Şifre Boş Bırakılamaz', 'Hata');
            }
        });
    });
</script>
@endsection
