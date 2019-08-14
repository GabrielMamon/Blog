Vue.component('post-items', {
    props: ['posts'],
    template:
    `<div>
        <div v-for="post in posts">
        <a :href="'/post/'+post.title_slugged" class="card-wrap">
        <div class="card my-1">
            <div class="card-body d-flex flex-column">
                <div class="row">
                    <div class="col-md-9">
                    <span  class="post-title">{{ post.title }}</span>
                    </div>

                    <div class="col-md-3">
                        <h6 class="post-category" style="text-align: right;">
                            <a :href="/category/+post.category" class="cat-btn">{{ post.category }}</a>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <h6 class="post-authordate">
                        <a :href="/author/+post.name">{{ post.name }}</a> - {{ post.created }}
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 d-flex flex-wrap align-items-center">
                        <img :src="'/images/'+post.imagepath"
                            style="max-width: 75%;">
                    </div>

                    <div class="col-md-8 col-sm-6 ">
                        <div id="content" class="col">
                        <p class="card-text card-content" style="margin-top:10px">
                                {{ post.content }}
                        </p>
                        </div>
                        <div class="w-100"></div>
                        <div class="col card-bottom align-items-end">
                                <a :href="'/post/'+post.title_slugged+'#comments'">
                                <i class="fa fa-comments" aria-hidden="true"></i> {{ post.comment }}</a>
                        </div>
                    </div>
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
    }
})


