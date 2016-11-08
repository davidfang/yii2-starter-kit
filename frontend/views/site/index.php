<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<link type="text/css" rel="stylesheet" href="/css/about-n.css">
<div class="site-index">

    <?php echo \common\widgets\DbCarousel::widget([
        'key'=>'index',
        'options' => [
            'class' => 'slide', // enables slide effect
        ],
    ]) ?>



    <div class="body-content">

        <div class="plus_title">
            <h1>解决方案</h1>
            <div class="hr"></div>
            <span>Products And Services</span>
        </div>
        <div class="plan all_row">
            <ul class="wrap plus_list">
                <li>
                    <a href="javascript:;">
                        <div class="weiapp"></div>
                        <span class="t">微信小程序</span>
                        <span class="desc">微信商城将全面升级支持微信小程序，更多内容尽情期待。</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="mybbs"></div>
                        <span class="t">梦云社区</span>
                        <span class="desc">全平台支持，支持PC电脑端，微信端和APP应用端，并且三端数据互通。点赞，评论，收藏，红包奖赏，关注，活动报名，一键购买等，有别人有的也有别人没有的！</span>
                    </a>
                </li>
                <li class="mr0">
                    <a href="javascript:;">
                        <div class="shop"></div>
                        <span class="t">微电商</span>
                        <span class="desc">通过快速搭建功能强大的移动商城，帮助传统零售业、商户搭上移动互联网的快车，积累粉丝，提供销量</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="hotel"></div>
                        <span class="t">智慧酒店</span>
                        <span class="desc">酒店服务移动互联网化、在线预订预约酒店和服务，查看客房情况，积累员工体系及沉淀客户数据、同时实现客户服务个性化服务等</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="wyx"></div>
                        <span class="t">微营销解决方案</span>
                        <span class="desc">制作摇红包、抽奖游戏，拼团、发放优惠券，竞猜等营销方案通过公众号吸引粉丝，朋友圈传播来提高品牌效益挖掘潜在用户</span>
                    </a>
                </li>
                <li class="mr0">
                    <a href="javascript:;">
                        <div class="dgz"></div>
                        <span class="t">多公众号运营平台</span>
                        <span class="desc">针对连锁机构，企业集团等需要同时运营多个公众号的企业而提供的一个集多公众号、多管理员、素材共享，数据共享于一体的综合运营平台</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="locale"></div>
                        <span class="t">现场互动解决方案</span>
                        <span class="desc">在企业开展市场活动、会议、年会等现场活动时，通过提供摇一摇周边，现场摇红包、现场抽奖，现场投票等实现与观众的互动，活跃现场气氛，同时为公众号增加粉丝</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="shopbbs"></div>
                        <span class="t">商城+社区系统</span>
                        <span class="desc">在微商城的基础上加入社区功能，将兴趣相投的粉丝聚在一起，有一个交流的地方，让粉丝产生内容，为自主生产内容的公众号实现持久的活跃效果</span>
                    </a>
                </li>
                <li class="mr0">
                    <a href="javascript:;">
                        <div class="media"></div>
                        <span class="t">媒体融合解决方案</span>
                        <span class="desc">“互联网+”的大环境下，践行“媒体融合”将互联网与传统媒体行业结合，在此基础上进行一系列的粉丝互动，品牌营销、分散传播，从而可以达到沉淀用户、提升品牌价值、实现商业价值的目的。</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="edu"></div>
                        <span class="t">教育与培训</span>
                        <span class="desc">通过公众号建立员工培训系统、在线知识库、试题库、培训班、讲师系统等，解决企业内部培训管理难 效率低 效果差等难题，真正实现教育培训线上、线下一体化</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="dingzhi"></div>
                        <span class="t">个性定制服务</span>
                        <span class="desc">如果您有移动互联网个性化的定制需求，欢迎联系我们</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
