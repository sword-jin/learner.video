<template>
<div class="row" style="margin-bottom:15px;">
    <div class="col-xs-12">
        <button class="btn btn-success btn-lg" @click="addLink()">
            <span class="fa fa-link"></span> 添加链接
        </button>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success" v-show="success">
            {{ message }}
        </div>
        <div class="alert alert-danger" v-show="hasError">
            {{ error }}
        </div>
        <div class="panel">
            <header class="panel-heading">
                本期链接
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
                        <tr v-for="link in links">
                            <td>{{ getNewsTitle(link.newsletter_id) }}</td>
                            <td>{{ link.title }}</td>
                            <td>
                                <a href="{{ link.link }}" target="_blank">
                                    {{ link.link }}
                                </a>
                            </td>
                            <td>{{ link.type | type }}</td>
                            <td>{{ link.note }}</td>
                            <td>
                                <a @click.stop="editLink(link)">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td v-if="isBoss">
                                <a @click.stop="deleteLink(link)" class="delete">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-foot">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <p class="pagination__text">共 {{ total_page }} 页， 当前 {{ current_page }} 页</p>
                        <li>
                            <button class="btn"
                                @click.stop="paginate('first')"
                                :disabled="prev_page_url == null">首页</button>
                        </li>
                        <li>
                            <button class="btn"
                                @click.stop="paginate('prev')"
                                :disabled="prev_page_url == null">«</button>
                        </li>
                        <li>
                            <button class="btn"
                                @click.stop="paginate('next')"
                                :disabled="next_page_url == null">»</button>
                        </li>
                        <li>
                            <button class="btn"
                                @click.stop="paginate('last')"
                                :disabled="next_page_url == null">尾页</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<form @submit.prevent="saveLink" id="saveLink">
    <div class="modal fade" id="saveLinkModal">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">链接管理</h4>

                    <div class="alert alert-danger" v-if="hasError">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input type="text"
                            class="form-control"
                            id="title"
                            placeholder="GitHub Pages now faster and simpler with Jekyll 3.0"
                            v-model="link.title">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="link">链接</label>
                                <input type="text"
                                    class="form-control"
                                    id="link"
                                    placeholder="https://github.com/blog/2100-github-pages-now-faster-and-simpler-with-jekyll-3-0"
                                    v-model="link.link">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="type">类型</label>
                                <select id="type" v-model="link.type" class="form-control">
                                    <option value="article" selected>文章</option>
                                    <option value="tutorial">教程</option>
                                    <option value="video">视频</option>
                                    <option value="project">项目</option>
                                    <option value="other">其他</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="domain">主页</label>
                                <input type="text"
                                    v-model="link.domain"
                                    id="domain"
                                    placeholder="https://github.com/"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="note">备注</label>
                                <input type="text"
                                    v-model="link.note"
                                    id="note"
                                    placeholder="jekyll3.0发布"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>选择对应的newsletter</label>
                        <select class="form-control" v-model="link.newsletter_id">
                            <option v-for="newsletter in notPublishedNewsletters" v-bind:value="newsletter.id">
                                {{ newsletter.title }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="添加" class="btn btn-primary">
                    </div>
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
                '订阅',
                '标题',
                '链接',
                '类型',
                '备注'
            ],

            links: [],

            link: {
                id: null,
                newsletter_id: null,
                title: '',
                link: '',
                type: '',
                domain: '',
                note: ''
            },

            newsletters: [],

            // paginator
            total: 0,
            current_page: 1,
            last_page: 1,
            total_page: 0,
            first_page_url: '/admin/links',
            prev_page_url: '',
            next_page_url: '',
            last_page_url: '',

            // message
            success: false,
            message: '',
            hasError: false,
            errors: [],
            error: '',

            editing: false
        }
    },

    props: ['roles'],

    created() {
        this.getNewsletters();

        this.getLinks(this.first_page_url);
    },

    computed: {
        notPublishedNewsletters() {
            return this.newsletters.filter(n => n.is_published == false);
        },
        isBoss() {
            let names = this.roles.map(role => role.name);

            return names.indexOf('boss') != -1;
        }
    },

    filters: {
        type(val) {
            switch (val) {
                case 'project':
                    return '项目';
                    break;
                case 'video':
                    return '视频';
                    break;
                case 'article':
                    return '文章';
                    break;
                case 'tutorial':
                    return '教程';
                    break;
                default:
                    return '其他';
            }
        }
    },

    methods: {
        getNewsletters() {
            this.$http.get('/admin/newsletters')
                .then(response => {
                    this.newsletters = response.data.newsletters;
                });
        },

        getLinks(url) {
            this.$http.get(url)
                .then(response => {
                    let data = response.data.links;

                    this.links = data.data;
                    this.total = data.total;
                    this.last_page = data.last_page;
                    this.current_page = data.current_page;
                    this.total_page = this.getTotalPage(data.total, data.per_page);
                    this.prev_page_url = data.prev_page_url;
                    this.next_page_url = data.next_page_url;
                    this.last_page_url = this.first_page_url + '?page=' + this.total_page;
                });
        },

        saveLink() {
            if (! this.editing) {
                this.$http.post('/admin/links', this.getFormData())
                    .then(response => {
                        this.showMessage(response.data.message);

                        this.links.unshift(response.data.link);

                        jQuery('#saveLinkModal').modal('hide');
                    })
                    .catch(response => {
                        this.showErrors(response.data.errors);
                    });
            } else {
                this.$http.put('/admin/links/' + this.link.id, this.getFormData())
                    .then(response => {
                        this.showMessage(response.data.message);

                        this.updateLinkList(response.data.link);

                        jQuery('#saveLinkModal').modal('hide');
                    })
                    .catch(response => {
                        this.showErrors(response.data.errors);
                    });
            }
        },

        editLink(link) {
            this.editing = true;
            jQuery('#saveLinkModal').modal('show');

            this.setLinkForm(link.id, link.newsletter_id, link.title, link.link, link.type, link.domain, link.note);
        },

        deleteLink(link) {
            if (! window.confirm('确定要删除吗')) {
                return;
            }

            this.$http.delete('/admin/links/' + link.id)
                .then(response => {
                    this.showMessage(response.data.message);

                    this.links.$remove(link);
                });
        },

        getFormData() {
            return {
                newsletter_id: this.link.newsletter_id,
                type: this.link.type,
                title: this.link.title,
                link: this.link.link,
                note: this.link.note,
                domain: this.link.domain
            }
        },

        addLink() {
            if (this.allNewsletterPublished()) {
                this.showError('请先添加一期, 点击【订阅栏】可以找到');

                return;
            }

            this.editing = false;
            this.resetLinkForm();

            jQuery('#saveLinkModal').modal('show');
        },

        resetLinkForm() {
            this.setLinkForm(null, null, '', '', 'article', '', '');
        },

        setLinkForm(id, newsletter_id, title, link, type, domain, note) {
            this.link = {id, newsletter_id, title, link, type, domain, note};
        },

        getTotalPage(total, per_page) {
            return Math.ceil(total / per_page);
        },

        paginate(direction) {
            switch (direction) {
                case 'prev':
                    this.getLinks(this.prev_page_url);
                    this.current_page --;
                    break;
                case 'next':
                    this.getLinks(this.next_page_url);
                    this.current_page ++;
                    break;
                case 'first':
                    this.getLinks(this.first_page_url);
                    this.current_page = 1;
                    break;
                case 'last':
                    this.getLinks(this.last_page_url);
                    this.current_page = this.last_page;
                    break;
            }
        },

        getNewsTitle(id) {
            var index = this.findNewsIndexById(id);

            return this.newsletters[index].title;
        },

        allNewsletterPublished() {
            let is_published_array = this.newsletters.map(n => n.is_published);

            return is_published_array.indexOf(false) === -1;
        },

        updateLinkList(link) {
            var index = this.findLinksIndexById(link.id);

            this.links.$set(index, link);
        },

        findLinksIndexById(id) {
            var ids = this.links.map(n => n.id);

            return ids.indexOf(parseInt(id));
        },

        findNewsIndexById(id) {
            var ids = this.newsletters.map(n => n.id);

            return ids.indexOf(parseInt(id));
        },

        showMessage(message) {
            this.success = true;

            this.message = message;

            setTimeout(function() {
                this.success = false;
            }.bind(this), 2800);
        },

        showError(error) {
            this.hasError = true;

            this.error = error;

            setTimeout(function() {
                this.hasError = false;
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
