<template>
<div class="row" style="margin-bottom: 15px">
    <div class="col-xs-12">
        <div class="btn-group" role="group">
            <button class="btn btn-success btn-lg"
                @click="addCategory()">
                <i class="fa fa-film"></i> 添加分类
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success" v-show="success">
            {{ message }}
        </div>

        <div class="panel">
            <header class="panel-heading">
                分类列表
            </header> <!-- panel-heading -->
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th v-for="column in columns">{{ column }}</th>
                            <th width="1%"><i class="fa fa-edit"></i></th>
                            <th width="1%" v-if="isBoss"><i class="fa fa-remove"></i></th>
                         </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in categories">
                            <td>{{ category.id }}</td>
                            <td width="15%"><img :src="category.image" width="30px"></td>
                            <td>{{ category.name }}</td>
                            <td>{{ category.created_at | date }}</td>
                            <td>
                                <a @click="editCategory(category)">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td v-if="isBoss">
                                <a @click="deleteSeriesForm(category.id)" class="delete">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form @submit.prevent="saveCategory" id="saveCategoryForm">
    <div class="modal fade" id="saveCategoryModal">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">保存分类</h4>
                </div>

                <div class="alert alert-danger" v-if="hasError">
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <!-- Name field -->
                        <div class="form-group">
                            <label for="name">名称</label>
                            <input type="text" class="form-control" id="name" name="name" v-model="newCategory.name">
                        </div>
                        <div class="form-group">
                            <label for="categoryImage">图片</label>
                            <input type="file" name="image" id="categoryImage" class="form-control">
                        </div>
                        <div class="form-group" v-if="editing">
                            <img :src="newCategory.image" id="editImageSrc">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="submit" class="btn btn-danger" value="确认"></input>
                </div>
            </div>
        </div>
    </div>
</form>
<form @submit.prevent="deleteCategory" id="deleteCategory">
    <div class="modal fade" id="deleteCateModal">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">请输入密码</h4>
                </div>

                <div class="alert alert-danger" v-if="hasError">
                    {{ error }}
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="submit" class="btn btn-danger" value="确认"></input>
                </div>
            </div>
        </div>
    </div>
</form>
</template>

<script>
module.exports = {
    data() {
        return {
            columns: [
                'ID',
                '图片',
                '名称',
                '创建时间'
            ],

            categories: [],

            newCategory: {
                id: '',
                name: '',
                image: '',
                created_at: '',
                updated_at: ''
            },

            editing: false,

            hasError: false,
            errors: [],
            error: '',

            success: false,
            message: '',

            editImageSrc: '',

            deleteId: ''
        }
    },

    props: ['roles'],

    created() {
        this.getCategories();
    },

    computed: {
        isBoss() {
            let names = this.roles.map(role => role.name);

            return names.indexOf('boss') != -1;
        }
    },

    methods: {
        getCategories() {
            this.$http.get('/admin/categories')
                .then(function(response) {
                    this.categories = response.data;
                });
        },

        addCategory() {
            this.editing = false;
            this.resetCategoryForm();

            jQuery('#saveCategoryModal').modal('show');
        },

        editCategory(cate) {
            this.editing = true;
            this.setCategoryForm(cate.id, cate.name, cate.image, cate.created_at, cate.updated_at);

            jQuery('#saveCategoryModal').modal('show');
        },

        deleteSeriesForm(id) {
            this.deleteId = id;
            jQuery('#password').val('');

            jQuery('#deleteCateModal').modal('show');
        },

        deleteCategory() {
            var self = this;
            let password = jQuery('#password').val();

            if (password.length == 0) {
                return;
            }

            self.$http.delete('/admin/categories/' + self.deleteId, {password})
                .then(function(response) {
                    self.showMessage(response.data.message);
                    self.removeCategoryById(self.deleteId);

                    jQuery('#deleteCateModal').modal('hide');

                })
                .catch(function(response) {
                    self.hasError = true;
                    self.error = response.data.error;

                    setTimeout(function() {
                        self.hasError = false;

                        jQuery('#deleteSeriesModal').modal('hide');
                    }, 2800);
                });
        },

        removeCategoryById(id) {
            let index = this.findIndexById(id);

            this.categories.splice(index, 1);
        },

        setCategoryForm(id, name, image, created_at, updated_at) {
            this.newCategory = {id, name, image, created_at, updated_at};
        },

        resetCategoryForm() {
            this.setCategoryForm('', '', '', '', '');
            jQuery('#categoryImage').val('');
        },

        saveCategory() {
            let self = this;
            let request = new XMLHttpRequest();
            let formdata = new FormData(document.getElementById('saveCategoryForm'));

            if (! self.editing) {
                request.open('post', '/admin/categories');
            } else {
                request.open('post', '/admin/categories/update/' + self.newCategory.id);
            }

            request.setRequestHeader("X-CSRF-Token", document.querySelector('#token').getAttribute('value'));
            request.send(formdata);

            request.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (request.status == 400) {
                        self.showErrors(JSON.parse(request.responseText).errors);
                    } else if (request.status == 200) {
                        jQuery('#saveCategoryModal').modal('hide');

                        self.showMessage(JSON.parse(request.responseText).message);

                        let category = JSON.parse(request.responseText).data;

                        if (! self.editing) {
                            self.categories.unshift(category);
                        } else {
                            self.updateCategories(category);
                        }
                    }
                }
            }
        },

        updateCategories(category) {
            let index = this.findIndexById(category.id);

            this.categories.$set(index, category);
        },

        findIndexById(id) {
            let ids = this.categories.map(c => c.id);

            return ids.indexOf(id);
        },

        showMessage(message) {
            this.success = true;
            this.message = message;

            setTimeout(function() {
                this.success = false;
            }.bind(this), 2800);
        },

        showErrors(errors) {
            this.errors = [];
            this.hasError = true;

            for(let key in errors) {
                this.errors.push(errors[key][0]);
            }

            setTimeout(function() {
                this.hasError = false;
            }.bind(this), 2800);
        }
    }
}
</script>
