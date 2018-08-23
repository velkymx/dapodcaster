<template>
<div>
<ul>
  <li v-for="podcast in podcasts">{{podcast.name}}</li>
</ul>
</div>
</template>
<script>
  export default {
    data() {
      return {
        podcasts: [
          {"name": "Podcast One"},
          {"name": "Podcast Two"},
          {"name": "Podcast Three"}
        ],
        pageCount: 1
      }
    },
    created() {
            this.fetch();
        },

  methods: {
           fetch() {
               axios.get('api/show/')
                   .then(({data}) => {
                       this.podcasts = data.data;
                       this.pageCount = data.meta.last_page;
                   });
           },
         }
       }
</script>
