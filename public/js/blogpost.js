Vue.component('comment-card',{
    props: ['comments'],
    template:
    `<div  class="col-md-12">
        <div v-for="comment in comments">
            <div class="card border-0" >
                <div class="card-body">
                <p class="card-title" style="font-size: 14px"><b>{{comment.name }} - </b> <span class="text-muted">{{ comment.created }}</span></p>
                <p class="card-text">{{ comment.comment }}</p>
                </div>
            </div>
            <br/>
        </div>
    </div>`
})

const app = new Vue({
    el: '#body',
    data: {
        commentText:"",
        sampledata:[],
        paramtitle: window.location.pathname
    },computed: {
        paramid: function(){
            let arr = this.paramtitle.split("/")
            return arr[2];
        }
    },
    methods: {
        addComment: function(commentId,commentUser){
            this.sampledata.unshift({name:commentId,comment:this.commentText,created:'xxxxx'})
        },
    },
    mounted() {
        axios.get('/api/comment/'+this.paramid)
        .then(response => (this.sampledata = response.data))
    },
})






