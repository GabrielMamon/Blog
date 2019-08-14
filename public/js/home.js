Vue.component('post-items', {
    props: ['posts'],
    template:
    `<div>
        <div v-for="post in posts">
        <div class="card my-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                    <a :href="'/post/'+post.title_slugged" class="post-title">{{ post.title }}</a>
                    </div>

                    <div class="col-md-3">
                        <h6 class="post-category" style="text-align: right;">
                            <a href='#' class="cat-btn">{{ post.category }}</a>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <h6 class="post-authordate">
                        <a href="#">{{ post.name }}</a> - {{ post.created }}
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 d-flex flex-wrap align-items-center">
                        <img :src="'/images/'+post.imagepath"
                            style="max-width: 75%;">
                    </div>

                    <div class="col-md-8 col-sm-6 ">
                        <div id="content" class="row px-1">
                        <p class="card-text card-content" style="margin-top:10px">
                                {{ post.content }}
                        </p>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-6">
                                    <a :href="'/post/'+post.title_slugged" class="card-link">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>`
})


const app = new Vue({
    el: '#body',
    data: {
        message: 'Hello Vue!'
    }
})


