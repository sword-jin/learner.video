<template>
<div class="row">
    <div class="col-sm-6">
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
                            <th width="1%" v-if="isBoss"><i class="fa fa-remove"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="email in emails">
                            <td>{{ email }}</td>
                            <td>
                                <a @click.stop="deleteSubscribers(email)" class="delete">
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
                'Email'
            ],
            emails: [],

            success: false,
            message: ''
        }
    },

    props: ['roles'],

    ready() {
        this.getAllSubscribers();
    },

    computed: {
        isBoss() {
            let names = this.roles.map(role => role.name);

            return names.indexOf('boss') != -1;
        }
    },

    methods: {
        getAllSubscribers() {
            let self = this;

            self.$http.get('/admin/subscribers')
                .then(response => {
                    self.emails = response.data.emails;
                });
        },

        deleteSubscribers(email) {
            if (! window.confirm('确定删除吗?')) {
                return;
            }

            let self = this;

            self.$http.delete('/admin/subscribers/' + email)
                .then(response => {
                    self.showMessage(response.data.message);

                    self.emails.$remove(email);
                });
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
