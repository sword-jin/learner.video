<template>
<div class="row">
    <div class="alert alert-success" v-show="success">
        {{ message }}
    </div>
    <div class="alert alert-danger" v-show="hasError">
        {{ error }}
    </div>
    <div class="col-sm-4">
        <div class="panel">
            <header class="panel-heading">
                订阅邮箱
            </header> <!-- panel-heading -->

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th v-for="column in subscriberColumns">{{ column }}</th>
                            <th width="1%" v-if="isBoss"><i class="fa fa-remove"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="subscriber in subscribers">
                            <td>{{ subscriber.email }}</td>
                            <td v-if="isBoss">
                                <a @click.stop="deleteSubscribers(subscriber)" class="delete">
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

    <div class="col-sm-8">
        <div class="panel">
            <header class="panel-heading">
                Newsletter 列表
            </header> <!-- panel-heading -->

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th v-for="column in newsletterColumns">{{ column }}</th>
                            <th><i class="fa fa-send"></i></th>
                            <th v-if="isBoss" width="1%"><i class="fa fa-remove"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="newsletter in newsletters">
                            <td>{{ newsletter.id }}</td>
                            <td>{{ newsletter.title }}</td>
                            <td v-if="newsletter.is_published">
                                <span class="label label-success">已发布</span>
                            </td>
                            <td v-else>
                                <span class="label label-danger">未发布</span>
                            </td>
                            <td v-if="newsletter.is_published">
                                <a href="/newsletter/{{ newsletter.id }}">查看</a>
                            </td>
                            <td v-else>
                                <a @click.stop="publishNewsletter(newsletter)" class="btn btn-primary btn-xs" :disabled="publishing">发布</a>
                            </td>
                            <td v-if="isBoss">
                                <a @click.stop="deleteNewsletter(newsletter)" class="delete">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <tfoot>
                    <form @submit.prevent="addNewsletter">
                        <div class="form-group">
                            <input type="text"
                                v-model="title"
                                placeholder="learner.video newsletter 第一期"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" :disabled="! title">添加</button>
                        </div>
                    </form>
                </tfoot>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            subscriberColumns: [
                'Email'
            ],
            newsletterColumns: [
                'ID',
                '标题',
                '状态'
            ],
            subscribers: [],

            success: false,
            message: '',
            hasError: false,
            error: '',

            total: 0,
            current_page: 1,
            last_page: 1,
            total_page: 0,
            first_page_url: '/admin/subscribers',
            prev_page_url: '',
            next_page_url: '',
            last_page_url: '',

            // newsletters.
            newsletters: [],

            title: '', // init newsletter title

            publishing: false
        }
    },

    props: ['roles'],

    ready() {
        this.getAllSubscribers(this.first_page_url);

        this.getAllNewsletters();
    },

    computed: {
        isBoss() {
            let names = this.roles.map(role => role.name);

            return names.indexOf('boss') != -1;
        }
    },

    methods: {
        addNewsletter() {
            var self = this;

            self.$http.post('/admin/newsletters', {title: self.title})
                .then(response => {
                    self.showMessage(response.data.message);

                    self.newsletters.push(response.data.newsletter);

                    self.title = '';
                });
        },

        getAllSubscribers(url) {
            this.$http.get(url)
                .then(response => {
                    let data = response.data.subscribers;

                    this.subscribers = data.data;
                    this.total = data.total;
                    this.last_page = data.last_page;
                    this.current_page = data.current_page;
                    this.total_page = this.getTotalPage(data.total, data.per_page);
                    this.prev_page_url = data.prev_page_url;
                    this.next_page_url = data.next_page_url;
                    this.last_page_url = this.first_page_url + '?page=' + this.total_page;
                });
        },

        getAllNewsletters() {
            this.$http.get('/admin/newsletters')
                .then(response => {
                    this.newsletters = response.data.newsletters;
                });
        },

        getTotalPage(total, per_page) {
            return Math.ceil(total / per_page);
        },

        deleteSubscribers(subscriber) {
            if (! window.confirm('确定删除吗?')) {
                return;
            }

            this.$http.delete('/admin/subscribers/' + subscriber.email)
                .then(response => {
                    this.showMessage(response.data.message);

                    this.subscribers.$remove(subscriber);
                });
        },

        deleteNewsletter(newsletter) {
            if (! window.confirm('确定要删除吗')) {
                return;
            }

            this.$http.delete('/admin/newsletters/' + newsletter.id)
                .then(response => {
                    this.showMessage(response.data.message);

                    this.newsletters.$remove(newsletter);
                });
        },

        paginate(direction) {
            switch (direction) {
                case 'prev':
                    this.getAllSubscribers(this.prev_page_url);
                    this.current_page --;
                    break;
                case 'next':
                    this.getAllSubscribers(this.next_page_url);
                    this.current_page ++;
                    break;
                case 'first':
                    this.getAllSubscribers(this.first_page_url);
                    this.current_page = 1;
                    break;
                case 'last':
                    this.getAllSubscribers(this.last_page_url);
                    this.current_page = this.last_page;
                    break;
            }
        },

        publishNewsletter(newsletter) {
            this.publishing = true;

            this.$http.post('/admin/newsletters/publish/' + newsletter.id)
                .then(response => {
                    this.showMessage(response.data.message);

                    newsletter.is_published = true;

                    this.publishing = false;
                })
                .catch(response => {
                    this.showError(response.data.error);

                    this.publishing = false;
                });
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
        }
    }
}
</script>
