<template>
  <q-header elevated>
    <q-toolbar class="toolbar-width">
      <q-toolbar-title >Bi-lingual 4SL+</q-toolbar-title>
      <q-btn
        flat
        dense
        round
        icon="help"
        aria-label="Help"
        v-on:click="navigateToPage"
      />
      <FontSize/>
    </q-toolbar>
  </q-header>
</template>
<script>
import { defineComponent } from "vue";
import FontSize from "components/FontSize.vue";

export default defineComponent({
  name: "NavigationIndex",
  components: {FontSize  },
  methods: {
    navigateToPage: function () {
      this.$router.push({
        name: "BackgroundInformation",
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
