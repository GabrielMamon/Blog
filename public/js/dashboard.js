
new Vue({
  el: "#body",
  data: {
    columns: [
        {
            label: '',
            field: 'actions',
            tdClass: 'table-items icons',
        },
        {
            label: 'Banner',
            field: 'imagepath',
            sortable: false,
            tdClass: 'table-img',
        },
        {
            label: 'Post',
            field: 'title',
        },
        {
            label: 'Category',
            field: 'category',
            tdClass: 'table-items',
        },
        {
            label: 'Featured',
            field: 'featured',
            tdClass: 'table-items',
        },
        {
            label: 'Posted on',
            field: 'dateposted',
            type: 'date',
            dateInputFormat: 'yyyy-MM-dd HH:mm:ss',
            dateOutputFormat: 'MMM dd yyyy, haa',
            tdClass: 'table-items',
        },
      ],
    rows: [],
  },
  methods: {
    updateFeature:function(title_slug){
        axios.post('/api/listpost/edit_feature',{
            PostTitleSlug: title_slug,

        }).then((response)=>{

        }).catch((error)=>{
            console.log(error.response.data)
        });
    },
  },
  mounted() {
      axios.get('/api/listpost').then(response => {
        console.log(response.data);
        this.rows = response.data;
    });
  },
});

