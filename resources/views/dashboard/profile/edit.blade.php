@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    {{ __('admin/settings/shippings.home_word') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                الملف الشخصي
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">
                                   تعديل الملف الشخصي
                                </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')
                            {{-- Update Admin Name and Email --}}
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route('update.profile') }}"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')   {{--  Laravel 7  --}}
                                        {{--  {{ method_field('put') }}  --}} {{--  Laravel below 7  --}}
                                        <div class="form-body">
                                            <input type="hidden" name="id" value="{{ $admin->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                           الاسم
                                                        </label>
                                                        <input type="text" value="{{ $admin -> name }}" id="name"
                                                               class="form-control"
                                                               name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            البريد الإلكتروني
                                                        </label>
                                                        <input type="text" value="{{ $admin -> email }}" id="email"
                                                               class="form-control"
                                                               name="email">
                                                        @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">
                                                           كلمة المرور الجديدة
                                                        </label>
                                                        <input type="password" id="password"
                                                               class="form-control"
                                                               name="password">
                                                        @error("password")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password_confirmation">
                                                             تأكيد كلمة المرورو
                                                        </label>
                                                        <input type="password" id="password_confirmation"
                                                               class="form-control"
                                                               name="password_confirmation">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i>
                                                {{ __('admin/settings/shippings.shipping_update_btn') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- ############################################################# --}}

                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
@stop
