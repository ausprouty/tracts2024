<template>
  <q-header elevated>
    <q-toolbar class="toolbar-width">
      <q-btn flat dense round icon="menu" aria-label="Menu" />

      <q-toolbar-title>Bi-lingual 4SL+</q-toolbar-title>
    </q-toolbar>
  </q-header>
</template>
<script>
import { defineComponent } from 'vue'
export default defineComponent({
  name: "NavigationIndex",

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
