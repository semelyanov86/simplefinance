<template>
    <div>
    <h1>Пользователи</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Логин</th>
            <th scope="col">Имя</th>
            <th scope="col">Пароль</th>
            <th scope="col">Активен</th>
            <th scope="col">Роль</th>
            <th scope="col">Email</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(user, index) in allUsers" v-bind:key="user.id">
            <th scope="row">{{user.id}}</th>
            <td>{{user.login}}</td>
            <td>
                <div class="input-group">
                    <input type="text" aria-label="Имя" class="form-control" v-model="user.name">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="password" aria-label="Password" class="form-control" placeholder="Введите для изменения" v-model="user.password">
                </div>
            </td>
            <td class="text-center align-items-center">
                <!-- <div class="input-group"> -->
                <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="user['is_active']">
                <!-- </div> -->
            </td>
            <td>
                <select id="role" class="form-control" :value="user.role.id" v-on:change="updateRole(index, $event)">
                <option v-for="(role, index) in roles" v-bind:key="role.id" v-bind:value="role.id">{{role.name}}</option>
            </select>
            </td>
            <td>
                <div class="input-group">
                    <input type="email" class="form-control" v-model="user.email">
                </div>
            </td>
            <td><a href="#" v-on:click="updateUser(index)"><i class="fa fa-lg fa-save"></i></a><a href="#" v-on:click="deleteUser(index)"><i class="fa fa-lg fa-trash ml-2"></i></a></td>
        </tr>
        </tbody>
    </table>
    <h2>Добавить пользователя</h2>
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
                <div class="form-group">
                    <label for="choose-role">Choose Role</label>
                    <select id="choose-role" class="form-control" v-model="role.value">
                        <option v-for="(role, index) in roles" v-bind:key="role.id" v-bind:value="role.name">{{role.name}}</option>
                    </select>
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
    </div>
</template>

<script>
    export default {
        props: ['saveurl', 'users', 'roles', 'updateurl'],

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
              role: {
                value: 'main user',
                validated: true,
                message: 'There was an error in field'
              },
              allUsers: []
          }
        },

        methods: {
          payload() {
              return {
                  'login' : this.login.value,
                  'name' : this.name.value,
                  'email' : this.email.value,
                  'password' : this.password.value,
                  'password_confirmation' : this.passwordConfirmation.value,
                  'role' : this.role.value
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
                        this.$toast.success(data.message, "Success", { timeout: 3000 });
                        thisInstance.allUsers.push(data.user);
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
            },
            updateRole(index, event) {
              this.allUsers[index].role.id = event.target.value;
              this.allUsers[index].role.name = event.target.selectedOptions[0].text;
            },
            updateUser(index) {
              let currentUser = this.allUsers[index];
              if (currentUser.password) {
                  currentUser['password_confirmation'] = currentUser.password;
              } else {
                  delete currentUser.password;
              }
                var thisInstance = this;
                axios.put(this.updatepoint, currentUser)
                    .catch(({response}) => {
                        this.$toast.error(response.data.message, "Error", { timeout: 3000 });
                    })
                    .then(({data}) => {
                        this.$toast.success(data.message, "Success", { timeout: 3000 });
                    });

            },
            deleteUser(index) {
              let currentUser = this.allUsers[index];
              var thisInstance = this;
                this.$confirm({
                    title: 'Deleting account',
                    content: 'Are you sure you want to delete account? This action cannot be undone.'
                })
                    .then(success => {
                        axios.delete('/settings/user/delete/' + currentUser.id)
                            .catch(({response}) => {
                                thisInstance.$toast.error(response.data.message, "Error", { timeout: 3000 });
                            })
                            .then(({data}) => {
                                thisInstance.$toast.success(data.message, "Success", { timeout: 3000 });
                                thisInstance.allUsers.splice(index, 1);
                            });
                    })
                    .catch(cancel => {

                    })

            }
        },

        computed: {
            endpoint() {
                return this.saveurl;
            },
            updatepoint() {
                return this.updateurl;
            }
        },
        mounted: function () {
            var thisInstance = this;
            this.users.forEach(function (elem) {
                elem.password = '';
                thisInstance.allUsers.push(elem);
            });
        }
    }
</script>

<style scoped>

</style>
