<template>
<div class="row">
    <div class="col-sm-9">

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
                        </tr>
                    </thead>
                    <tbody v-for="serie in series">
                        <tr>
                            <td>{{ serie.id }}</td>
                            <td width="15%"><img :src="serie.image" width="30px"></td>
                            <td>{{ serie.title }}</td>
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
                        </tr>
                        <tr v-show="showDescription.indexOf(serie.id) > -1">
                            <td colspan="6"><b>描述：</b>{{ serie.description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- panel-body -->

            <div class="table-foot">

            </div> <!-- panel-foot -->
        </div>
    </div> <!-- col-12 -->

    <div class="col-sm-3">
        <div class="panel">
            <header class="panel-heading">
                操作
            </header> <!-- panel-heading -->

            <div class="panel-body">
                <div class="form-group" style="text-align: center">
                    <button class="btn btn-success btn-lg"
                        @click="addSeries()">
                        <i class="fa fa-film"></i> 添加系列
                    </button>
                </div>
                <div class="form-group" style="text-align: center">
                    <button class="btn btn-success btn-lg">
                        <span class="fa fa-youtube-play"></span> 添加视频
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- col-3 -->

    <form @submit="saveSerie" id="serieForm" enctype="multipart/form-data">

        <input type="hidden" name="id" v-if="editing" v-model="serie.id">

        <div class="modal fade" id="createModal">
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
                            <input type="text" name="title" v-model="serie.title" id="serieTitle" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="serieImage">图片</label>
                            <input type="file" name="image" id="serieImage" class="form-control">
                        </div>
                        <div class="form-group" v-if="editing">
                            <img v-attr="src: editImageSrc" id="editImageSrc">
                        </div>
                        <div class="form-group">
                            <label for="serieDescription">描述</label>
                            <textarea type="file" name="description" v-model="serie.description" id="serieDescription" class="form-control" rows="6"></textarea>
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
                '创建时间'
            ],
            serie: {
                'id': 0,
                'title': '',
                'description': ''
            },
            series: [],
            showDescription: [],
            success: false,
            message: '',
            hasError: false,
            errors: [],
            editing: false,
            editImageSrc: ''
        }
    },
    computed: {
        errorArray() {
            let errors = [];

            if (this.errors.title) {
                errors.push(this.errors.title[0]);
            }
            if (this.errors.image) {
                errors.push(this.errors.image[0]);
            }
            if (this.errors.description) {
                errors.push(this.errors.description[0]);
            }

            return errors;
        }
    },
    created() {
        this.getSeries();
    },
    methods: {
        getSeries() {
            this.$http.get('/admin/series')
            .then(function(response) {
                console.log(response);
                this.series = response.data;
            });
        },

        toggleDescription(id) {
            var index = this.showDescription.indexOf(id);

            if (index > -1) {
                this.showDescription.$remove(id);
            } else {
                this.showDescription.push(id);
            }
        },

        saveSerie(e) {
            var self = this;
            e.preventDefault();

            var request = new XMLHttpRequest();
            var formdata = new FormData(document.getElementById('serieForm'));
            request.open('post', '/admin/series');
            request.setRequestHeader("X-CSRF-Token", document.querySelector('#token').getAttribute('value'));
            request.send(formdata);

            request.onreadystatechange = function() {
                if (this.readyState == 4) { // 对象读取服务器响应结束
                    if (request.status == 413) {
                        self.hasError = true;

                        self.errors = JSON.parse(request.responseText).errors;

                        setTimeout(function() {
                            self.hasError = false;
                        }, 2800);
                    } else if (request.status == 200) {
                        jQuery('#createModal').modal('hide');

                        self.resetSeriesForm();

                        self.showMessage(JSON.parse(request.responseText).message);

                        var serie = JSON.parse(request.responseText).data;

                        self.series.push({
                            id: serie['id'],
                            title: serie['title'],
                            description: serie['description'],
                            image: serie['image']
                        });
                    }
                }
            }
        },

        addSeries() {
            this.editing = false;

            jQuery('#createModal').modal('show');
        },

        editSeries(serie) {
            this.editing = true;
            this.serie.id = serie.id;
            this.serie.title = serie.title;
            this.serie.description = serie.description;
            this.editImageSrc = serie.image;
            console.log(serie.image);
            // jQuery('#editImageSrc').attr('src', serie.image);
            // jQuery('#serieImage').val(serie.image);

            jQuery('#createModal').modal('show');
        },

        resetSeriesForm() {
            this.serie.id = 0;
            this.serie.title = '';
            this.serie.description = '';
            $('#serieImage').val('');
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
