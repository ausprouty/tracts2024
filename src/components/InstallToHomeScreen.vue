<template>
  <div v-if="showInstallPrompt" class="install-pwa">
    <div class="install">
      Add this app to your home screen. Then you can share the tracts you have
      viewed even when there is no internet connection.
    </div>
    <div class="q-pa-md">
      <div class="row justify-between">
        <q-btn color="primary" @click="installApp" label="Install" />
        <q-btn
          color="grey"
          @click="skipInstallApp"
          label="Do NOT Install"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "InstallToHomeScreen",
  data() {
    return {
      showInstallPrompt: false,
    };
  },
  mounted() {
    if (localStorage.getItem("tractBeforeInstallPromptFired") == null) {
      window.addEventListener(
        "beforeinstallprompt",
        this.handleBeforeInstallPrompt
      );
    }
  },
  unmounted() {
    window.removeEventListener(
      "beforeinstallprompt",
      this.handleBeforeInstallPrompt
    );
  },
  methods: {
    handleBeforeInstallPrompt(event) {
      event.preventDefault();
      this.showInstallPrompt = true;
      this.deferredPrompt = event;
      localStorage.setItem("tractBeforeInstallPromptFired", true);
    },
    installApp() {
      if (this.deferredPrompt) {
        this.deferredPrompt.prompt();
        this.deferredPrompt.userChoice.then((choiceResult) => {
          if (choiceResult.outcome === "accepted") {
            console.log("User accepted the A2HS prompt");
          } else {
            console.log("User dismissed the A2HS prompt");
          }
          this.deferredPrompt = null;
          this.showInstallPrompt = false;
        });
      }
    },
    skipInstallApp() {
      this.deferredPrompt = null;
      this.showInstallPrompt = false;
    },
  },
};
</script>

<style scoped>
.install-pwa {
  background-color:#ffc700;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  text-align: left;
}
.row {
  display: flex;
  flex-direction: row;
}

.justify-between {
  justify-content: space-between;
}
</style>
