<template>
  <q-layout view="lHh Lpr lFf">

    <q-page-container>
      <router-view />
      <footer class="footer">Copyright 2011-2024 Power to Change</footer>
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
import { useRoute } from 'vue-router';

export default defineComponent({
  name: "MainLayout",

  data() {
    return {
      route: useRoute()
    }
  },
  created(){
    console.log(this.route)
  },
  methods: {
    navigateToPage: function () {
      localStorage.removeItem("tractLanguageName");
      localStorage.removeItem("tractLanguageFile");
      this.$router.push({
        name: "Index",
      });
    },
  },
});
</script>
<style>
.footer {
  background-color: #009da5;
  color: white;
  padding: 10px;
  text-align: center;
  width: 100%;
  margin: 0 auto;
}
.q-toolbar__title {
  font-size: 16px;
}

.q-header {
  width: 100%;
  margin: 0 auto;
}
.toolbar-width,
.max-width {
  width: 100%;
  margin: 0 auto;
}
</style>
