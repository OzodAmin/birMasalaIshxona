@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-headline">
    <h2>{{ $user->name }}</h2>
    <span>
        @foreach($user->roles as $role)
            {{ $role->display_name }}
        @endforeach
    </span>
    <?php if ($user->status == 1 || $user->status == 2) {
        echo "<div class='col-md-2 verified-badge-with-title'>".$user->statuses->name."</div>";
    }else 
        echo "<div class='col-md-2 label label-danger'>".$user->statuses->name."</div>";
     ?>
    <!-- @switch($user->status)
        @case(1)
            <div class="col-md-2 verified-badge-with-title"><?= $user->statuses->name ?></div>
            @break
        @case(2)
            <div class="col-md-2 verified-badge-with-title">Активный</div>
            @break
        @case(3)
            <div  class="col-md-2 label label-danger">
                Нарушение правил торгов
            </div >
            @break
        @case(4)
            <div  class="col-md-2 label label-danger">
                Неуплата комиссионных сборов
            </div >
            @break
        @case(5)
            <div  class="col-md-2 label label-danger">
                Неполнота предоставленных документов
            </div >
            @break
        @case(6)
            <div  class="col-md-2 label label-danger">
                Неактивен по прочим причинам
            </div >
            @break
        @case(7)
            <div  class="col-md-2 label label-warning">
                Заблокирован сотрудником РКП
            </div >
            @break
        @default
            <span class="label label-primary">???</span>
    @endswitch -->

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li>
                <a href="{{ url('profileEdit') }}">
                    Изменить персональные данные
                </a>
            </li>
        </ul>
    </nav>
</div>

<div class="row">

    <!-- Content -->
    <div class="col-md-12 content-right-offset">
        <h3 class="margin-bottom-10">Наименование организации</h3>
        <p>{{ $user->company_legal_name }}</p>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 content-right-offset">
        <h3 class="margin-bottom-10">Юридический адрес</h3>
        <p>{{ $user->address }}</p>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 content-right-offset">
        <h3 class="margin-bottom-10">ИНН</h3>
        <p>{{ $user->inn }}</p>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 content-right-offset">
        <h3 class="margin-bottom-10">Aдрес электронной почты</h3>
        <p>{{ $user->email }}</p>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 content-right-offset">
        <h3 class="margin-bottom-10">Контактный номер</h3>
        <p>{{ $user->phone }}</p>
    </div>

    <div class="clearfix"></div>


</div>
@endsection