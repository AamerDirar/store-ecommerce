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
                                {{ __('admin/settings/shippings.shipping_methods_word') }}
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
                                    {{ __('admin/settings/shippings.edit_shipping_method') }}
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
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route('update.shippings.methods',$shippingMethod -> id) }}"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')   {{--  Laravel 7  --}}
                                        {{--  {{ method_field('put') }}  --}} {{--  Laravel below 7  --}}
                                        <input type="hidden" name="id" value="{{ $shippingMethod -> id }}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ __('admin/settings/shippings.shipping_method_name') }}
                                                        </label>
                                                        <input type="text" value="{{ $shippingMethod -> value }}" id="value"
                                                               class="form-control"
                                                               name="value">
                                                        @error("value")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ __('admin/settings/shippings.shipping_method_cost') }}
                                                        </label>
                                                        <input type="number" id="plain_value"
                                                               class="form-control" value="{{ $shippingMethod -> plain_value }}"
                                                               name="plain_value">
                                                        @error("plain_value")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i>
                                                {{ __('admin/settings/shippings.shipping_update_btn') }}
                                            </button>
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i>
                                                {{ __('admin/settings/shippings.shipping_reset_btn') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@stop
