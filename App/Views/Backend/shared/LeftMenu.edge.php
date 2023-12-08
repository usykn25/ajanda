<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="ai-icon" href="{!! route('adminHome') !!}" aria-expanded="false">
                    <i class="flaticon-dashboard-1"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class=flaticon-badge></i>
                    <span class="nav-text">Ürünler</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! route('Products') !!}">Listele</a></li>
                    <li><a href="{!! route('ProductAdd') !!}">Yeni Ekle</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class=flaticon-form-1></i>
                    <span class="nav-text">Sipariş Yönetimi</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! route('siparisList') !!}">Sipariş Formları</a></li>
                    <li><a href="{!! route('createForm') !!}">Yeni Sipariş Formu Oluştur</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class=flaticon-plugin></i>
                    <span class="nav-text">Okul Yönetimi</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! route('Schools') !!}">Listele</a></li>
                    <li><a href="{!! route('SchoolAdd') !!}">Yeni Ekle</a></li>
                </ul>
            </li>
        </ul>
        <div class="copyright">
            <p><strong>YGT Web</strong> © 2023 All Rights Reserved</p>
        </div>
    </div>
</div>
