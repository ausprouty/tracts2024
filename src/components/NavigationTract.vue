<template>
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

      <q-toolbar-title v-on:click="navigateToPage">{{
        this.tract
      }}</q-toolbar-title>
      <ShareLink />
      <FontSize/>
    </q-toolbar>
  </q-header>
</template>
<script>
import { defineComponent } from "vue";
import ShareLink from "components/ShareLink.vue";
import FontSize from "components/FontSize.vue";
export default defineComponent({
  name: "NavigationTract",
  components: { ShareLink , FontSize },
  data() {
    return {
      tract: localStorage.getItem("tractLanguageName", "Bi-lingual 4SL+"),
    };
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
