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

      <q-toolbar-title v-on:click="navigateToPage"
        >Background Information</q-toolbar-title
      >
      <FontSize/>
      <ShareLink />
    </q-toolbar>
  </q-header>
</template>
<script>
import { defineComponent } from "vue";
import FontSize from "components/FontSize.vue";
import ShareLink from "components/ShareLink.vue";
export default defineComponent({
  name: "NavigationTract",
  components: { ShareLink, FontSize  },
  data() {
    return {
      tract: localStorage.getItem("tractLanguageName", "Bi-Lingual 4SL+"),
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
