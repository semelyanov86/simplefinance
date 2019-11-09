<template>
    <div id="addNewAccount">
        <b-modal v-model="addnewaccount" hide-footer title="Добавить новый счёт">
            <form v-on:submit.prevent="addAccount">
                <div class="form-group">
                    <label for="accountType">Тип счёта</label>
                    <v-select
                        label="name"
                        v-model="account_type_id"
                        :options="types"
                    ></v-select>
                    <div class="invalid-feedback" v-if="$v.account_type_id.$invalid">
                        Пожалуйста, укажите тип счёта.
                    </div>
                    <div class="invalid-feedback" v-else-if="validData.account_type_id[0]">
                        {{validData.account_type_id[1]}}
                    </div>
                    <!--<select class="form-control select2" name="account_type" id="accountType">
                        <option value="cash">Наличные</option>
                        <option value="debitCard">Дебетовая карта</option>
                    </select>-->
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="acc_state" id="regularAcc" value="0" v-model="acc_state">
                    <label class="form-check-label" for="regularAcc">Обычный</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="acc_state" id="favouriteAcc" value="1" v-model="acc_state">
                    <label class="form-check-label" for="favouriteAcc">Избранный</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="acc_state" id="hiddenAcc" value="2" v-model="acc_state">
                    <label class="form-check-label" for="hiddenAcc">Скрытый</label>
                </div>
                <div class="invalid-feedback" v-if="$v.acc_state.$invalid">
                    Пожалуйста, укажите состояние счёта.
                </div>
                <div class="invalid-feedback" v-else-if="validData.acc_state[0]">
                    {{validData.acc_state[1]}}
                </div>
                <div class="form-group">
                    <label for="newAccountName">Название</label>
                    <input type="text" class="form-control"
                           :class="generateValidClasses('name')"
                           id="newAccountName"
                           v-model="name"
                           @blur="$v.name.$touch()"
                           ref="name"
                    >
                    <div class="invalid-feedback" v-if="$v.name.$error && !$v.name.required">
                        Пожалуйста, укажите наименование счёта.
                    </div>
                    <div class="invalid-feedback" v-else-if="$v.name.$error && !$v.name.minLength">
                        Минимальная длина счёта - 3 символа.
                    </div>
                    <div class="invalid-feedback" v-else-if="$v.name.$error && !$v.name.maxLength">
                        Максимальная длина счёта - 190 символов.
                    </div>
                    <div class="invalid-feedback" v-else-if="validData.name[0]">
                        {{validData.name[1]}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="accountNotes">Примечание</label>
                    <textarea class="form-control"
                              :class="generateValidClasses('description')"
                              id="accountNotes"
                              v-model="$v.description.$model"
                              rows="3"
                    ></textarea>
                    <div class="invalid-feedback" v-if="!$v.description.minLength">
                        Минимальная длина примечания - 5 символов
                    </div>
                    <div class="invalid-feedback" v-else-if="!$v.description.maxLength">
                        Максимальная длина примечания - 500 символов
                    </div>
                    <div class="invalid-feedback" v-else-if="validData.description[0]">
                        {{validData.description[1]}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="startBalance">Начальный баланс</label>
                    <input type="number" class="form-control"
                           :class="generateValidClasses('start_balance')"
                           id="startBalance"
                           v-model.number="start_balance"
                           @blur="$v.start_balance.$touch()"
                    >
                    <div class="invalid-feedback" v-if="$v.start_balance.$error && !$v.start_balance.required">
                        Пожалуйста, укажите начальный баланс.
                    </div>
                    <div class="invalid-feedback" v-else-if="$v.start_balance.$error && !$v.start_balance.integer">
                        Начальный баланс должен быть целым числом
                    </div>
                    <div class="invalid-feedback" v-else-if="$v.start_balance.$error && !$v.start_balance.minValue">
                        Начальный баланс должен принимать только положительное значение
                    </div>
                    <div class="invalid-feedback" v-else-if="validData.start_balance[0]">
                        {{validData.start_balance[1]}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="currencyType">Валюта счёта</label>
                    <v-select
                        label="currency_name"
                        v-model="currency_code"
                        :options="currencies"
                    ></v-select>
                    <div class="invalid-feedback" v-if="$v.currency_code.$invalid">
                        Пожалуйста, укажите валюту счёта.
                    </div>
                    <div class="invalid-feedback" v-else-if="validData.currency_code[0]">
                        {{validData.currency_code[1]}}
                    </div>
                </div>
                <div v-if="getComponentName != false && !showExtra" class="mb-2">
                    <a href="#" v-on:click.prevent="showExtra = !showExtra">Дополнительные настройки</a>
                </div>
                <extra-debit-card-component
                    v-if="getComponentName == 'ExtraDebitCard' && showExtra"
                    :debitCard="ExtraDebitCard"
                    :cards="cards"
                    :monthes="monthes"
                    :years="years"
                    :validation="$v.ExtraDebitCard"
                    :validData="validData.ExtraDebitCard"
                    @changeDebitCardValues="changeDebitCardValues($event)"
                ></extra-debit-card-component>
                <button type="button" v-on:click="changeModal(!addnewaccount)" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </b-modal>
    </div>
</template>

<script>
    const { required, minLength, integer, between, maxLength, minValue, numeric, decimal, maxValue } = require('vuelidate/lib/validators');

    export default {
        props: {
            addnewaccount: {
                type: Boolean,
                required: true
            },
            accounttypes: {
                type: Array,
                required: true
            },
            currencies: {
                type: Array,
                required: true
            },
            cards: {
                type: Array,
                required: true
            },
            monthes: {
                type: Array,
                required: true
            },
            years: {
                type: Array,
                required: true
            },
            createurl: {
                type: String,
                required: true
            }
        },
        // name: "AddNewAccountComponent",
        data() {
            return {
                'account_type_id': this.accounttypes[1],
                types: this.accounttypes,
                'currency_code': null,
                'acc_state': 0,
                showExtra: false,
                'name': null,
                'description': null,
                'start_balance': null,
                ExtraDebitCard: {
                    card_type_id: null,
                    expire_date_month: null,
                    expire_date_year: null,
                    year_cost: null,
                    rate_balance: null,
                    atm_commission: null,
                    other_atm_commission: null
                },
                validData: {
                    'account_type_id': [false, ''],
                    'currency_code': [false, ''],
                    'acc_state': [false, ''],
                    'name': [false, ''],
                    'description': [false, ''],
                    'start_balance': [false, ''],
                    ExtraDebitCard: {
                        card_type_id: [false, ''],
                        expire_date_month: [false, ''],
                        expire_date_year: [false, ''],
                        year_cost: [false, ''],
                        rate_balance: [false, ''],
                        atm_commission: [false, ''],
                        other_atm_commission: [false, '']
                    },
                }
            }
        },
        validations: {
            'account_type_id': {
                required
            },
            'currency_code': {
                required
            },
            'acc_state': {
                required, integer
            },
            'name': {
                required,
                maxLength: maxLength(190),
                minLength: minLength(3),
            },
            'description': {
                minLength: minLength(5),
                maxLength: maxLength(500)
            },
            'start_balance': {
                required,
                integer,
                minValue: minValue(0)
            },
            ExtraDebitCard: {
                expire_date_month: {
                    integer,
                    minValue: minValue(1),
                    maxValue: maxValue(12)
                },
                expire_date_year: {
                    integer,
                    minValue: minValue(2020),
                    maxValue: maxValue(2050)
                },
                year_cost: {
                    decimal,
                    minValue: minValue(0)
                },
                rate_balance: {
                    decimal,
                    minValue: minValue(0),
                    maxValue: maxValue(100)
                },
                atm_commission: {
                    decimal,
                    minValue: minValue(0),
                    maxValue: maxValue(100)
                },
                other_atm_commission: {
                    decimal,
                    minValue: minValue(0),
                    maxValue: maxValue(100)
                }
            }
        },
        methods: {
            changeModal(val) {
                this.$emit('changemodal', ['addNewAccount', val]);
            },
            changeDebitCardValues(e) {
                const name = e[0];
                const val = e[1];
                this.ExtraDebitCard[name] = val;
                this.$v.ExtraDebitCard[name].$touch();
            },
            payload() {
                let data = {
                    'acc_state': this.acc_state,
                    'account_type_id': this.account_type_id.id,
                    'currency_code': this.currency_code.code,
                    'description': this.description,
                    'name': this.name,
                    'start_balance': this.start_balance
                };
                let component = this.getComponentName;
                if (component) {
                    data[component] = this[component];
                }
                return data;
            },
            addAccount() {
                var thisInstance = this;
                this.$v.$touch();
                if (this.$v.$invalid) {
                    this.$toast.error('Невозможно отправить форму. Проверьте правильность заполнения полей', "Error", { timeout: 3000 });
                } else {
                    axios.post(this.endpoint, this.payload())
                        .catch(({response}) => {
                            console.log(response);
                            thisInstance.$toast.error(response.data.message, "Error", { timeout: 3000 });
                            if (response.status == 422) {
                                var errors = response.data.errors;
                                for (var prop in errors) {
                                    // thisInstance.$set(thisInstance.validData, prop, [true, errors[prop][0]]);
                                    var nameArr = prop.split('.');
                                    var i;
                                    var prevObj = thisInstance.validData;
                                    for (i = 0; i < nameArr.length; i++) {
                                        var tmpObj = prevObj[nameArr[i]];
                                        if (Array.isArray(tmpObj)) {
                                            thisInstance.$set(prevObj, nameArr[i], [true, errors[prop][0]]);
                                        } else {
                                            prevObj = tmpObj;
                                        }
                                    }
                                }
                            }
                        })
                        .then(({data}) => {
                            this.name = '';
                            this.description = '';
                            this.start_balance = '';
                            this.showExtra = false;
                            this.$v.$reset();
                            this.$toast.success(data.message, "Success", { timeout: 3000 });
                            this.changeModal(!this.addnewaccount)
                        });
                }
            },
            shouldAppendValidClass(field) {
                return !this.$v[field].$invalid && this.$v[field].$model && this.$v[field].$dirty && !this.validData[field][0];
            },
            shouldAppendErrorClass(field) {
                return this.$v[field].$error || this.validData[field][0];
            },
            generateValidClasses(field) {
                return {
                    'is-invalid' : this.shouldAppendErrorClass(field),
                    'is-valid' : this.shouldAppendValidClass(field)
                }
            }
        },
        computed: {
            endpoint() {
                return this.createurl;
            },
           getComponentName() {
               if (!this.account_type_id.extra_model) {
                   return false;
               }
               return this.account_type_id.extra_model.split("\\")[1];
           }
        },
        watch: {
            addnewaccount: function (val) {
                this.changeModal(val);
            },
        },
        mounted: function() {
            var self = this;
            this.currency_code = this.currencies.find(function(currency) {
                return currency.is_default > 0;
            });

        }
    }
</script>

<style scoped>

</style>
