const dash = new Vue({
  el: "#body",
  data: {
    lcheckenable: true,
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
        this.lcheckenable = false;
        axios.post('/api/listpost/edit_feature',{
            PostTitleSlug: title_slug,
        }).then((response)=>{
            this.lcheckenable = true;
        }).catch((error)=>{
            console.log(error.response.data)
        });
    },
  },components: {

  },
  mounted() {
      axios.get('/api/listpost').then(response => {
        this.rows = response.data;
    });
  },
});

