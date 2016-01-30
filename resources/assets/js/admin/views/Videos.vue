<template>
<div class="row" style="margin-bottom:15px;">
    <div class="col-xs-12">
        <button class="btn btn-success btn-lg" @click="addVideo()">
            <span class="fa fa-youtube-play"></span> 添加视频
        </button>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success" v-show="success">
            {{ message }}
        </div>

        <div class="panel">
            <header class="panel-heading">
                视频列表
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
                        <tr v-for="video in videos">
                            <td>{{ video.id }}</td>
                            <td>{{ video.title }}</td>
                            <td><span class="label label-success" v-text="getTitleById(video.series_id)"></span></td>
                            <td>
                                <i v-if="video.resource_type == 'vimeo'" class="fa fa-vimeo"></i>
                                <i v-if="video.resource_type == 'youtube'" class="fa fa-youtube"></i>
                                <span v-if="video.resource_type == 'youku'">优酷</span>
                            </td>
                            <td>{{ video.created_at | date }}</td>
                            <td>{{ video.published_at | date }}</td>
                            <td>
                                <a @click.stop="editVideo(video)">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td v-if="isBoss">
                                <a @click.stop="deleteVideo(video.id)" class="delete">
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

<form @submit.prevent="saveVideo" id="saveVideo">
    <div class="modal fade" id="saveVideoModal">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">视频管理</h4>
                </div>

                <div class="alert alert-danger" v-if="hasError">
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

                <div class="modal-body">
                    <!-- Title field -->
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input type="text"
                            class="form-control"
                            id="title"
                            v-model="newVideo.title"
                        >
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="series">所属系列</label>
                                <select id="series"
                                    class="form-control"
                                    v-model="newVideo.series_id"
                                >
                                    <option v-for="serie in series" v-bind:value="serie.id">{{ serie.title }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="resource_type">视频来源</label>
                                <select id="resource_type"
                                    class="form-control"
                                    v-model="newVideo.resource_type"
                                >
                                    <option value="vimeo" selected>Vimeo</option>
                                    <option value="youtube">Youtube</option>
                                    <option value="youku">Youku</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="resource_id">视频ID</label>
                                <input id="resource_id"
                                    class="form-control"
                                    v-model="newVideo.resource_id"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="published_at">发布日期</label>
                        <input type="date"
                            class="form-control"
                            id="published_at"
                            v-model="newVideo.published_at | date"
                        >
                    </div>
                    <div class="form-group">
                        <textarea rows="8"
                            placeholder="请用 Markdown 格式填写视频下方的描述"
                            class="form-control"
                            v-model="newVideo.description">
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="submit" class="btn btn-primary" value="确认"></input>
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
                '标题',
                '系列',
                '来源',
                '上传时间',
                '发布时间'
            ],
            newVideo: {
                id: '',
                series_id: '',
                title: '',
                description: '',
                resource_type: '',
                resource_id: '',
                published_at: '',
                created_at: '',
                updated_at: '',
                series: ''
            },
            videos: [],
            series: [],
            // message
            success: false,
            message: '',
            hasError: false,
            errors: [],

            editing: false
        }
    },

    props: ['roles'],

    created() {
        this.getVideos();
    },

    computed: {
        isBoss() {
            let names = this.roles.map(role => role.name);

            return names.indexOf('boss') != -1;
        }
    },

    methods: {
        getVideos() {
            var self = this;

            self.$http.get('/admin/videos')
                .then(response => {
                    self.series = response.data.series;
                    self.videos = response.data.videos;
                });
        },

        getFormData() {
            return {
                series_id: this.newVideo.series_id,
                title: this.newVideo.title,
                description: this.newVideo.description,
                resource_type: this.newVideo.resource_type,
                resource_id: this.newVideo.resource_id,
                published_at: this.newVideo.published_at
            }
        },

        saveVideo() {
            if (this.editing) {
                this.$http.put('/admin/videos/' + this.newVideo.id, this.getFormData())
                    .then(response => {
                        jQuery('#saveVideoModal').modal('hide');

                        this.updateVideoList(response.data.video);

                        this.showMessage(response.data.message);
                    })
                    .catch(response => {
                        this.showErrors(response.data.errors);
                    });
            } else {
                this.$http.post('/admin/videos', this.getFormData())
                    .then(response => {
                        jQuery('#saveVideoModal').modal('hide');

                        this.videos.unshift(response.data.video);

                        this.showMessage(response.data.message);
                    })
                    .catch(response => {
                        this.showErrors(response.data.errors);
                    });
            }
        },

        addVideo() {
            this.editing = false;
            this.resetVideoForm();

            jQuery('#saveVideoModal').modal('show');
        },

        editVideo(video) {
            this.editing = true;

            this.setVideoForm(video.id, video.series_id, video.title, video.description, video.resource_type,
                video.resource_id, video.published_at, video.created_at, video.updated_at);

            jQuery('#saveVideoModal').modal('show');
        },

        deleteVideo(id) {
            var self = this;

            self.$http.delete('/admin/videos/' + id)
                .then(response => {
                    if (response.status == 202) {
                        self.hasError = true;

                        self.errors.push(response.data.error);

                        setTimeout(() => {
                            self.hasError = false;
                        }, 2800);
                    } else if (response.status == 200) {
                        self.showMessage(response.data.message);

                        this.removeVideo(id);
                    }
                });
        },

        updateVideoList(video) {
            let index = this.findIndexById(video.id);

            this.videos.$set(index, video);
        },

        findIndexById(id) {
            let ids = this.videos.map(v => v.id);

            return ids.indexOf(id);
        },

        getTitleById(id) {
            var ids = this.series.map(s => s.id);
            var index = ids.indexOf(parseInt(id));

            return this.series[index].title;
        },

        removeVideo(id) {
            var index = this.findIndexById(id);

            this.videos.splice(index, 1);
        },

        resetVideoForm() {
            this.setVideoForm('', '', '', '', 'vimeo', '', '', '', '', '');
        },

        setVideoForm(id, series_id, title, description, resource_type,
            resource_id, published_at, created_at, updated_at) {
            this.newVideo = {id, series_id, title, description, resource_type,
            resource_id, published_at, created_at, updated_at};
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

            this.getErrors(errors);

            setTimeout(function() {
                this.hasError = false;
            }.bind(this), 2800);
        },

        getErrors(errors) {
            for (let key in errors) {
                this.errors.push(errors[key][0]);
            }
        }
    }
}
</script>
