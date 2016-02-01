<template>
<div class="row" style="margin-bottom:15px;">
    <div class="col-xs-12">
        <div class="alert alert-success" v-show="success">
            {{ message }}
        </div>
        <div class="alert alert-danger" v-show="hasError">
            {{ error }}
        </div>
        <a class="btn btn-success btn-lg" v-link="{name: 'blog.create'}">
            <span class="fa fa-edit"></span> 发表博客
        </a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
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
                        <tr v-for="blog in blogs">
                            <td>{{ blog.id }}</td>
                            <td>
                                <span class="label label-primary">{{ blog.category.name }}</span>
                            </td>
                            <td>{{ blog.title }}</td>
                            <td class="toggle_active">
                                <input type="checkbox"
                                    id="is_published{{$index}}"
                                    @click="toggleBlogPublished(blog.id)"
                                    :disabled="published_toggling"
                                    checked="{{ blog.is_published }}"/>
                                <label for="is_published{{$index}}"></label>
                            </td>
                            <td class="toggle_active">
                                <input type="checkbox"
                                    id="is_top{{$index}}"
                                    @click="toggleBlogTop(blog.id)"
                                    :disabled="top_toggling"
                                    checked="{{ blog.is_top }}"/>
                                <label for="is_top{{$index}}"></label>
                            </td>
                            <td>{{ blog.created_at | date }}</td>
                            <td>
                                <a @click.stop="editBlog(blog.id)">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td v-if="isBoss">
                                <a @click.stop="deleteBlog(blog.id)" class="delete">
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

</template>

<script>
module.exports = {
    data() {
        return {
            columns: [
                'ID',
                '分类',
                '标题',
                '发布',
                '顶置',
                '创建时间'
            ],
            blogs: [],

            published_toggling: false,
            top_toggling: false,

            success: false,
            message: '',
            hasError: false,
            error: ''
        }
    },

    props: ['roles'],

    computed: {
        isBoss() {
            let names = this.roles.map(role => role.name);

            return names.indexOf('boss') != -1;
        }
    },

    ready() {
        let self = this;

        self.$http.get('/admin/blogs')
            .then(response => {
                self.blogs = response.data.blogs;
            });
    },

    methods: {
        editBlog(id) {
            this.$router.go({ 'name': 'blog.edit', params: { id: id } });
        },

        deleteBlog(id) {
            if (! window.confirm('确定要删除嘛')) {
                return;
            }

            let self = this;

            this.$http.delete('admin/blogs/' + id)
                .then(response => {
                    if (response.status == 200) {
                        this.showMessage(response.data.message);

                        this.removeBlog(id);
                    } else if (response.status == 202) {
                        this.showError(response.data.error);
                    }
                });
        },

        toggleBlogPublished(id) {
            let self = this;
            self.published_toggling = true;

            self.$http.put('/admin/blogs/togglePublished/' + id)
                .then(response => {
                    self.showMessage(response.data.message);

                    self.published_toggling = false;
                });
        },

        toggleBlogTop(id) {
            let self = this;
            self.top_toggling = true;

            self.$http.put('/admin/blogs/toggleTop/' + id)
                .then(response => {
                    self.showMessage(response.data.message);

                    self.top_toggling = false;
                });
        },

        removeBlog(id) {
            var index = this.findIndexById(id);

            this.blogs.splice(index, 1);
        },

        findIndexById(id) {
            let ids = this.blogs.map(v => v.id);

            return ids.indexOf(id);
        },

        showMessage(message) {
            this.success = true;

            this.message = message;

            setTimeout(function() {
                this.success = false;
            }.bind(this), 2800);
        },

        showError(error) {
            this.error = true;

            this.error = error;

            setTimeout(function() {
                this.error = false;
            }.bind(this), 2800);
        }
    }
}
</script>
