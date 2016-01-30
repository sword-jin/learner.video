@extends('layouts/master')

@section('description')
这里有丰富的web学习视频，资料，另外，本站开源在 https://github.com/RryLee/learner.video
@stop

@section('title')
欢迎来到Learner
@stop

@section('style')
<style>
    @media (min-width: 768px) {
        body {
            padding-top: 84px;
        }
    }
</style>
@stop

@section('jumbotron')
    <section class="page-jumbotron newsletter">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="newsletter__letter">
                        <h1>订阅Learner.</h1>
                        <h1>丰富学习资料.</h1>
                        <ul>
                            <li>半月一期</li>
                            <li>学习视频:laravel,angular,vue..</li>
                            <li>学习资源:挑选的优质博客</li>
                        </ul>
                        <p>一起成为更优秀的人.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="newsletter__form">
                        <p>从现在开始!</p>
                        <form action="#">
                            <!-- Name field -->
                            <div class="form-group">
                                <input type="email" class="form-control newsletter__form__address" name="email" placeholder="name@domain.com">
                            </div>

                            <div class="from-group">
                                <input type="submit" class="btn btn-success" value="订阅 !">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <section class="technique">
        <div class="container">
            <div class="technique__bar">
                <h3 class="technique__bar__title">What Learn</h3>
                <p class="technique__bar__decription">这里没有太多基础，有的是实用的技巧，最新的技术，有趣的项目</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-lg-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                    <div class="card">
                        <span class="card__update label label-danger">update!</span>
                        <span class="card__video-count">10 Videos</span>
                        <div class="card__img">
                            <a href="#">
                                <img
                                        class="img-responsive"
                                        src="http://ww1.sinaimg.cn/mw690/baa3278fgw1f0al4c1df8j20iw0c8jrp.jpg" alt="">
                                <div class="card__overlay">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                        </div>
                        <div class="card__details">
                            <ul class="card__category">
                                <li class="label label--php">php</li>
                                <li class="label label--javascript">javascript</li>
                            </ul>
                            <h3 class="card__title">
                                <a href="#" class="card__title--a">JavaScript处理数据</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                    <div class="card">
                        <span class="card__update label label-danger">update!</span>
                        <span class="card__video-count">10 Videos</span>
                        <div class="card__img">
                            <a href="#">
                                <img
                                        class="img-responsive"
                                        src="http://ww1.sinaimg.cn/mw690/baa3278fgw1f0al4c1df8j20iw0c8jrp.jpg" alt="">
                                <div class="card__overlay">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                        </div>
                        <div class="card__details">
                            <ul class="card__category">
                                <li class="label label--php">php</li>
                                <li class="label label--javascript">javascript</li>
                            </ul>
                            <h3 class="card__title">
                                <a href="#" class="card__title--a">JavaScript处理数据</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                    <div class="card">
                        <span class="card__update label label-danger">update!</span>
                        <span class="card__video-count">10 Videos</span>
                        <div class="card__img">
                            <a href="#">
                                <img
                                        class="img-responsive"
                                        src="http://ww1.sinaimg.cn/mw690/baa3278fgw1f0al4c1df8j20iw0c8jrp.jpg" alt="">
                                <div class="card__overlay">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                        </div>
                        <div class="card__details">
                            <ul class="card__category">
                                <li class="label label--php">php</li>
                                <li class="label label--javascript">javascript</li>
                            </ul>
                            <h3 class="card__title">
                                <a href="#" class="card__title--a">JavaScript处理数据</a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <a href="#" class="btn btn-success btn-wiggle">浏览更多</a>
            </div>
        </div>
    </section>
@stop
