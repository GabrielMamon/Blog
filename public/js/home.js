
Vue.component('post-items', {
    props: ['posts'],
    template:
    `<div class="col-md-12">
        <div v-for="post in posts" class="post-card">
            <a :href="'/post/'+post.title_slugged" class="post-wrap" style="outline: none;">
            <div class="row">
                <div class="col-md-9">
                    <span class="post-title">{{ post.title }}</span>
                </div>

                <div class="col-md-3">
                    <h6 class="post-category" style="text-align: right;">
                        <a :href="/category/+post.category" class="cat-btn">{{ post.category }}</a>
                    </h6>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h6 class="post-authordate">
                        <a :href="/author/+post.name">{{ post.name }}</a> - {{ post.created }}
                    </h6>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-6 align-items-center">
                    <img :src="'/images/'+post.imagepath"
                        style="height: 150px; max-width: 200px;">
                </div>

                <div class="col-md-8 col-sm-6">
                    <div id="content" class="col">
                    <p class="card-text post-content" style="margin-top:10px">
                            {{ post.content }}
                    </p>
                    </div>
                    <div class="w-100"></div>
                    <div class="col post-bottom">
                            <a :href="'/post/'+post.title_slugged+'#comments'">
                            <i class="fa fa-comments" aria-hidden="true"></i> {{ post.comment }}</a>
                    </div>
                </div>
            </div>

            </a>
        </div>
    </div>`
})

const app = new Vue({
    el: '#body',
    data: {
        message: 'Hello Vue!'
    },

})


