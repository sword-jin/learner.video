<template>
<div class="row" style="margin-bottom:5px;">
    <div class="col-sm-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-red"><i class="fa fa-users"></i></span>
            <div class="sm-st-info">
                <span>{{ user_count }}</span>
                会员
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-newspaper-o"></i></span>
            <div class="sm-st-info">
                <span>{{ subscriber_count }}</span>
                订阅
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-green"><i class="fa fa-film"></i></span>
            <div class="sm-st-info">
                <span>{{ series_count }}</span>
                系列
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-blue"><i class="fa fa-youtube-play"></i></span>
            <div class="sm-st-info">
                <span>{{ video_count }}</span>
                视频
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <section class="panel">
            <header class="panel-heading">
                角色浏览
            </header>
            <div class="panel-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>显示名称</th>
                            <th>描述</th>
                            <th>人数</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="role in all_roles">
                            <td>{{ role.id }}</td>
                            <td>{{ role.name }}</td>
                            <td>{{ role.display_name }}</td>
                            <td>{{ role.description }}</td>
                            <td>{{ role.users.length }}</td>
                        </tr>
                    </tbody>
              </table>
            </div>
        </section>
    </div><!--end col-9 -->
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            user_count: 0,
            video_count: 0,
            subscriber_count: 0,
            series_count: 0,
            all_roles: [],
            all_perms: []
        }
    },

    props: ['roles'],

    created() {
        this.getInformation();
    },

    methods: {
        getInformation() {
            this.$http.get('/admin/dashboard/information')
                .then(function(response) {
                    let data = response.data;

                    this.user_count = data.info.user_count;
                    this.video_count = data.info.video_count;
                    this.subscriber_count = data.info.subscriber_count;
                    this.series_count = data.info.series_count;
                    this.all_roles = data.info.all_roles;
                    this.all_perms = data.info.all_perms;
                });
        }
    }
}
</script>
