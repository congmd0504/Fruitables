<div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
        <h2 class="fw-bold text-light">Fruitables</h2>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
            </button>
        </div>
        <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
        </button>
    </div>
    <!-- End Logo Header -->
</div>
<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item active">
                <a href="">
                    <i class="fas fa-home"></i>
                    <p>Statistical</p>
                </a>

            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Quản lý</h4>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                    <i class="fas fa-layer-group"></i>
                    <p>Danh mục</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{route('admin.categories.index')}}">
                                <span class="sub-item">Danh sách danh mục</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.categories.create')}}">
                                <span class="sub-item">Thêm mới danh mục</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base2">
                    <i class="fa fa-folder"></i>
                    <p>Sản phẩm</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="base2">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{route('admin.products.index')}}">
                                <span class="sub-item">Danh sách sản phẩm</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.products.create')}}">
                                <span class="sub-item">Thêm mới sản phẩm</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </li>
            @if(Auth::user()->role_id === 1)
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base3">
                    <i class="fa fa-handshake"></i>
                    <p>Khách hàng</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="base3">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{route('admin.users.index')}}">
                                <span class="sub-item">Danh sách khách hàng</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sub-item">Thêm mới khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </li>
            @endif
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base4">
                    <i class="fa fa-comment"></i>
                    <p>Bình luận</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="base4">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{route('admin.comments')}}">
                                <span class="sub-item">Danh sách bình luận</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.comments.listReplyComment')}}">
                                <span class="sub-item">Danh sách bình luận trả lời</span>
                            </a>
                        </li>
                    </ul>
                </div>
               
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base5">
                    <i class="fa fa-folder"></i>
                    <p>Đơn hàng</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="base5">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{route('admin.orders.list')}}">
                                <span class="sub-item">Đơn hàng chưa xác nhận</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.orders.index')}}">
                                <span class="sub-item">Danh sách đơn hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </li>
            <li class="nav-item">
                <a class="mt-3" href="{{route('client.index')}}">
                    <i class="fa fa-backward"></i>
                    <p>Trang khách hàng</p>
                </a>
            </li>
        </ul>
    </div>
</div>
