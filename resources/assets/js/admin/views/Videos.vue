<template>
<div class="row" style="margin-bottom: 15px">
    <div class="col-xs-12">
        <div class="btn-group" role="group">
            <button class="btn btn-success btn-lg"
                @click="addSeries()">
                <i class="fa fa-film"></i> 添加系列
            </button>
            <button class="btn btn-success btn-lg">
                <span class="fa fa-youtube-play"></span> 添加视频
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
                系列列表
            </header> <!-- panel-heading -->

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th v-for="column in seriesColumns">{{ column }}</th>
                            <th width="1%"><i class="fa fa-eye"></i></th>
                            <th width="1%"><i class="fa fa-edit"></i></th>
                            <th width="1%" v-if="isBoss"><i class="fa fa-remove"></i></th>
                        </tr>
                    </thead>
                    <tbody v-for="serie in series">
                        <tr>
                            <td>{{ serie.id }}</td>
                            <td width="15%"><img :src="serie.image" width="30px"></td>
                            <td>{{ serie.title }}</td>
                            <td>{{ serie.videos.length }}</td>
                            <td>
                                <span v-for="category in serie.categories"
                                    class="label label-primary">
                                    {{ category.name }}
                                </span>
                            </td>
                            <td>{{ serie.created_at | date }}</td>
                            <td>
                                <a @click.stop="toggleDescription(serie.id)">
                                    <i class="fa"
                                       :class="{ 'fa-arrow-circle-down': showDescription.indexOf(serie.id) === -1,
                                                 'fa-arrow-circle-left': showDescription.indexOf(serie.id) !== -1 }"
                                    ></i>
                                </a>
                            </td>
                            <td>
                                <a @click="editSeries(serie)">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td v-if="isBoss">
                                <a @click="deleteSeriesForm(serie.id)" class="delete">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                        <tr v-show="showDescription.indexOf(serie.id) > -1">
                            <td colspan="8"><b>描述：</b>{{ serie.description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- panel-body -->
        </div>
    </div> <!-- col-12 -->

    <form @submit.prevent="deleteSeries" id="deleteSeries">
        <div class="modal fade" id="deleteSeriesModal">
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

    <form @submit="saveSerie" id="serieForm" enctype="multipart/form-data">
        <div class="modal fade" id="createSeriesModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">系列管理</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" v-if="hasError">
                            <ul>
                                <li v-for="error in errorArray">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="serieTitle">标题</label>
                            <input type="text" name="title" v-model="newSerie.title" id="serieTitle" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="serieImage">图片</label>
                            <input type="file" name="image" id="serieImage" class="form-control">
                        </div>
                        <div class="form-group" v-if="editing">
                            <img :src="newSerie.image" id="editImageSrc">
                        </div>
                        <div class="form-group">
                            <label for="serieDescription">描述</label>
                            <textarea type="file" name="description" v-model="newSerie.description" id="serieDescription" class="form-control" rows="6"></textarea>
                        </div>
                        <!-- Catego field -->
                        <div class="form-group">
                            <div class="select2-wrapper">
                                <select id="categories"
                                    multiple
                                    name="categories[]">
                                    <option v-for="c in categories" v-bind:value="c.id">{{ c.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </div>
    </form> <!-- form -->
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            seriesColumns: [
                'ID',
                '图片',
                '标题',
                '视频数',
                '分类',
                '创建时间'
            ],
            newSerie: {
                id: '',
                title: '',
                description: '',
                image: '',
                created_at: '',
                updated_at: '',
                videos: [],
                categories: []
            },
            series: [],
            categories: [],

            showDescription: [],
            // message
            success: false,
            message: '',
            hasError: false,
            error: '',
            errors: [],
            // edit series
            editing: false,
            editImageSrc: '',
            // delete series
            deleteId: '',

            newSeriesCategories: [],

            select2: null
        }
    },

    props: ['roles'],

    computed: {
        isBoss() {
            let names = this.roles.map(role => role.name);

            return names.indexOf('boss') != -1;
        },
        errorArray() {
            let errors = [];
            // maybe a function.
            if (this.errors.title) {
                errors.push(this.errors.title[0]);
            }
            if (this.errors.image) {
                errors.push(this.errors.image[0]);
            }
            if (this.errors.description) {
                errors.push(this.errors.description[0]);
            }
            if (this.errors.categories) {
                errors.push(this.errors.categories[0]);
            }

            return errors;
        }
    },
    ready() {
        this.getAllSeriesInfo();

        jQuery('#categories')
            .select2({
                placeholder: '选择分类'
            });

        $('.select2').width('100%');
    },

    methods: {
        getAllSeriesInfo() {
            // es6 promise... how to?
            this.$http.get('/admin/series')
                .then(function(response) {
                    this.series = response.data.series;
                    this.categories = response.data.categories;
                });
        },

        toggleDescription(id) {
            let index = this.showDescription.indexOf(id);

            if (index > -1) {
                this.showDescription.$remove(id);
            } else {
                this.showDescription.push(id);
            }
        },

        findIndexById(id) {
            let ids = this.series.map(s => s.id);

            return ids.indexOf(id);
        },

        saveSerie(e) {
            let self = this;
            e.preventDefault();

            let request = new XMLHttpRequest();
            let formdata = new FormData(document.getElementById('serieForm'));
            if (! self.editing) {
                request.open('post', '/admin/series');
            } else {
                request.open('post', '/admin/series/update/' + self.newSerie.id);
            }
            request.setRequestHeader("X-CSRF-Token", document.querySelector('#token').getAttribute('value'));
            request.send(formdata);

            request.onreadystatechange = function() {
                if (this.readyState == 4) { // 对象读取服务器响应结束
                    if (request.status == 400) {
                        self.hasError = true;

                        self.errors = JSON.parse(request.responseText).errors;

                        setTimeout(function() {
                            self.hasError = false;
                        }, 2800);
                    } else if (request.status == 200) {
                        jQuery('#createSeriesModal').modal('hide');

                        self.resetSeriesForm();

                        self.showMessage(JSON.parse(request.responseText).message);

                        let serie = JSON.parse(request.responseText).data;

                        if (self.editing) {
                            self.updateSeries(serie);
                        } else {
                            self.pushSeries(serie);
                        }
                    }
                }
            }
        },

        addSeries() {
            this.editing = false;
            this.resetSeriesForm();

            jQuery('#createSeriesModal').modal('show');
        },

        editSeries(serie) {
            this.editing = true;
            this.setSeriesForm(serie.id, serie.title, serie.description,
                serie.image, serie.created_at, serie.updated_at, serie.videos);
            jQuery('#categories').val(this.getSerieCateIds(serie.categories)).change();

            jQuery('#createSeriesModal').modal('show');
        },

        deleteSeriesForm(id) {
            jQuery('#password').val('');
            this.deleteId = id;

            jQuery('#deleteSeriesModal').modal('show');
        },

        deleteSeries() {
            var self = this;
            let password = jQuery('#password').val();

            if (password.length == 0) {
                return;
            }

            self.$http.delete('/admin/series/' + self.deleteId, {password})
                .then(function(response) {
                    self.showMessage(response.data.message);
                    self.removeSeriesById(self.deleteId);

                    jQuery('#deleteSeriesModal').modal('hide');
                })
                .error(function(response) {
                    self.hasError = true;
                    self.error = response.error;

                    setTimeout(function() {
                        self.hasError = false;

                        jQuery('#deleteSeriesModal').modal('hide');
                    }, 2800);
                });
        },

        removeSeriesById(id) {
            let index = this.findIndexById(id);

            this.series.splice(index, 1);
        },

        setSeriesForm(id, title, description, image, created_at, updated_at, videos) {
            this.newSerie = {id, title, description, image, created_at, updated_at, videos};
        },

        resetSeriesForm() {
            this.setSeriesForm('', '', '', '', '', '', '', []);
            jQuery('#serieImage').val('');
            jQuery('#categories').select2("val", "");
        },

        pushSeries(serie) {
            this.series.push(serie);
        },

        updateSeries(serie) {
            let index = this.findIndexById(serie.id);

            this.series.$set(index, serie);
        },

        getSerieCateIds(categories) {
            return categories.map(c => c.id);
        },

        showMessage(message) {
            this.success = true;
            this.message = message;

            setTimeout(function() {
                this.success = false;
            }.bind(this), 2800);
        }
    }
}
</script>

<style>
.delete {
    color: #ee3939;
}
.delete:hover {
    color: #ac2925;
}
</style>

<style>
.select2-wrapper {
    width: 100% ! important;
}
</style>
