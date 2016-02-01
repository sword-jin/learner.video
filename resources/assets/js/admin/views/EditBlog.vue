<template>
<div class="row" style="margin-bottom:30px;">
    <div class="col-xs-12">
        <div class="alert alert-success" v-show="success">
            {{ message }}
        </div>
        <div class="btn-group">
            <a class="btn btn-primary btn-lg" v-link="{name: 'blogs'}">
                <span class="fa fa-book"></span> 返回博客列表
            </a>
            <a href="/blogs" class="btn btn-info btn-lg">
                <span class="fa fa-home"></span> 返回前台博客
            </a>
        </div>
    </div>
</div>

<div>
    <form @submit.prevent="updateBlog()">
        <div class="form-group">
            <label>标题</label>
            <input v-model="blog.title" class="form-control" placeholder="128个字符以内.">
        </div>
        <div class="form-group">
            <label>正文</label>
            <textarea v-model="blog.body" class="form-control" rows="18" placeholder="Markdown!!!建议在其他环境下书写"></textarea>
        </div>
        <div class="form-group">
            <label>选择分类</label>
            <select v-model="blog.category_id" class="form-control">
                <option v-for="c in categories" v-bind:value="c.id">{{ c.name }}</option>
            </select>
        </div>
        <div class="form-group">
            <label>创建日期(有需要请手动修改日期)</label>
            <input type="date" class="form-control" v-model="blog.created_at | date">
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="blog.is_published"> 是否马上发表
                </label>
            </div>
            <button type="submit" class="btn btn-primary" :disabled="canSubmit">
                {{　blog.is_published ? '发表' : '保存' }}
            </button>
        </div>
    </form>
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            id: null,
            blog: {
                category_id: null,
                title: '',
                body: '',
                is_published: true,
                created_at: ''
            },
            categories: [],
            success: false,
            message: ''
        }
    },

    created() {
        this.id = this.$route.params.id;

        this.getCategories();
    },

    computed: {
        canSubmit() {
            if (this.blog.category_id == null ||
                this.blog.title.length == 0 ||
                this.blog.title.length > 128 ||
                this.blog.body === '' ||
                this.blog.created_at === '') {
                return true;
            }

            return false;
        }
    },

    methods: {
        getCategories() {
            this.$http.get('/admin/categories')
                .then(response => {
                    this.categories = response.data;
                });
            this.$http.get('/admin/blogs/' + this.id)
                .then(response => {
                    this.blog = response.data.blog;
                });
        },

        updateBlog() {
            let self = this;

            self.$http.put('/admin/blogs/' + self.id, self.getFormData())
                .then(response => {
                    self.success = true;
                    self.message = response.data.message;

                    setTimeout(() => {
                        self.$router.go({ name: 'blogs' })
                    }, 1200);
                });
        },

        getFormData() {
            return {
                category_id: this.blog.category_id,
                title: this.blog.title,
                body: this.blog.body,
                is_published: this.blog.is_published,
                created_at: this.blog.created_at
            }
        }
    }
};
</script>
