<template>
    <div>
    <h1>Категории</h1>
    <div class="row mt-2">
        <div class="col-4">
            <a class="btn btn-primary" href="#addCategory" role="button" v-on:click.prevent="isCreateHidden = !isCreateHidden">
                Добавить категорию
            </a>
        </div>
        <div class="col-4">
            <button class="btn btn-danger">Восстановить</button>
        </div>
        <div class="col-4 form-check">
            <input type="checkbox" name="hidden-categories" class="form-check-input" id="hidden-categories" v-model="showHidden">
            <label for="hidden-categories" class="form-check-label">Показать скрытые</label>
        </div>
    </div>
    <div id="addCategory" v-show="!isCreateHidden">
        <div class="card card-body">
            <h5 class="card-title">Добавление новой категории</h5>
            <form @submit.prevent="create">
                <div class="form-group">
                    <label for="categoryName">Название категории</label>
                    <input type="text" class="form-control" v-bind:class="{'is-invalid' : !validation.category_name[0]}" id="categoryName" v-model="newcategory">
                    <div class="invalid-feedback" v-show="!validation.category_name[0]">
                        {{validation.category_name[1]}}
                    </div>
                </div>
                <div class="form-group">
                    <label>Тип категории</label>
                    <v-select :options="types" v-model="type" @input="changeList"></v-select>
                    <div class="invalid-feedback" v-if="!validation.category_type[0]" style="display: block;">
                        {{validation.category_type[1]}}
                    </div>
                </div>
                <div class="form-group">
                    <label>Подкатегория для</label>
                    <v-select label="category_name" :options="filteredCategories" v-model="category"></v-select>
                    <div class="invalid-feedback" v-if="!validation.parent_id[0]" style="display: block;">
                        {{validation.parent_id[1]}}
                    </div>
                </div>
                <div class="form-group">
                    <label>Системная категория</label>
                    <v-select label="sys_category_name" :options="filteredSysCategories" v-model="syscategory"></v-select>
                    <div class="invalid-feedback" v-if="!validation.sys_category_id[0]" style="display: block;">
                        {{validation.sys_category_id[1]}}
                    </div>
                    <!--<select class="form-control select2" id="sysCategory" v-model="syscategory">
                        <option v-for="(syscategory, index) in syscategories">{{syscategory.sys_category_name}}</option>
                    </select>-->
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="isHiddenCategory" v-model="isHidden">
                    <label class="form-check-label" for="isHiddenCategory">
                        Скрытая категория
                    </label>
                    <div class="invalid-feedback" v-show="!validation.isHidden[0]">
                        {{validation.isHidden[1]}}
                    </div>
                </div>
                <div class="btn-group mt-2" role="group">
                    <button type="button" class="btn btn-danger" v-on:click.prevent="isCreateHidden = true">Отменить</button>
                    <button type="submit" class="btn btn-success ml-2">Сохранить</button>
                </div>
            </form>

        </div>
    </div>

<!--        https://xaksis.github.io/vue-good-table/guide/#installation-->

        <!--<vue-good-table
            :columns="fields"
            :rows="categoriesList">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'show_details'">
                    <b-button size="sm" class="mr-2">
                        Show Details
                    </b-button>
                </span>
                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>-->
    <b-table striped hover responsive sticky-header head-variant="light"
             :items="filtered"
             :fields="fields"
             :tbody-tr-class="rowClass"
    >
        <!--<template v-slot:cell(show_details)="row">
            <b-button size="sm" @click="row.toggleDetails" class="mr-2">
                {{ row.detailsShowing ? 'Hide' : 'Show'}} Details
            </b-button>
        </template>-->
        <template v-slot:head(category_name)="scope">
            {{scope.label}} <a href="#" v-on:click.prevent="openSearchPanel('category_name')"><i class="fa fa-search"></i></a>
        </template>
        <template v-slot:head(category_type)="scope">
            {{scope.label}} <a href="#" v-on:click.prevent="openSearchPanel('category_type')"><i class="fa fa-filter"></i></a>
        </template>
        <template slot="top-row" slot-scope="{ fields }">
            <td v-for="field in fields" :key="field.key" v-show="showSearch">
                <div class="form-group"  v-if="field.key == 'category_name'">
                    <input class="form-control" v-model="filters[field.key]" ref="category_name">
                </div>
                <div class="form-group" v-if="field.key == 'category_type'">
                    <select class="form-control" v-model="filters[field.key]" ref="category_type">
                        <option value="all">Все</option>
                        <option value="-1">Расходная</option>
                        <option value="1">Приходная</option>
                    </select>
                </div>
            </td>
        </template>
        <template v-slot:cell(show_details)="row">
            <b-button size="sm" @click="expand(row)" class="mr-2" v-if="!row.item.parent_id">
                {{ row.detailsShowing ? '-' : '+'}}
            </b-button>
        </template>
        <template v-slot:cell(category_name)="row">
            <span v-if="row.item.parent_id">&nbsp;&nbsp;</span>
            {{row.value}}
        </template>
        <template v-slot:cell(actions)="row">
            <a href="#" @click.prevent="openEdit(row.item)"><i class="fa fa-edit"></i></a>
            <a href="#" @click.prevent="deleteRow(row)"><i class="fa fa-trash"></i></a>
            <a href="#" @click.prevent="addEdit(row.item)"><i class="fa fa-plus"></i></a>
        </template>
    </b-table>
    </div>
</template>

<script>
    export default {
        name: "CategoriesComponent",
        props: {
            syscategories: {
                type: Array,
                required: true
            },
            categories: {
                type: Array,
                required: true
            },
            createurl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                criteria: '',
                fields: [
                    {
                        key: 'show_details',
                        label: ''
                    },
                    {
                    key: 'category_name',
                    label: 'Категория'
                    },
                    {
                        key: 'category_type',
                        label: 'Тип',
                        formatter: 'typeFormat'
                    },
                    {
                        key: 'sys_category_id',
                        label: 'Системная категория',
                        formatter: 'parentFormat'
                    },
                    {
                        key: 'actions',
                        label: 'Действия'
                    }
                ],
                filters: {
                    category_name: '',
                    category_type: 'all'
                },
                isCreateHidden: true,
                showHidden: false,
                showSearch: false,
                syscategory: this.syscategories[7],
                types: [
                    {
                        label: 'Приходная',
                        code: '1'
                    },
                    {
                        label: 'Расходная',
                        code: '-1'
                    }
                ],
                type: {
                    label: 'Приходная',
                    code: '1'
                },
                categoriesList: this.categories,
                category: {},
                newcategory: '',
                isHidden: false,
                filter: null,
                filterOn: ['category_name'],
                validation: {
                    'category_name' : [true, 'There was an error in category_name field'],
                    'sys_category_id' : [true, 'There was an error in sys_category_id field'],
                    'category_type' : [true, 'There was an error in category_type field'],
                    'isHidden' : [true, 'There was an error in isHidden field'],
                    'parent_id' : [true, 'There was an error in parent_id field'],
                }
            }
        },
        methods: {
            payload() {
                return {
                    'category_name' : this.newcategory,
                    'sys_category_id' : this.syscategory.id,
                    'category_type' : this.type.code,
                    'isHidden' : this.isHidden ? '1' : '0',
                    'parent_id' : this.category.id
                }
            },
            clearValidation() {
                this.validation = Object.assign({}, this.validation, {
                    'category_name' : [true, 'There was an error in category_name field'],
                    'sys_category_id' : [true, 'There was an error in sys_category_id field'],
                    'category_type' : [true, 'There was an error in category_type field'],
                    'isHidden' : [true, 'There was an error in isHidden field'],
                    'parent_id' : [true, 'There was an error in parent_id field'],
                })
            },
            changeList() {
                var sysCats = this.filteredSysCategories;
                this.syscategory = sysCats[0];
            },
            expand(row) {
                row.item._showDetails = !row.item._showDetails;
                this.categoriesList.forEach(function(item){
                    if (item.parent_id == row.item.id) {
                        item.isCollapsed = !item.isCollapsed;
                    }
                });
            },
            create() {
                var thisInstance = this;
                axios.post(this.endpoint, this.payload())
                    .catch(({response}) => {
                        thisInstance.$toast.error(response.data.message, "Error", { timeout: 3000 });
                        if (response.status == 422) {
                            thisInstance.clearValidation();
                            for (var prop in response.data.errors) {
                                var curValidate = thisInstance.validation[prop];
                                thisInstance.$set(thisInstance.validation, prop, [false, response.data.errors[prop][0]]);
                                /*curValidate[0] = false;
                                curValidate[1] = response.data.errors[prop][0];*/
                            }
                        }
                    })
                    .then(({data}) => {
                        this.$toast.success(data.message, "Success", { timeout: 3000 });
                        this.category = {};
                        this.newcategory = '';
                        this.isHidden = false;
                        this.clearValidation();
                        if (!data.parent_id) {
                            data._showDetails = true;
                        }
                        thisInstance.categoriesList.push(data);
                    });
            },
            openEdit(row) {
                this.isCreateHidden = false;
                this.newcategory = row.category_name;
                this.type.code = row.category_type;
                this.type.label = this.types.find(function(element) {
                    return element.code == row.category_type;
                }).label;
                this.syscategory = this.syscategories.find(function(element) {
                    return element.id == row.sys_category_id;
                });
                this.category = this.categoriesList.find(function(element) {
                    return element.id == row.parent_id;
                });
                this.isHidden = row.isHidden > 0;
            },
            addEdit(row) {
                this.isCreateHidden = false;
                this.newcategory = '';
                this.type.code = row.category_type;
                this.type.label = this.types.find(function(element) {
                    return element.code == row.category_type;
                }).label;
                this.syscategory = this.syscategories.find(function(element) {
                    return element.id == row.sys_category_id;
                });
                this.category = row;
                this.isHidden = row.isHidden > 0;
            },
            deleteRow(row) {
                var thisInstance = this;
                this.$confirm({
                    title: 'Deleting category',
                    content: 'Are you sure you want to delete category? You can then restore it from recycle bin.'
                })
                    .then(success => {
                        axios.delete('/settings/categories/delete/' + row.item.id)
                            .catch(({response}) => {
                                thisInstance.$toast.error(response.data.message, "Error", { timeout: 3000 });
                            })
                            .then(({data}) => {
                                thisInstance.$toast.success(data.message, "Success", { timeout: 3000 });
                                thisInstance.categoriesList.splice(row.index, 1);
                            });
                    })
                    .catch(cancel => {

                    });
            },
            rowClass(item, type) {
                if(!item) {
                    return;
                }
                if(item.isCollapsed) {
                    return 'hidden';
                } else if(item.isHidden > 0 && !this.showHidden) {
                    return 'hidden';
                }
            },
            typeFormat(value) {
                if(value > 0) {
                    return 'Приходная';
                } else {
                    return 'Расходная';
                }
            },
            parentFormat(value) {
                return this.syscategories.find(function(element) {
                    return element.id == value;
                }).sys_category_name;
            },
            openSearchPanel(name) {
                this.showSearch = !this.showSearch;
                this.$refs[name][0].focus();

            }
        },
        computed: {
            filteredSysCategories() {
                var thisInstance = this;
                return this.syscategories.filter(syscategory => syscategory.sys_category_type == thisInstance.type.code);
            },
            filteredCategories() {
                var thisInstance = this;
                return this.categoriesList.filter(category => category.sys_category_id == thisInstance.syscategory.id);
            },
            endpoint() {
                return this.createurl;
            },
            filtered () {
                var thisInstance = this;
                var result = this.categoriesList.filter(function(category){
                    for (var filter in thisInstance.filters) {
                        if (thisInstance.filters[filter] == 'all') {
                            return true;
                        } else if(!category.parent_id) {
                            return true;
                        } else {
                            return category.category_name.includes(thisInstance.filters[filter])
                        }
                    }
                });
                return result;
                /*const filtered = this.categoriesList.filter(item => {
                    return Object.keys(this.filters).every(key =>
                        String(item[key]).includes(this.filters[key]))
                });
                return filtered.length > 0 ? filtered : [{
                    category_name: '',
                    category_type: ''
                }]*/
            }
        }
    }
</script>

<style scoped>
.hidden {
    display: none;
}
</style>
