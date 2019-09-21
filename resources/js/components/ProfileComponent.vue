<template>
    <div>
        <h1>Личные данные</h1>
        <form @submit.prevent="update">
            <div class="form-group">
                <label for="login">Логин</label>
                <input id="login" type="text" class="form-control" v-bind:class="{'is-invalid' : !login.validated}" name="login" v-model="login.value">
                <div class="invalid-feedback" v-show="!login.validated">
                    {{login.message}}
                </div>
            </div>
            <div class="form-group">
                <label for="oldPassword">Введите текущий пароль</label>
                <input type="password" class="form-control" v-bind:class="{'is-invalid' : !oldPassword.validated}" id="oldPassword" name="oldPassword" placeholder="Password" v-model="oldPassword.value">
                <div class="invalid-feedback" v-show="!oldPassword.validated">
                    {{oldPassword.message}}
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" class="form-control" v-bind:class="{'is-invalid' : !email.validated}" v-model="email.value">
                <div class="invalid-feedback" v-show="!email.validated">
                    {{email.message}}
                </div>
            </div>
            <div class="form-group">
                <label for="name">Имя</label>
                <input id="name" type="text" name="name" class="form-control" v-bind:class="{'is-invalid' : !name.validated}" v-model="name.value">
                <div class="invalid-feedback" v-show="!name.validated">
                    {{name.message}}
                </div>
            </div>
            <div class="form-group">
                <label for="operations">Кол-во выводимых операций по умолчанию в журнале операций:</label>
                <select class="form-control" v-bind:class="{'is-invalid' : !operations.validated}" name="operations" id="operations" v-model="operations.value">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                    <option>250</option>
                </select>
                <div class="invalid-feedback" v-show="!operations.validated">
                    {{operations.message}}
                </div>
            </div>
            <div class="form-group">
                <label for="dayStart">День начала бюджета:</label>
                <select class="form-control" v-bind:class="{'is-invalid' : !dayStart.validated}" name="dayStart" id="dayStart" v-model="dayStart.value">
                    <option v-for="n in 30">{{n}}</option>
                </select>
                <div class="invalid-feedback" v-show="!dayStart.validated">
                    {{dayStart.message}}
                </div>
            </div>
            <div class="form-group">
                <label for="password">Введите новый пароль</label>
                <input type="password" class="form-control" v-bind:class="{'is-invalid' : !password.validated}" name="password" id="password" placeholder="Password" v-model="password.value">
                <div class="invalid-feedback" v-show="!password.validated">
                    {{password.message}}
                </div>
            </div>
            <div class="form-group">
                <label for="password2">Повторите новый пароль</label>
                <input type="password" class="form-control" id="password2" name="password_confirmation" placeholder="Password" v-model="passwordConfirmation.value">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" v-bind:class="{'is-invalid' : !receiveNotify.validated}" id="emailcheck" v-model="receiveNotify.value">
                <label class="form-check-label" for="emailcheck">Получать уведомления на электронную почту</label>
                <div class="invalid-feedback" v-show="!receiveNotify.validated">
                    {{receiveNotify.message}}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['user', 'updateurl'],
        data() {
            return {
                login: {
                    value: this.user.login,
                    validated: true,
                    message: 'There was an error in field'
                },
                id: {
                    value: this.user.id,
                    validated: true,
                    message: 'There was an error in field'
                },
                name: {
                    value: this.user.name,
                    validated: true,
                    message: 'There was an error in field'
                },
                email: {
                    value: this.user.email,
                    validated: true,
                    message: 'There was an error in field'
                },
                operations: {
                    value: this.user.operations,
                    validated: true,
                    message: 'There was an error in field'
                },
                dayStart: {
                    value: this.user.day_start,
                    validated: true,
                    message: 'There was an error in field'
                },
                receiveNotify: {
                    value: this.user.receive_notify > 0,
                    validated: true,
                    message: 'There was an error in field'
                },
                password: {
                    value: '',
                    validated: true,
                    message: 'There was an error in field'
                },
                passwordConfirmation: {
                    value: '',
                    validated: true,
                    message: 'There was an error in field'
                },
                oldPassword: {
                    value: '',
                    validated: true,
                    message: 'There was an error in field'
                },
            }
        },
        methods: {
            update () {
                axios.put(this.endpoint, this.payload())
                    .catch(({response}) => {
                        this.$toast.error(response.data.message, "Error", { timeout: 3000 });
                        if (response.status == 422) {
                            for (var prop in response.data.errors) {
                                this[prop].validated = false;
                                this[prop].message = response.data.errors[prop][0];
                            }
                        }
                    })
                    .then(({data}) => {
                        this.$toast.success(data.message, "Success", { timeout: 3000 });
                    });
            },
            payload () {
                return {
                    'login' : this.login.value,
                    'name' : this.name.value,
                    'email' : this.email.value,
                    'password' : this.password.value,
                    'operations' : this.operations.value,
                    'day_start' : this.dayStart.value,
                    'receive_notify' : this.receiveNotify.value ? '1' : '0',
                    'oldPassword' : this.oldPassword.value,
                    'password_confirmation' : this.passwordConfirmation.value
                };
            },
        },
        computed: {
            endpoint() {
                return this.updateurl;
            }
        }
    }
</script>
