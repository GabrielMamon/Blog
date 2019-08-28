

Vue.component('comment-card',{
    props: ['comments'],
    template:
    `<div class="col-md-12">
        <div v-if="comments.length == 0">
            <div class="card border-0" >
                <div class="card-body">No comments to display.</div>
            </div>
        </div>
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
        },
        datetoday: function(){
            return moment().format('MMM DD YYYY')
        },
        commentnum: function(){
            return this.sampledata.length;
        }
    },
    methods: {
        addComment: function(commentId,commentUser){
            axios.post('/comment/addcomment',{
                InputPostID: commentId,
                InputUserID: commentUser,
                InputComment: this.commentText
            }).then((response)=>{

            }).catch((error)=>{
                console.log(error.response.data)
            });
            this.sampledata.unshift({name:commentUser,comment:this.commentText,created:this.datetoday});
        },
    },
    mounted() {
        axios.get('/api/listcomment/'+this.paramid)
        .then(response => (
            this.sampledata = response.data
            ))
    },
})






