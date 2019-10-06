@extends('layouts.app')

    @section('content')
        <div class="container">
            <!-- Nav tabs -->
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Профиль</a>
                        @can('manage users')
                        <a class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="#v-pills-users" role="tab" aria-controls="v-pills-users" aria-selected="false">Пользователи</a>
                        @endcan
                        @can('manage currencies')
                        <a class="nav-link" id="v-pills-currencies-tab" data-toggle="pill" href="#v-pills-currencies" role="tab" aria-controls="v-pills-currencies" aria-selected="false">Настройка валют</a>
                        @endcan
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Уведомления</a>
                        @can('manage categories')
                        <a class="nav-link" id="v-pills-categories-tab" data-toggle="pill" href="#v-pills-categories" role="tab" aria-controls="v-pills-categories" aria-selected="false">Категории</a>
                        @endcan
                        <a class="nav-link" id="v-pills-trash-tab" data-toggle="pill" href="#v-pills-trash" role="tab" aria-controls="v-pills-trash" aria-selected="false">Корзина</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <profile-component :user="{{$user}}" updateurl="{{route('settings.user.update')}}"></profile-component>
                        </div>
                        @can('manage users')
                        <div class="tab-pane fade" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab">
                            <register-user-component saveurl="{{ route('register') }}" :users="{{$users}}" :roles="{{$roles}}" updateurl="{{route('settings.user.updateById')}}"></register-user-component>
                        </div>
                        @endcan
                        @can('manage currencies')
                        <div class="tab-pane fade" id="v-pills-currencies" role="tabpanel" aria-labelledby="v-pills-currencies-tab">
                            <currencies-component :currencies="{{$currencies}}" updateurl="{{ route('settings.currency.update') }}"></currencies-component>
                        </div>
                        @endcan
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1>Настройки для запланированных операций</h1>
                            <form action="{{route('settings.notify.update')}}" method="post">
                                @csrf
                            <div class="form-group">
                                <label for="timezone">Часовой пояс</label>
                                {!! $timezone_select !!}
                                <div class="form-group">
                                    <label for="phoneNumber">Номер телефона</label>
                                    <input type="phone" class="form-control" id="phoneNumber" name="phone" value="{{old('phone', $user->phone)}}">
                                </div>
                                <h2>Настройки по умолчанию</h2>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="byEmail" name="byEmail" @if($user->notify_way == 'email' || $user->notify_way == 'all') checked @endif>
                                            <label class="form-check-label" for="byEmail">По email</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailOften">Частота</label>
                                            <select id="emailOften" class="form-control select2" name="emailFrequency" style="width: 100%;">
                                                <option value="0" @if($user->notify_frequency == "0") selected @endif>В тот же день</option>
                                                <option value="1" @if($user->notify_frequency == "1") selected @endif>За 1 день</option>
                                                <option value="2" @if($user->notify_frequency == "2") selected @endif>За 2 дня</option>
                                                <option value="3" @if($user->notify_frequency == "3") selected @endif>За 3 дня</option>
                                                <option value="7" @if($user->notify_frequency == "7") selected @endif>За неделю</option>
                                                <option value="31" @if($user->notify_frequency == "31") selected @endif>За месяц</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailHours">Часы</label>
                                            <select id="emailHours" class="form-control select2" name="emailHours" style="width: 100%;">
                                                @for ($i = 0; $i < 23; $i++)
                                                    <option value="{{$i}}"  @if($user->notify_hours == $i) selected @endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailMinutes">Минуты</label>
                                            <select id="emailMinutes" class="form-control select2" name="emailMinutes" style="width: 100%;">
                                                <option value="0" @if($user->notify_minutes == '0') selected @endif>00</option>
                                                <option value="15" @if($user->notify_minutes == '15') selected @endif>15</option>
                                                <option value="30" @if($user->notify_minutes == '30') selected @endif>30</option>
                                                <option value="45" @if($user->notify_minutes == '45') selected @endif>45</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="bySMS" name="bySms" @if($user->notify_way == 'sms' || $user->notify_way == 'all') checked @endif>
                                            <label class="form-check-label" for="bySMS">По sms</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="smsOften">Частота</label>
                                            <select id="smsOften" class="form-control select2" name="smsFrequency" style="width: 100%;">
                                                <option value="0" @if($user->notify_frequency_sms == "0") selected @endif>В тот же день</option>
                                                <option value="1" @if($user->notify_frequency_sms == "1") selected @endif>За 1 день</option>
                                                <option value="2" @if($user->notify_frequency_sms == "2") selected @endif>За 2 дня</option>
                                                <option value="3" @if($user->notify_frequency_sms == "3") selected @endif>За 3 дня</option>
                                                <option value="7" @if($user->notify_frequency_sms == "7") selected @endif>За неделю</option>
                                                <option value="31" @if($user->notify_frequency_sms == "31") selected @endif>За месяц</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="smsHours">Часы</label>
                                            <select id="smsHours" class="form-control select2" name="smsHours" style="width: 100%;">
                                                @for ($i = 0; $i < 23; $i++)
                                                    <option value="{{$i}}"  @if($user->notify_hours_sms == $i) selected @endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="smsMinutes">Минуты</label>
                                            <select id="smsMinutes" class="form-control select2" name="smsMinutes" style="width: 100%;">
                                                <option value="0" @if($user->notify_minutes_sms == '0') selected @endif>00</option>
                                                <option value="15" @if($user->notify_minutes_sms == '15') selected @endif>15</option>
                                                <option value="30" @if($user->notify_minutes_sms == '30') selected @endif>30</option>
                                                <option value="45" @if($user->notify_minutes_sms == '45') selected @endif>45</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Обновить уведомления</button>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-categories" role="tabpanel" aria-labelledby="v-pills-categories-tab">
                            <categories-component :syscategories="{{$syscategories}}" :categories="{{$categories}}" createurl="{{route('settings.category.create')}}"></categories-component>
                        </div>
                        <div class="tab-pane fade" id="v-pills-trash" role="tabpanel" aria-labelledby="v-pills-trash-tab">
                            <h1>Корзина</h1>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-operations-tab" data-toggle="pill" href="#pills-operations" role="tab" aria-controls="pills-operations" aria-selected="true">Операции</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-accounts-tab" data-toggle="pill" href="#pills-accounts" role="tab" aria-controls="pills-accounts" aria-selected="false">Счета</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-operations" role="tabpanel" aria-labelledby="pills-operations-tab">
                                    <div id="toolbar" class="mb-2">
                                        <button id="remove" class="btn btn-danger" onclick="getSelectedRowCount()" disabled>Remove Selected</button>
                                        <button id="restore" class="btn btn-secondary" disabled>Restore Selected</button>
                                    </div>
                                    <table
                                        id="table2"
                                        data-toggle="table2"
                                        data-toolbar="#toolbar2"
                                        data-click-to-select="true"
                                        data-url="json/data1.json"
                                    >
                                        <thead>
                                        <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th data-field="id">ID</th>
                                            <th data-field="date">Дата</th>
                                            <th data-field="type">Тип</th>
                                            <th data-field="price">Сумма</th>
                                            <th data-field="accounts">Счета</th>
                                            <th data-field="categories">Категории</th>
                                            <th data-field="comments">Комментарии</th>
                                            <th data-formatter='operateFormatter'>Действия</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-accounts" role="tabpanel" aria-labelledby="pills-accounts-tab">
                                    <div id="toolbar3" class="mb-2">
                                        <button id="button-accounts" class="btn btn-danger" disabled>Remove Selected</button>
                                        <button id="button-accounts-restore" class="btn btn-secondary" disabled>Restore Selected</button>
                                    </div>
                                    <table
                                        id="table-accounts"
                                        data-toggle="table-accounts"
                                        data-pagination="true">
                                        <thead>
                                        <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th data-field="id">Дата удаления</th>
                                            <th data-field="name">Название</th>
                                            <th data-field="price">Описание</th>
                                            <th data-field="accounts">Валюта</th>
                                            <th data-field="actions">Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr id="tr-id-1" class="tr-class-1" data-title="bootstrap table">
                                            <td id="state" class="td-class-1" data-title="bootstrap table">
                                            </td>
                                            <td data-value="526">17.02.2019</td>
                                            <td data-text="122">Альфабанк</td>
                                            <td data-i18n="Description">300</td>
                                            <td data-text="122">Евро</td>
                                            <td data-text="122"><i class="fa fa-undo fa-lg"></i><i class="fa fa-trash fa-lg ml-2"></i></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
