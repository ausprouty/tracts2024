<template>
  <q-page padding>
   <p>{{this.$route.params.tract}}</p>
   <div v-html="tractContent"></div>
    <!-- content -->
  </q-page>
</template>

<script>

export default {
  name: 'ViewTract',
  data() {
    return {
      tractContent: "",
    }
  },
  mounted() {
    this.fetchExternalContent();
  },
  methods: {
    async fetchExternalContent() {
      try {
        var page = '/src/assets/tracts/' + this.$route.params.tract + '.html'
        const response = await fetch(page)
        if (response.ok) {
          this.tractContent = await response.text();
        } else {
          console.error("Failed to fetch external content");
        }
      } catch (error) {
        console.error("Error fetching external content:", error);
      }
    },
  },
}
</script>
