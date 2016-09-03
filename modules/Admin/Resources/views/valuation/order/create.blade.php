@extends('admin::layouts.master')

@section('title', 'Alternative Valuation - Creating Order Status')

@section('crumbs', [
  ['title' => 'Valuation', 'url' => '#'],
  ['title' => 'Order Statuses', 'url' => route('admin.valuation.orders.status')],
  ['title' => 'New Order Status', 'url' => '']
])

@section('content')
    <div class="row">
        <div class="col-lg-6">
            {{ Form::model($status, ['route' => [$status->id ? 'admin.valuation.orders.status.update' : 'admin.valuation.orders.status.create', 'id' => $status->id], 'class' => 'form-horizontal']) }}
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ 'Creating' }}</h3>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{ Form::label('name', 'Description', ['class' => 'col-lg-3 col-xs-12 required']) }}
                                        <div class="col-lg-12 col-xs-12">
                                            {{ Form::text('name', old('name', $status->name), ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="ibox-footer">
                                    <button class="btn btn-success pull-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@stop