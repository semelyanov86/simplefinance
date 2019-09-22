<template>
    <div class="row">
        <div class="col">
            <form @submit.prevent="save">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" class="form-control"  v-bind:class="{'is-invalid' : !login.validated}" id="login" name="login" v-model="login.value" placeholder="Введите логин пользователя">
                    <span class="invalid-feedback" role="alert" v-show="!login.validated">
                           <strong>{{ login.message }}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control"  v-bind:class="{'is-invalid' : !email.validated}" id="email" name="email" v-model="email.value" placeholder="Введите email пользователя">
                    <span class="invalid-feedback" role="alert" v-show="!email.validated">
                           <strong>{{ email.message }}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" v-bind:class="{'is-invalid' : !name.validated}" v-model="name.value" id="name" name="name" placeholder="Введите имя пользователя">
                    <span class="invalid-feedback" role="alert" v-show="!name.validated">
                           <strong>{{ name.message }}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" v-bind:class="{'is-invalid' : !password.validated}" v-model="password.value" name="password" id="password" placeholder="Придумайте пароль">
                    <span class="invalid-feedback" role="alert" v-show="!password.validated">
                           <strong>{{ password.message }}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" v-model="passwordConfirmation.value" id="password-confirm" placeholder="Повторите пароль">
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
        <div class="col">
            <h3>Внимание!</h3>
            <ul>
                <li>
                    После добавления пользователя он сможет войти через обычную форму авторизации.
                </li>
                <li>
                    При деактивации пользователя вход в систему будет заблокирован.
                </li>
                <li>
                    Пользователю доступно удаление только своих счетов и операций.
                </li>
                <li>
                    При удалении пользователя счета и операции, созданные им не удаляются из системы.
                </li>
                <li>
                    Пользователю недоступен вход в настройки.
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['saveurl'],

        data() {
          return {
              login: {
                  value: '',
                  validated: true,
                  message: 'There was an error in field'
              },
              email: {
                  value: '',
                  validated: true,
                  message: 'There was an error in field'
              },
              name: {
                  value: '',
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
          }
        },

        methods: {
          payload() {
              return {
                  'login' : this.login.value,
                  'name' : this.name.value,
                  'email' : this.email.value,
                  'password' : this.password.value,
                  'password_confirmation' : this.passwordConfirmation.value
              }
          },
            save() {
              var thisInstance = this;
                axios.post(this.endpoint, this.payload())
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
                        console.log(data);
                        this.$toast.success(data.message, "Success", { timeout: 3000 });
                        thisInstance.login.value = '';
                        thisInstance.login.validated = true;
                        thisInstance.email.value = '';
                        thisInstance.email.validated = true;
                        thisInstance.name.value = '';
                        thisInstance.name.validated = true;
                        thisInstance.password.value = '';
                        thisInstance.password.validated = true;
                        thisInstance.passwordConfirmation.value = '';
                    });
            }
        },

        computed: {
            endpoint() {
                return this.saveurl;
            }
        }
    }
</script>

<style scoped>

</style>
