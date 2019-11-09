@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 border">
                <div class="mt-2">
                    <button type="button" class="btn btn-success btn-block"  data-toggle="modal" data-target="#addOperation">Добавить в учёт</button>
                    <button type="button" class="btn btn-danger btn-block mt-2" onclick="$('#addToCalendar').modal();">Добавить в календарь</button>
                </div>
                <div class="mt-2">
                    <ul class="nav nav-tabs" id="leftTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab" aria-controls="accounts" aria-selected="true">Счета</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tags-tab" data-toggle="tab" href="#tags" role="tab" aria-controls="tags" aria-selected="false">Теги</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="operations-tab" data-toggle="tab" href="#operations" role="tab" aria-controls="operations" aria-selected="false">Операции</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
                            <div class="text-center my-2">
{{--                                <b-button v-b-modal.addNewAccount variant="link" class="text-success"><i class="fa fa-plus"></i>Добавить счёт</b-button>--}}
                                <a href="#" class="text-success" v-on:click="addNewAccount = !addNewAccount"><i class="fa fa-plus"></i>Добавить счёт</a>
                            </div>
                            <div class="accordion" id="accordionLeft">
                                <div class="card">
                                    <div class="card-header" id="favourites">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Избранное <span class="badge badge-light">21824 RUB</span>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="favourites" data-parent="#accordionLeft">
                                        <div class="card-body">
                                            <div class="row accountrow" data-toggle="tooltip" data-html="true" title="<p>Название: Авангард</p>
								        	<p>Тип: Банковский счёт</p>
								        	<p>Банк: Авангард</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Остаток: 9000 руб.</p>">
                                                <div class="col">
                                                    Авангард
                                                </div>
                                                <div class="col text-right text-success accountsum">
                                                    <b>7279 RUB</b>
                                                </div>
                                                <div class="col text-right text-success accountedit">
								        		<span class="pull-right">
			                        <span class="btn btn-xs btn-default">
			                        		<i class="fa fa-plus text-success" aria-hidden="true"></i>
			                            <i class="fa fa-edit text-success" aria-hidden="true"></i>
			                            <i class="fa fa-star text-success" aria-hidden="true"></i>
			                            <i class="fa fa-trash text-success" aria-hidden="true"></i>
			                        </span>
			                    	</span>
                                                </div>
                                            </div>
                                            <div class="row accountrow">
                                                <div class="col" data-toggle="tooltip" data-html="true" title="<p>Название: Альфабанк Общий</p>
								        	<p>Тип: Банковский счёт</p>
								        	<p>Банк: Альфабанк</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Остаток: 9000 руб.</p>">
                                                    Альфабанк общий
                                                </div>
                                                <div class="col text-right text-success accountsum">
                                                    <b>55251 RUB</b>
                                                </div>
                                                <div class="col text-right text-success accountedit">
								        		<span class="pull-right">
			                        <span class="btn btn-xs btn-default">
			                        		<i class="fa fa-plus text-success" aria-hidden="true"></i>
			                            <i class="fa fa-edit text-success" aria-hidden="true"></i>
			                            <i class="fa fa-star text-success" aria-hidden="true"></i>
			                            <i class="fa fa-trash text-success" aria-hidden="true"></i>
			                        </span>
			                    	</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="money">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Деньги <span class="badge badge-light">218048 RUB</span>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="money" data-parent="#accordionLeft">
                                        <div class="card-body">
                                            <div class="row accountrow" data-toggle="tooltip" data-html="true" title="<p>Название: Авангард</p>
								        	<p>Тип: Банковский счёт</p>
								        	<p>Банк: Авангард</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Остаток: 9000 руб.</p>">
                                                <div class="col">
                                                    Авангард
                                                </div>
                                                <div class="col text-right text-success accountsum">
                                                    <b>7279 RUB</b>
                                                </div>
                                                <div class="col text-right text-success accountedit">
								        		<span class="pull-right">
			                        <span class="btn btn-xs btn-default">
			                        		<i class="fa fa-plus text-success" aria-hidden="true"></i>
			                            <i class="fa fa-edit text-success" aria-hidden="true"></i>
			                            <i class="fa fa-star text-success" aria-hidden="true"></i>
			                            <i class="fa fa-trash text-success" aria-hidden="true"></i>
			                        </span>
			                    	</span>
                                                </div>
                                            </div>
                                            <div class="row accountrow">
                                                <div class="col" data-toggle="tooltip" data-html="true" title="<p>Название: Альфабанк Общий</p>
								        	<p>Тип: Банковский счёт</p>
								        	<p>Банк: Альфабанк</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Остаток: 9000 руб.</p>">
                                                    Альфабанк общий
                                                </div>
                                                <div class="col text-right text-success accountsum">
                                                    <b>55251 RUB</b>
                                                </div>
                                                <div class="col text-right text-success accountedit">
								        		<span class="pull-right">
			                        <span class="btn btn-xs btn-default">
			                        		<i class="fa fa-plus text-success" aria-hidden="true"></i>
			                            <i class="fa fa-edit text-success" aria-hidden="true"></i>
			                            <i class="fa fa-star text-success" aria-hidden="true"></i>
			                            <i class="fa fa-trash text-success" aria-hidden="true"></i>
			                        </span>
			                    	</span>
                                                </div>
                                            </div>
                                            <div class="row accountrow">
                                                <div class="col"  data-toggle="tooltip" data-html="true" title="<p>Название: Доллар</p>
								        	<p>Тип: Наличные</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Остаток: 9000 руб.</p>">
                                                    Доллар
                                                </div>
                                                <div class="col text-right text-success accountsum">
                                                    <b>52 $</b>
                                                </div>
                                                <div class="col text-right text-success accountedit">
								        		<span class="pull-right">
			                        <span class="btn btn-xs btn-default">
			                        		<i class="fa fa-plus text-success" aria-hidden="true"></i>
			                            <i class="fa fa-edit text-success" aria-hidden="true"></i>
			                            <i class="fa fa-star text-success" aria-hidden="true"></i>
			                            <i class="fa fa-trash text-success" aria-hidden="true"></i>
			                        </span>
			                    	</span>
                                                </div>
                                            </div>
                                            <div class="row accountrow">
                                                <div class="col"  data-toggle="tooltip" data-html="true" title="<p>Название: Евро</p>
								        	<p>Тип: Наличные</p>
								        	<p>Описание: Основная карта</p>
								        	<p>Остаток: 9000 руб.</p>">
                                                    Евро
                                                </div>
                                                <div class="col text-right text-success accountsum">
                                                    <b>1234 Euro</b>
                                                </div>
                                                <div class="col text-right text-success accountedit">
								        		<span class="pull-right">
			                        <span class="btn btn-xs btn-default">
			                        		<i class="fa fa-plus text-success" aria-hidden="true"></i>
			                            <i class="fa fa-edit text-success" aria-hidden="true"></i>
			                            <i class="fa fa-star text-success" aria-hidden="true"></i>
			                            <i class="fa fa-trash text-success" aria-hidden="true"></i>
			                        </span>
			                    	</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    Кошелёк
                                                </div>
                                                <div class="col text-right text-success">
                                                    <b>1850 RUB</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Я должен <span class="badge badge-dark">-3330480 RUB</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionLeft">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                Ипотека
                                            </div>
                                            <div class="col text-right text-danger">
                                                <b>-72790 RUB</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Инвестиции <span class="badge badge-light">898765 RUB</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionLeft">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                Инвестиции на дом
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>898765 RUB</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Имущество <span class="badge badge-light">3564789 RUB</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionLeft">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                Квартира Байконур
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>2155088 RUB</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                Квартира Лумумба
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>1200000 RUB</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                На квартиру доллары
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>0 $</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                На квартиру евро
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>2195 euro</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                На квартиру рубли
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>0 RUB</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Мой капитал
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionLeft">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                RUB
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>2155088 RUB</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                Dollar
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>1200000 RUB</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                Euro
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>0 $</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                Total
                                            </div>
                                            <div class="col text-right text-success">
                                                <b>2195 euro</b>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tags" role="tabpanel" aria-labelledby="nav-tags-tab">
                            <form class="mt-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="addTags" aria-describedby="emailHelp" placeholder="Новая метка">
                                </div>
                                <button type="submit" class="btn btn-primary">Добавить метку</button>
                            </form>
                            <nav class="mt-3" aria-label="Постраничный вывод меток">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <h3 class="mt-2">Список меток</h3>
                            <ul class="list-group">
                                <li class="list-group-item tag-item">Mobile
                                    <span class="pull-right edit-group">
                        <span class="btn btn-xs btn-default">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </span>
                    	</span>
                                </li>
                                <li class="list-group-item tag-item">PHP
                                    <span class="pull-right edit-group">
                        <span class="btn btn-xs btn-default">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </span>
                    	</span>
                                </li>
                                <li class="list-group-item tag-item">JS
                                    <span class="pull-right edit-group">
                        <span class="btn btn-xs btn-default">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </span>
                    	</span>
                                </li>
                                <li class="list-group-item tag-item">Шашлычная
                                    <span class="pull-right edit-group">
                        <span class="btn btn-xs btn-default">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </span>
                    	</span>
                                </li>
                                <li class="list-group-item tag-item">Бухалово
                                    <span class="pull-right edit-group">
                        <span class="btn btn-xs btn-default">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </span>
                    	</span>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="operations" role="tabpanel" aria-labelledby="nav-operations-tab">
                            <a href="#" class="text-success text-center">Журнал операций</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="border text-left mb-3">
                    <h1 class="m-2">Финансовое состояние</h1>
                    <div class="container">
                        <div class="text-center" data-toggle="tooltip" data-html="true" title="<b>Итоговая оценка здоровья на базе других финансовых показателей</b><br><span class='text-success'>У вас хорошее финансовое состояние, но не останавливайтесь на достигнутом!</span> <br> Важно, чтобы ваши деньги работали. Не стоит держать наличные, вкладывайте в депозиты и другие финансовые инструменты с высокой доходностью">
                            <h3>Общее финансовое состояние</h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">70%</div>
                            </div>
                        </div>
                        <div class="text-center" data-toggle="tooltip" data-html="true" title="<b>Насколько вы обеспечены деньгами: отношение доступных денег к среднему месячному расходу за последние 3 месяца</b><br><span class='text-success'>Поздравляем, вы имеете выше необходимого страхового запаса наличных денег, примерно на 6 месяцев и более!</span> <br> Думайте об инвестициях, деньги должны работать">
                            <h3>Деньги</h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">100%</div>
                            </div>
                        </div>
                        <div class="text-center" data-toggle="tooltip" data-html="true" title="<b>Удаётся ли сэкономить: насколько израсходован бюджет на текущий месяц</b><br><span class='text-success'>Сохраняйте темпы экономии, если месяц ещё не закончился</span> <br> Если у вас нет финансового резерва, начните откладывать деньги в страховой резерв.">
                            <h3>Бюджет</h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">10%</div>
                            </div>
                        </div>
                        <div class="text-center" data-toggle="tooltip" data-html="true" title="<b>Долговая нагрузка: какая часть доходов за последний месяц пошла на выплату кредитов и займов</b><br><span class='text-success'>Поздравляем, у вас высокий уровень финансовой независимости!</span> <br> У вас есть возможности для новых заимствований">
                            <h3>Долги</h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">50%</div>
                            </div>
                        </div>
                        <div class="text-center mb-2" data-toggle="tooltip" data-html="true" title="<b>Удаётся ли тратить меньше, чем вы получаете: превышение доходов над расходами, включая погашение ваших долгов за последние три месяца.</b><br><span class='text-danger'>Вам следуем либо больше зарабатывать, либо меньше тратить</span> <br> Вы должны иметь минимально 10% превышения доходов над расходами. Поработайте над бюджетом.">
                            <h3>Доходы</h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">80%</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="border text-left">
                    <h1>Финансовые цели</h1>
                    <div class="card-deck">
                        <div class="card">
                            <img src="img/auto.png" class="card-img-top" alt="Автомобиль">
                            <div class="card-body">
                                <h5 class="card-title">Автомобиль до 19.09.2019</h5>
                                <p class="card-text">Прогноз исполнения цели: 30.08.2019 <br> Уже накоплено:</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">700 руб.</div>
                                </div>
                                <button class="btn btn-primary">Редактировать</button>
                            </div>
                        </div>
                        <div class="card target" onclick="$('#newTarget').modal();">
                            <img src="img/target.png" class="card-img-top" alt="New Target">
                            <div class="card-body">
                                <h5 class="card-title">Добавить новую цель</h5>
                                <p class="card-text">Установите себе новую цель и отслеживайте её выполнение</p>
                            </div>
                        </div>
                        <div class="card target" onclick="$('#newTarget').modal();">
                            <img src="img/target.png" class="card-img-top" alt="New Target">
                            <div class="card-body">
                                <h5 class="card-title">Добавить новую цель</h5>
                                <p class="card-text">Установите себе новую цель и отслеживайте её выполнение</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 d-none d-sm-block">
                <div class="accordion" id="accordionRight">
                    <div class="card">
                        <div class="card-header" id="informer">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseRightOne" aria-expanded="true" aria-controls="collapseRightOne">
                                    Информер
                                </button>
                            </h2>
                        </div>

                        <div id="collapseRightOne" class="collapse show" aria-labelledby="informer" data-parent="#accordionRight">
                            <div class="card-body text-center">
                                <h2>Общее финансовое состояние:</h2>
                                <h3 class="text-success">Стабильное</h3>
                                <h4>Общий показатель:</h4>
                                <h4>90%</h4>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="courses">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseRightTwo" aria-expanded="false" aria-controls="collapseRightTwo">
                                    Курсы валют
                                </button>
                            </h2>
                        </div>
                        <div id="collapseRightTwo" class="collapse" aria-labelledby="courses" data-parent="#accordionRight">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        USD
                                    </div>
                                    <div class="col-sm">
                                        64.7550
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        EUR
                                    </div>
                                    <div class="col-sm">
                                        72.2890
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <a href="#" class="text-success">Настроить валюты</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="calculator">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseRightThree" aria-expanded="false" aria-controls="collapseRightThree">
                                    Калькулятор
                                </button>
                            </h2>
                        </div>
                        <div id="collapseRightThree" class="collapse" aria-labelledby="calculator" data-parent="#accordionRight">
                            <div class="calc-main">
                                <div class="panel panel-default">
                                    <div class="panel-heading" id="results-window">
                                        <h1 id="result"></h1>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row mb-2">
                                            <div class="col-xs-3">
                                                <button id="button-1" class="btn number mx-2" value="1"><p>1</p></button>
                                            </div>
                                            <div class="col-xs-3">
                                                <button id="button-2" class="btn number mx-2" value="2"><p>2</p></button>
                                            </div>
                                            <div class="col-xs-3">
                                                <button id="button-3" class="btn number mx-2" value="3"><p>3</p></button>
                                            </div>
                                            <div class="col-xs-3">
                                                <button id="button-plus" class="btn operator mx-2" value="+"><p>+</p></button>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-xs-3">
                                                <button id="button-4" class="btn number mx-2" value="4"><p>4</p></button>
                                            </div>

                                            <div class="col-xs-3">
                                                <button id="button-5" class="btn number mx-2" value="5"><p>5</p></button>

                                            </div>
                                            <div class="col-xs-3">
                                                <button id="button-6" class="btn number mx-2" value="6"><p>6</p></button>

                                            </div>
                                            <div class="col-xs-3">
                                                <button id="button-minus" class="btn operator mx-2" value="-"><p>&minus;</p></button>

                                            </div>

                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-xs-3">
                                                <button id="button-7" class="btn number mx-2" value="7"><p>7</p></button>
                                            </div>

                                            <div class="col-xs-3">
                                                <button id="button-8" class="btn number mx-2" value="8"><p>8</p></button>
                                            </div>

                                            <div class="col-xs-3">
                                                <button id="button-9" class="btn number mx-2" value="9"><p>9</p></button>
                                            </div>

                                            <div class="col-xs-3">
                                                <button id="button-multiply" class="btn operator mx-2" value="*"><p>&times;</p></button>
                                            </div>
                                        </div>

                                        <div class="row mb-2">


                                            <div class="col-xs-3">
                                                <button id="button-0" class="btn number  mx-2" value="0"><p>0</p></button>
                                            </div>

                                            <div class="col-xs-3">
                                                <button id="button-." class="btn number mx-2" value="."><p>.</p></button>
                                            </div>

                                            <div class="col-xs-3">
                                                <button id="button-divide" class="btn operator mx-2" value="/"><p>&divide;</p></button>
                                            </div>

                                            <div class="col-xs-3">
                                                <button id="button-power" class="btn operator mx-2" value="^"><p>^</p></button>
                                            </div>


                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-xs-2"></div>
                                            <div class=" col-xs-5">
                                                <button id="button-clear" class="btn btn-default clear mx-2" value="clear"><p>clear</p></button>
                                            </div>

                                            <div class="col-xs-5">
                                                <button id="button-equal" class="btn equal mx-2" value="="><p>=</p></button>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="calendar">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseRightFour" aria-expanded="false" aria-controls="collapseRightFour">
                                    Календарь
                                </button>
                            </h2>
                        </div>
                        <div id="collapseRightFour" class="collapse" aria-labelledby="calendar" data-parent="#accordionRight">
                            <!-- <div class="card-body"> -->
                            <div id="calendar">

                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Account -->
    </div>
    <add-new-account-component
                                :addnewaccount="addNewAccount"
                                v-on:changemodal="changeModal($event)"
                               :accounttypes="{{$accountTypes}}"
                               :currencies="{{$currencies}}"
                                :cards="{{$cardTypes}}"
                                :monthes="{{$monthes}}"
                                :years="{{$years}}"
                                createurl="{{route('account.store')}}"
    ></add-new-account-component>
    </div>
    <!-- Modal -->
    <div id="addOperation" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить операцию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Сумма</label>
                                <input type="text" class="form-control" id="sum" placeholder="0.00">
                                <small id="sumHelp" class="form-text text-muted">Пример: 12 + 33 * 45 Enter</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date">Дата</label>
                                <input type="date" class="form-control" id="date" placeholder="01.01.2001">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="date">Часы</label>
                                <input type="number" class="form-control" id="hour" placeholder="01">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="date">Минуты</label>
                                <input type="number" class="form-control" id="minutes" placeholder="01">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="accountName">Счёт для списания денег</label>
                                <select id="accountName" class="form-control select2">
                                    <option selected>Выберите счёт</option>
                                    <option value="alfabank">Альфабанк Общий</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="operationName">Тип операции</label>
                                <select id="operationName" class="form-control select2">
                                    <option selected>Выберите тип операции</option>
                                    <option value="rashod">Расход</option>
                                    <option value="dohod">Доход</option>
                                    <option value="perevod">Перевод со счёта</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category">Категория, по которой произойдёт списание денег</label>
                            <select id="category" class="form-control select2" style="width: 100%;">
                                <option selected>Выберите тип категории</option>
                                <option value="striptease">Расходы на стрип-клуб</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="metki">Метки</label>
                            <select id="metki" class="form-control select2" multiple="multiple" style="width: 100%;">
                                <option value="test">Тестовая метка</option>
                                <option value="107220">107220</option>
                            </select>
                            <small id="metkiHelp" class="form-text text-muted">Пометки для быстрого поиска. Например: аванс</small>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea type="text" class="form-control" id="comment"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <button type="button" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for calendar -->
    <div id="addToCalendar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить серию операций</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sumPeriod">Сумма</label>
                                <input type="text" class="form-control" id="sumPeriod" placeholder="0.00">
                                <small id="sumHelp" class="form-text text-muted">Пример: 12 + 33 * 45 Enter</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="datePeriod">Дата</label>
                                <input type="date" class="form-control" id="datePeriod" placeholder="01.01.2001">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="hourPeriod">Часы</label>
                                <input type="number" class="form-control" id="hourPeriod" placeholder="01">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="minutesPeriod">Минуты</label>
                                <input type="number" class="form-control" id="minutesPeriod" placeholder="01">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="accountNamePeriod">Счёт для списания денег</label>
                                <select id="accountNamePeriod" class="form-control select2">
                                    <option selected>Выберите счёт</option>
                                    <option value="alfabank">Альфабанк Общий</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="operationNamePeriod">Тип операции</label>
                                <select id="operationNamePeriod" class="form-control select2">
                                    <option selected>Выберите тип операции</option>
                                    <option value="rashod">Расход</option>
                                    <option value="dohod">Доход</option>
                                    <option value="perevod">Перевод со счёта</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoryPeriod">Категория, по которой произойдёт списание денег</label>
                            <select id="categoryPeriod" class="form-control select2" style="width: 100%;">
                                <option selected>Выберите тип категории</option>
                                <option value="striptease">Расходы на стрип-клуб</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="metkiPeriod">Метки</label>
                            <select id="metkiPeriod" class="form-control select2" multiple="multiple" style="width: 100%;">
                                <option value="test">Тестовая метка</option>
                                <option value="107220">107220</option>
                            </select>
                            <small id="metkiHelp" class="form-text text-muted">Пометки для быстрого поиска. Например: аванс</small>
                        </div>
                        <div class="form-group">
                            <label for="commentPeriod">Комментарий</label>
                            <textarea type="text" class="form-control" id="commentPeriod"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="repeat">Повторить</label>
                            <select id="repeat" class="form-control select2" style="width: 100%;">
                                <option value="no-repeat">Без повторения</option>
                                <option value="every-day">Каждый день</option>
                                <option value="every-week">Каждую неделю</option>
                                <option value="every-month">Каждый месяц</option>
                                <option value="every-quarter">Каждый квартал</option>
                                <option value="every-year">Каждый год</option>
                            </select>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="notify">
                            <label class="form-check-label" for="notify">Напомнить об операции по E-mail</label>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="notifyPeriod">Когда уведомлять</label>
                                <select id="notifyPeriod" class="form-control select2">
                                    <option value="now" selected>В тот же день</option>
                                    <option value="before-1-day">За 1 день</option>
                                    <option value="before-2-days">За 2 дня</option>
                                    <option value="before-3-days">За 3 дня</option>
                                    <option value="before-week">За неделю</option>
                                    <option value="before-month">За месяц</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="notifyHour">Часы</label>
                                <input type="number" class="form-control" id="notifyHour" placeholder="01">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="notifyMinutes">Минуты</label>
                                <input type="number" class="form-control" id="notifyMinutes" placeholder="01">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <button type="button" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- New Target Modal -->
    <div class="modal fade" id="newTarget" tabindex="-1" role="dialog" aria-labelledby="newTarget" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newTargetTitle">Финансовая цель</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="iWant">Хочу:</label>
                                <select id="iWant" class="form-control select2">
                                    <option value="savings" selected>Накопить</option>
                                    <option value="finishPay">Выплатить</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="targetCategory">Категория</label>
                                <select id="targetCategory" class="form-control select2">
                                    <option value="auto" selected>Автомобиль</option>
                                    <option value="bytTechnic">Бытовая техника</option>
                                    <option value="house">Дом</option>
                                    <option value="land">Земельный участок</option>
                                    <option value="appartment">Квартира</option>
                                    <option value="pc">Компьютер</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="targetName">Наименование</label>
                                <input type="text" class="form-control" id="targetName" placeholder="Автомобиль">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="targetSum">Сумма</label>
                                <input type="number" class="form-control" id="targetSum">
                                <small id="targetSumHelp" class="form-text text-muted">Пример: 12 + 33 * 45 Enter</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="targetFirstPayDate">Дата первого взноса</label>
                                <input type="date" class="form-control" id="targetFirstPayDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="targetStatus">Статус новой цели</label>
                                <select id="targetStatus" class="form-control select2">
                                    <option value="regular" selected>Обычная</option>
                                    <option value="favourite">Избранная</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="targetCurrency">Валюта цели</label>
                            <select class="form-control select2" id="targetCurrency">
                                <option value="RUB">Рубли</option>
                                <option value="USD">Доллар США</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="targetAccount">Счета для накопления</label>
                            <select class="form-control select2" id="targetAccount" multiple="multiple" style="width: 100%;">
                                <option value="alfabank">Альфабанк</option>
                                <option value="dollar">Доллар</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p>Еще копить: 0 Р</p>
                            </div>
                            <div class="form-group col-md-6">
                                <p>Итого накоплено: 0 Р</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="targetSavingAmount">Мне нужно откладывать ежемесячно</label>
                                <input type="text" class="form-control" id="targetSavingAmount">
                                <small id="targetSavingAmountHelp" class="form-text text-muted">Выводится усредненная сумма к накоплению за 30 дней</small>
                            </div>
                            <div class="form-group col-md-1 align-content-center">
                                <p>или</p>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="targetSavingDate">Мне нужно накопить к дате</label>
                                <input type="date" class="form-control" id="targetSavingDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="targetNotes">Комментарии</label>
                            <textarea class="form-control" id="targetNotes" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="targetPicture">Картинка для отображения цели</label>
                            <input type="file" class="form-control-file" id="targetPicture">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="targetDone">
                            <label class="form-check-label" for="targetDone">Финансовая цель выполнена</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
