
new Vue({
  el: "#body",
  data: {
    columns: [
        {
            label: 'Banner',
            field: 'imagepath',
            sortable: false,
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
            label: 'Date Posted',
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
        alert(title_slug);
    },
  },
  mounted() {
      axios.get('/api/listpost').then(response => {
        console.log(response.data);
        this.rows = response.data;
    });
  },
});

