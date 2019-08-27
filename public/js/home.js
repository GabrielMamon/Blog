Vue.component('post-items', {
    props: ['posts'],
    template: `<div class="col-md-12">
        <div v-for="post in posts" class="post-card">
            <a :href="'/post/'+post.title_slugged" class="post-wrap" style="outline: none;">

            <div class="row post-content">
                <div class="col-5 my-auto">
                    <img :src="'/images/'+post.imagepath">
                </div>

                <div class="col-7">
                        <span class="post-title">{{ post.title }}</span>
                        <h6 class="post-details">
                            <a :href="/author/+post.name">{{ post.name }}</a> - {{ post.created }}
                            <a :href="/category/+post.category" class="cat-btn">{{ post.category }}</a>
                        </h6>
                        <div class="w-100"></div>

                    <div id="content" class="post-desc d-none d-md-block">

                            {{ post.content }}

                    </div>
                    <div class="w-100"></div>
                    <div class="post-bottom">
                            <a :href="'/post/'+post.title_slugged+'#comments'">
                            <i class="fa fa-comments" aria-hidden="true"></i> {{ post.comment }}
                            <span v-if="post.comment > 1"> comments</span>
                            <span v-else> comment</span>
                            </a>
                    </div>
                </div>
            </div>

            </a>
        </div>
    </div>`
});

Vue.component('side-card',{
    props:['items'],
    template:`
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-6" v-for="item in items">
            <a :href="'/post/'+item.title_slugged">
                <div class="slide-card-inv top">
                    <img :src="'/images/'+item.imagepath"/>
                    <div>
                        <h4>{{ item.title }}</h4>
                        <h6>{{ item.name }} - {{ item.created }}</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
    `
});

const app = new Vue({
    el: '#body',
    data: {
        message: 'Hello Vue!'
    }

})
