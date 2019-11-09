<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="card_type_id">Тип карты</label>
                <v-select
                    label="name"
                    :options="cards"
                    :value="debitCard.card_type_id"
                    @input="changeValue('card_type_id', $event)"
                ></v-select>
            </div>
            <div class="form-group col-md-3">
                <label for="expire_date_month">Месяц</label>
                <v-select
                    :options="monthes"
                    :value="debitCard.expire_date_month"
                    @input="changeValue('expire_date_month', $event)"
                ></v-select>
                <div class="invalid-feedback" v-if="!validation.expire_date_month.integer">
                    Значение должно содержать только цифры
                </div>
                <div class="invalid-feedback" v-else-if="!validation.expire_date_month.minValue">
                    Значение может быть не менее 1
                </div>
                <div class="invalid-feedback" v-else-if="!validation.expire_date_month.maxValue">
                    Значение не может превышать 12
                </div>
                <div class="invalid-feedback" v-else-if="validData.expire_date_month[0]">
                    {{validData.expire_date_month[1]}}
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="expire_date_year">Год</label>
                <v-select
                    :options="years"
                    :value="debitCard.expire_date_year"
                    @input="changeValue('expire_date_year', $event)"
                ></v-select>
                <div class="invalid-feedback" v-if="!validation.expire_date_year.integer">
                    Значение должно содержать только цифры
                </div>
                <div class="invalid-feedback" v-else-if="!validation.expire_date_year.minValue">
                    Значение может быть не менее 2020
                </div>
                <div class="invalid-feedback" v-else-if="!validation.expire_date_year.maxValue">
                    Значение не может превышать 2050
                </div>
                <div class="invalid-feedback" v-else-if="validData.expire_date_year[0]">
                    {{validData.expire_date_year[1]}}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="year_cost">Стоимость годового обслуживания</label>
                <input type="text" class="form-control" id="year_cost" placeholder="0.00"
                       :value="debitCard.year_cost"
                       v-on:change="changeInput('year_cost', $event)"
                       :class="generateValidClasses('year_cost')"
                >
                <div class="invalid-feedback" v-if="!validation.year_cost.decimal">
                    Значение должно содержать только цифры
                </div>
                <div class="invalid-feedback" v-else-if="!validation.year_cost.minValue">
                    Значение может быть только положительным
                </div>
                <div class="invalid-feedback" v-else-if="validData.year_cost[0]">
                    {{validData.year_cost[1]}}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="rate_balance">Годовая процентная ставка на остаток, %</label>
                <input type="text" class="form-control" id="rate_balance" placeholder="0.00"
                       :value="debitCard.rate_balance"
                       v-on:change="changeInput('rate_balance', $event)"
                       :class="generateValidClasses('rate_balance')"
                >
                <div class="invalid-feedback" v-if="!validation.rate_balance.decimal">
                    Значение должно содержать только цифры
                </div>
                <div class="invalid-feedback" v-else-if="!validation.rate_balance.minValue">
                    Значение может быть только положительным
                </div>
                <div class="invalid-feedback" v-else-if="!validation.rate_balance.maxValue">
                    Значение не может превышать 100%
                </div>
                <div class="invalid-feedback" v-else-if="validData.rate_balance[0]">
                    {{validData.rate_balance[1]}}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="atm_commission">Снятие наличных в банкомате банка, %</label>
                <input type="text" class="form-control" id="atm_commission" placeholder="0.00"
                       :value="debitCard.atm_commission"
                       v-on:change="changeInput('atm_commission', $event)"
                       :class="generateValidClasses('atm_commission')"
                >
                <div class="invalid-feedback" v-if="!validation.atm_commission.decimal">
                    Значение должно содержать только цифры
                </div>
                <div class="invalid-feedback" v-else-if="!validation.atm_commission.minValue">
                    Значение может быть только положительным
                </div>
                <div class="invalid-feedback" v-else-if="!validation.atm_commission.maxValue">
                    Значение не может превышать 100%
                </div>
                <div class="invalid-feedback" v-else-if="validData.atm_commission[0]">
                    {{validData.atm_commission[1]}}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="other_atm_commission">Снятие наличных в других банкоматах, %</label>
                <input type="text" class="form-control" id="other_atm_commission" placeholder="0.00"
                       :value="debitCard.other_atm_commission"
                       v-on:change="changeInput('other_atm_commission', $event)"
                       :class="generateValidClasses('other_atm_commission')"
                >
                <div class="invalid-feedback" v-if="!validation.other_atm_commission.decimal">
                    Значение должно содержать только цифры
                </div>
                <div class="invalid-feedback" v-else-if="!validation.other_atm_commission.minValue">
                    Значение может быть только положительным
                </div>
                <div class="invalid-feedback" v-else-if="!validation.other_atm_commission.maxValue">
                    Значение не может превышать 100%
                </div>
                <div class="invalid-feedback" v-else-if="validData.other_atm_commission[0]">
                    {{validData.other_atm_commission[1]}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            cards: {
                type: Array,
                required: true
            },
            debitCard: {
                type: Object,
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
            validation: {
                required: false,
                type: Object
            },
            validData: {
                required: true,
                type: Object
            }
        },
        name: "ExtraDebitCardComponent",
        data() {
            return {
                floatFields: ['year_cost', 'rate_balance', 'atm_commission', 'other_atm_commission']
            }
        },
        methods: {
            changeValue(value, e) {
                let data = [value, e];
                this.$emit('changeDebitCardValues', data);
            },
            changeInput(value, e) {
                this.changeValue(value, this.convertType(value, e.target.value));
            },
            convertType(value, e) {
                if (this.floatFields.includes(value)){
                    if (parseFloat(e)) {
                        return parseFloat(e).toFixed(2);
                    } else {
                        return 0;
                    }
                } else {
                    return e;
                }
            },
            shouldAppendValidClass(field) {
                return !this.validation[field].$invalid && this.validation[field].$model && this.validation[field].$dirty && !this.validData[field][0];
            },
            shouldAppendErrorClass(field) {
                return this.validation[field].$error || this.validData[field][0];
            },
            generateValidClasses(field) {
                return {
                    'is-invalid' : this.shouldAppendErrorClass(field),
                    'is-valid' : this.shouldAppendValidClass(field)
                }
            }
        }
    }
</script>

<style scoped>

</style>
