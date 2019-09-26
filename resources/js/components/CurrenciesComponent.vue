<template>
    <div>
    <h1>Настройка валют</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Выбранные валюты
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" v-for="(active, index) in activeCurrencies" v-bind:key="active.id"><a href="#" v-on:click.prevent="selectActive(index)">{{active.code}} - {{active.currency_name}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card prokrutka">
                        <div class="card-header">
                            Доступные валюты
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" v-for="(inactive, index) in inactiveCurrencies" v-bind:key="inactive.id"><a href="#" v-on:click.prevent="selectInactive(index)">{{inactive.code}} - {{inactive.qty}} {{inactive.currency_name}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    <div class="form-group">
        <label>Валюта по умолчанию</label>
        <v-select label="currency_name" :options="activeCurrencies" v-model="defaultCurrency" @input="setActive"></v-select>
    </div>
    <button type="button" class="btn btn-primary" v-on:click="submitCurrencies">Сохранить</button>
    </div>
</template>

<script>
    export default {
        props: {
            currencies: {
                type: Array,
                required: true
            },
            updateurl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                activeCurrencies: [],
                inactiveCurrencies: [],
                defaultCurrency: {}
            }
        },

        methods: {
            selectInactive(index) {
                var currency = this.inactiveCurrencies[index];
                this.inactiveCurrencies.splice(index, 1);
                currency.is_active = '1';
                this.activeCurrencies.push(currency);
            },
            selectActive(index) {
                var currency = this.activeCurrencies[index];
                this.activeCurrencies.splice(index, 1);
                currency.is_active = '0';
                this.inactiveCurrencies.push(currency);
            },
            submitCurrencies() {
                var thisInstance = this;
                axios.post(this.endpoint, this.payload())
                    .then(function (response) {
                        thisInstance.$toast.success(response.data.message, "Success", { timeout: 3000 });
                    })
                    .catch(function (error) {
                        thisInstance.$toast.error(error.message, "Error", { timeout: 3000 });
                    });
            },

            setActive(e) {
                for(let i = 0; i < this.activeCurrencies.length; i++){
                    if (this.activeCurrencies[i].id === e.id) {
                        this.activeCurrencies[i].is_default = '1';
                    } else {
                        this.activeCurrencies[i].is_default = '0';
                    }
                }
            },

            payload() {
                return {
                    active: this.activeCurrencies,
                    defaultCurrency: this.defaultCurrency
                }
            }
        },

        computed: {
            endpoint() {
                return this.updateurl;
            },
        },

        mounted: function() {
            var thisInstance = this;
            this.currencies.forEach(function (elem) {
                if (elem.is_active > 0) {
                    thisInstance.activeCurrencies.push(elem);
                } else {
                    thisInstance.inactiveCurrencies.push(elem);
                }
                if (elem.is_default > 0) {
                    thisInstance.defaultCurrency = elem;
                }
            });
        }
    }
</script>

<style scoped>
    .prokrutka {
        height: 400px; /* высота нашего блока */
        background: #fff; /* цвет фона, белый */
        border: 1px solid #C1C1C1; /* размер и цвет границы блока */
        overflow-x: scroll; /* прокрутка по горизонтали */
        overflow-y: scroll; /* прокрутка по вертикали */
    }
</style>
