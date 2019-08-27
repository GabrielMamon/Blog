
new Vue({
  el: "#body",
  data: {
    columns: [
        {
            label: 'Banner',
            field: 'banner',
        },
        {
            label: 'Post',
            field: 'post',
        },
        {
            label: 'Category',
            field: 'category',
        },
        {
            label: 'Featured',
            field: 'featured',
        },
        {
            label: 'Date Posted',
            field: 'dateposted',
        },
      ],
    rows: [
        { banner:"uploaded/cover/cyberpunk-2077_1562328803.jpg", post: 'Cyberpunk 2077',content:'Cyberpunk 2077 is an upcoming role-playing video game developed and published by CD Projekt, releasing for Microsoft Windows, PlayStation 4, and Xbox',
          category: 'Games',featured: 0, dateposted:'2019-07-05 20:13:23' },
        ],

  },methods: {

  },
});

