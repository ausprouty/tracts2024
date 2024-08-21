<template>
  <InstallToHomeScreen />
  <router-view />
</template>

<script>
import { defineComponent } from "vue";
import InstallToHomeScreen from "components/InstallToHomeScreen.vue";

export default defineComponent({
  name: "App",
  components: {
    InstallToHomeScreen,
  },
});
</script>
