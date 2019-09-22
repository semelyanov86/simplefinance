@extends('layouts.app')

    @section('content')
        <div class="container">
            <!-- Nav tabs -->
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Профиль</a>
                        <a class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="#v-pills-users" role="tab" aria-controls="v-pills-users" aria-selected="false">Пользователи</a>
                        <a class="nav-link" id="v-pills-currencies-tab" data-toggle="pill" href="#v-pills-currencies" role="tab" aria-controls="v-pills-currencies" aria-selected="false">Настройка валют</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Уведомления</a>
                        <a class="nav-link" id="v-pills-categories-tab" data-toggle="pill" href="#v-pills-categories" role="tab" aria-controls="v-pills-categories" aria-selected="false">Категории</a>
                        <a class="nav-link" id="v-pills-trash-tab" data-toggle="pill" href="#v-pills-trash" role="tab" aria-controls="v-pills-trash" aria-selected="false">Корзина</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <profile-component :user="{{$user}}" updateurl="{{route('settings.user.update')}}"></profile-component>
                        </div>
                        <div class="tab-pane fade" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab">
                            <h1>Пользователи</h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Логин</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Пароль</th>
                                    <th scope="col">Активен</th>
                                    <th scope="col">Последнее обновление</th>
                                    <th scope="col">Дата добавления</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>kseniaem</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" aria-label="Имя" class="form-control" value="Ксения Емельянова">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="password" aria-label="Password" class="form-control" placeholder="Введите для изменения">
                                        </div>
                                    </td>
                                    <td class="text-center align-items-center">
                                        <!-- <div class="input-group"> -->
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <!-- </div> -->
                                    </td>
                                    <td>26.08.2017 00:36:18</td>
                                    <td>26.08.2017 00:36:18</td>
                                    <td><i class="fa fa-lg fa-save"></i><i class="fa fa-lg fa-trash ml-2"></i></td>
                                </tr>
                                </tbody>
                            </table>
                            <h2>Добавить пользователя</h2>
                            <register-user-component saveurl="{{ route('register') }}"></register-user-component>
                        </div>
                        <div class="tab-pane fade" id="v-pills-currencies" role="tabpanel" aria-labelledby="v-pills-currencies-tab">
                            <h1>Настройка валют</h1>
                            <div class="form-group">
                                <label for="selectCurrencies">Выберите валюты из списка</label>
                                <select id="selectCurrencies" class="form-control select2" name="currencies[]" multiple="multiple" style="width: 100%;">
                                    <option value="RUB">Рубль</option>
                                    <option value="USD">Доллар США</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="selectCurrencies">Валюта по умолчанию</label>
                                <select id="defaultCurrency" class="form-control select2" name="defaultCurrency" style="width: 100%;">
                                    <option value="RUB">Рубль</option>
                                    <option value="USD">Доллар США</option>
                                </select>
                            </div>
                            <button class="btn btn-primary">Сохранить</button>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <h1>Настройки для запланированных операций</h1>
                            <div class="form-group">
                                <label for="timezone">Часовой пояс</label>
                                <select id="timezone" class="form-control select2" name="timezone" style="width: 100%;">
                                    <option value="America/Anchorage">(01:48) Аляска</option><option value="America/Los_Angeles">(02:48) Тихоокеанское время (США &amp; Канада)</option><option value="America/Phoenix">(02:48) Аризона</option><option value="America/Managua">(03:48) Центральноамериканское время</option><option value="America/Regina">(03:48) Саскачеван</option><option value="America/Denver">(03:48) Горное время (США &amp; Канада)</option><option value="America/Chihuahua">(03:48) Ла Паз, Мазатлан, Чихуахуа</option><option value="America/Bogota">(04:48) Богота, Лима, Кито</option><option value="America/Mexico_City">(04:48) Гвадалахара, Мехико, Монтеррей</option><option value="America/Chicago">(04:48) Центральное время (США &amp; Канада)</option><option value="America/Caracas">(05:48) Каракас, Асунсьон</option><option value="America/New_York">(05:48) Восточное время (США &amp; Канада)</option><option value="America/Indianapolis">(05:48) Индиана (Восток)</option><option value="America/Santiago">(05:48) Сантьяго</option><option value="America/Sao_Paulo">(06:48) Бразилиа</option><option value="America/Buenos_Aires">(06:48) Буэнос Айрос, Джоржтаун</option><option value="America/Halifax">(06:48) Атлантическое время (Канада)</option><option value="America/St_Johns">(07:18) Ньюфаундленд</option><option value="America/Godthab">(07:48) Гренландия</option><option value="America/Noronha">(07:48) Среднеатлантическое время</option><option value="Atlantic/Cape_Verde">(08:48) Кабо-Верде</option><option value="Atlantic/Azores">(09:48) Азорские острова</option><option value="Africa/Casablanca">(09:48) Касабланка, Монровия</option><option value="Europe/London">(10:48) Дублин, Эдинбург, Лиссабон, Лондон</option><option value="Africa/Lagos">(10:48) Западное центральноафриканское время</option><option value="Europe/Sarajevo">(11:48) Сараево, Скопье, Варашава, Загреб</option><option value="Europe/Belgrade">(11:48) Белград, Братислава, Будапешт, Варшава, Любляна, Прага</option><option value="Africa/Johannesburg">(11:48) Хараре, Претория</option><option value="Europe/Paris">(11:48) Брюссель, Копенгаген, Мадрид, Париж</option><option value="Europe/Berlin">(11:48) Амстердам, Берлин, Берн, Рим, Стокгольм, Вена</option><option value="Africa/Cairo">(11:48) Каир</option><option value="Africa/Nairobi">(12:48) Найроби</option><option value="Asia/Riyadh">(12:48) Кувейт, Эр-Рияд</option><option value="Europe/Moscow">(12:48) Москва, Санкт-Петербург, Волгоград</option><option value="Asia/Baghdad">(12:48) Багдад</option><option value="Europe/Bucharest">(12:48) Будапешт</option><option value="Asia/Jerusalem">(12:48) Иерусалим</option><option value="Europe/Istanbul">(12:48) Афины, Стамбул, Минск</option><option value="Europe/Helsinki">(12:48) Хельсинки, Киев, Рига, София, Таллин, Вильнюс</option><option value="Asia/Tbilisi">(13:48) Баку, Тбилиси, Ереван</option><option value="Asia/Muscat">(13:48) Абу Даби, Мускат</option><option value="Asia/Kabul">(14:18) Кабул</option><option value="Asia/Tehran">(14:18) Тегеран</option><option value="Asia/Yekaterinburg">(14:48) Екатеринбург</option><option value="Asia/Karachi">(14:48) Исламабад, Карачи, Ташкент</option><option value="Asia/Colombo">(15:18) Шри Джаяварденепура</option><option value="Asia/Calcutta">(15:18) Калькутта, Мумбай, Нью Дели, Ченнай</option><option value="Asia/Katmandu">(15:33) Катманду</option><option value="Asia/Dhaka">(15:48) Астана, Дакка</option><option value="Asia/Rangoon">(16:18) Рангун</option><option value="Asia/Novosibirsk">(16:48) Алмата, Новосибирск</option><option value="Asia/Bangkok">(16:48) Банкок, Ханой, Джакарта</option><option value="Asia/Krasnoyarsk">(16:48) Красноярск</option><option value="Asia/Singapore">(17:48) Куала Лумпур, Сингапур</option><option value="Asia/Hong_Kong">(17:48) Гонк Конг, Пекин, Чунцин, Урумчи</option><option value="Asia/Taipei">(17:48) Тайпей</option><option value="Australia/Perth">(17:48) Перт</option><option value="Asia/Irkutsk">(17:48) Иркутск, Улан Батор</option><option value="Asia/Seoul">(18:48) Сеул</option><option value="Asia/Tokyo">(18:48) Осака, Саппоро, Токио</option><option value="Asia/Yakutsk">(18:48) Якутск</option><option value="Australia/Adelaide">(19:18) Аделаида</option><option value="Australia/Darwin">(19:18) Дарвин</option><option value="Australia/Hobart">(19:48) Хобарт</option><option value="Australia/Sydney">(19:48) Канбера, Мальбурн, Сидней</option><option value="Asia/Vladivostok">(19:48) Владивосток</option><option value="Australia/Brisbane">(19:48) Брисбей</option><option value="Pacific/Guam">(19:48) Гуам, Порт Моресби</option><option value="Asia/Magadan">(20:48) Магадан, Сахалин, Соломоновы острова, Новая Каледония</option><option value="Pacific/Fiji">(21:48) Камчатка, Маршалловы острова, Фиджи</option><option value="Pacific/Auckland">(21:48) Окленд, Веллингтон</option><option value="Pacific/Kwajalein">(21:48) Энивоток, Кваджалейн</option><option value="Pacific/Apia">(22:48) Остров Мидуэй, Самоа</option><option value="Pacific/Tongatapu">(22:48) Нуку-алофа</option><option value="Pacific/Honolulu">(23:48) Гаваи</option>
                                </select>
                                <div class="form-group">
                                    <label for="phoneNumber">Номер телефона</label>
                                    <input type="phone" class="form-control" id="phoneNumber">
                                </div>
                                <h2>Настройки по умолчанию</h2>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="byEmail">
                                            <label class="form-check-label" for="byEmail">По email</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailOften">Частота</label>
                                            <select id="emailOften" class="form-control select2" name="defaultCurrency" style="width: 100%;">
                                                <option value="0">В тот же день</option>
                                                <option value="1">За 1 день</option>
                                                <option value="2">За 2 дня</option>
                                                <option value="3">За 3 дня</option>
                                                <option value="7">За неделю</option>
                                                <option value="31">За месяц</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailHours">Часы</label>
                                            <select id="emailHours" class="form-control select2" name="emailHours" style="width: 100%;">
                                                <option value="0">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailMinutes">Минуты</label>
                                            <select id="emailMinutes" class="form-control select2" name="emailMinutes" style="width: 100%;">
                                                <option value="0">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="bySMS">
                                            <label class="form-check-label" for="bySMS">По sms</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="smsOften">Частота</label>
                                            <select id="smsOften" class="form-control select2" name="defaultCurrency" style="width: 100%;">
                                                <option value="0">В тот же день</option>
                                                <option value="1">За 1 день</option>
                                                <option value="2">За 2 дня</option>
                                                <option value="3">За 3 дня</option>
                                                <option value="7">За неделю</option>
                                                <option value="31">За месяц</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="smsHours">Часы</label>
                                            <select id="smsHours" class="form-control select2" name="smsHours" style="width: 100%;">
                                                <option value="0">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="smsMinutes">Минуты</label>
                                            <select id="smsMinutes" class="form-control select2" name="smsMinutes" style="width: 100%;">
                                                <option value="0">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-categories" role="tabpanel" aria-labelledby="v-pills-categories-tab">
                            <h1>Категории</h1>
                            <div class="row mt-2">
                                <div class="col-4">
                                    <a class="btn btn-primary" data-toggle="collapse" href="#addCategory" role="button" aria-expanded="false" aria-controls="addCategory">
                                        Добавить категорию
                                    </a>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-danger">Восстановить</button>
                                </div>
                                <div class="col-4 form-check">
                                    <input type="checkbox" name="hidden-categories" class="form-check-input" id="hidden-categories">
                                    <label for="hidden-categories" class="form-check-label">Показать скрытые</label>
                                </div>
                            </div>
                            <div class="collapse" id="addCategory">
                                <div class="card card-body">
                                    <h5 class="card-title">Добавление новой категории</h5>
                                    <form>
                                        <div class="form-group">
                                            <label for="categoryName">Название категории</label>
                                            <input type="text" class="form-control" id="categoryName">
                                        </div>
                                        <div class="form-group">
                                            <label for="categoryType">Тип категории</label>
                                            <select class="form-control" id="categoryType">
                                                <option>Доходная</option>
                                                <option>Расходная</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subCategory">Подкатегория для</label>
                                            <select class="form-control select2" id="subCategory">
                                                <option>Автомобиль</option>
                                                <option>Дети</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="sysCategory">Системная категория</label>
                                            <select class="form-control select2" id="sysCategory">
                                                <option>Автомобиль</option>
                                                <option>Дети</option>
                                            </select>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="isHiddenCategory">
                                            <label class="form-check-label" for="isHiddenCategory">
                                                Скрытая категория
                                            </label>
                                        </div>
                                        <div class="btn-group mt-2" role="group">
                                            <button type="button" class="btn btn-danger">Отменить</button>
                                            <button type="button" class="btn btn-success ml-2">Сохранить</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <table id="table" data-toggle="table"
                                   data-search="true" data-filter-control="true" data-filter-show-clear="true" data-toggle="table" data-group-by="true"  data-group-by-field="syscategory">
                                <thead>
                                <tr>
                                    <th data-field="category">Наименование категории</th>
                                    <th data-field="type" data-filter-control="select">Тип</th>
                                    <th data-field="syscategory">Системная категория</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Стоянка</td>
                                    <td>-</td>
                                    <td>Автомобиль</td>
                                </tr>
                                <tr>
                                    <td>Аренда автомобиля</td>
                                    <td>-</td>
                                    <td>Автомобиль</td>
                                </tr>
                                <tr>
                                    <td>Мойка автомобиля</td>
                                    <td>-</td>
                                    <td>Автомобиль</td>
                                </tr>
                                <tr>
                                    <td>Платные дороги, штрафы</td>
                                    <td>-</td>
                                    <td>Автомобиль</td>
                                </tr>
                                <tr>
                                    <td>Оплата прочих комиссий</td>
                                    <td>-</td>
                                    <td>Банковское обслуживание</td>
                                </tr>
                                <tr>
                                    <td>Комиссия банкомата</td>
                                    <td>-</td>
                                    <td>Банковское обслуживание</td>
                                </tr>
                                <tr>
                                    <td>Услуги банка</td>
                                    <td>-</td>
                                    <td>Банковское обслуживание</td>
                                </tr>
                                <tr>
                                    <td>Ковыряние в носу</td>
                                    <td>-</td>
                                    <td>Вредные привычки</td>
                                </tr>
                                <tr>
                                    <td>Алкоголь, табачные изделия</td>
                                    <td>-</td>
                                    <td>Вредные привычки</td>
                                </tr>
                                <tr>
                                    <td>Игрушки</td>
                                    <td>-</td>
                                    <td>Дети</td>
                                </tr>
                                <tr>
                                    <td>Детская одежда и обувь</td>
                                    <td>-</td>
                                    <td>Дети</td>
                                </tr>
                                <tr>
                                    <td>Детские врачи</td>
                                    <td>-</td>
                                    <td>Дети</td>
                                </tr>
                                </tbody>
                            </table>
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
