@extends('layout.layout_admin')
@section('title', 'Admin')
@section('content')
    <section id="nav-filled">
        <div class="row">
            <div class="col-sm-12">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <h4 class="card-title">Quản lý đơn hàng</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill"
                                        role="tab" aria-controls="home-fill" aria-selected="true">Đơn hàng chờ duyệt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill"
                                        role="tab" aria-controls="profile-fill" aria-selected="false">Đơn hàng đã duyệt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="messages-tab-fill" data-toggle="tab" href="#messages-fill"
                                        role="tab" aria-controls="messages-fill" aria-selected="false">Đơn hàng đang
                                        ship</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="settings-tab-fill" data-toggle="tab" href="#settings-fill"
                                        role="tab" aria-controls="settings-fill" aria-selected="false">Đơn hàng đã ship</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content pt-1">
                                <div class="tab-pane active">
                                @section('dataOrder')
                                @show
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
