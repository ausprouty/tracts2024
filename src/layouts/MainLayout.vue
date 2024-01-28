<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar class="toolbar-width">
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          v-on:click="navigateToPage"
        />

        <q-toolbar-title> Bi-lingual 4SL+ </q-toolbar-title>
        <ShareLink />
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
      <footer class="footer">Copyright 2011-2024 Power to Change</footer>
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
import ShareLink from "components/ShareLink.vue";
import { useRoute } from 'vue-router';

export default defineComponent({
  name: "MainLayout",
  components: {
    ShareLink,
  },
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
  background-color: darkgrey;
  color: white;
  padding: 10px;
  text-align: center;
  width: 100%;
  max-width: 600px;
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
