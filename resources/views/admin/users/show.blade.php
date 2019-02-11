<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User Info</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Ф.И.О</label>
                            {{ $user->name }}
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">E-mail</label>
                            {{ $user->email }}
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Название заведения</label>
                            {{ $user->companyName }}
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Юридическое название организации</label>
                            {{ $user->companyLegalName }}
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Адрес</label>
                            {{ $user->address }}
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Скидка</label>
                            {{ $user->discount }} %
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Mobile phone number</label>
                            {{ $user->mobile }}
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Phone number</label>
                            {{ $user->phone }}
                        </div>
<div class="clearfix"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Roles</label>
                            @if(!empty($user->roles))
                                @foreach($user->roles as $role)
                                    <label class="label label-success">{{ $role->display_name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection