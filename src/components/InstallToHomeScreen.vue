<template>
  <div v-if="showInstallPrompt" class="install-pwa">
    <div class="install">
      <p>Install this app on your device without going to an App store.</p>
      <p>
        Once installed, you can view tracts just like with any other app on your device.
      </p>
      <p>
        You can install ALL of the tracts by clicking the button at the bottom
        of this page OR just install the tracts you
        view when you have an internet connection.
      </p>
    </div>

    <div class="q-pa-md">
      <div class="row justify-between">
        <q-btn
          v-if="isAndroid"
          color="primary"
          @click="installApp"
          label="Install"
        />
        <q-btn
          v-if="isIOS"
          color="primary"
          @click="showIOSInstructions"
          label="Install"
        />
        <q-btn color="primary" @click="showIOSInstructions" label="Install" />
        <q-btn color="grey" @click="skipInstallApp" label="Do NOT Install" />
      </div>
    </div>
  </div>
  <div v-if="showIOSMessage" class="ios-message">
    <p>
      To install this app on your iPhone or iPad, locate the share icon ( it looks like this:
      <img class="icon" src="/images/ios-share.png" alt="Share Icon" /> ) and
      then select "Add to Home Screen".
    </p>
    <q-btn color="primary" @click="hideIOSMessage" label="OK" />
  </div>
</template>

<script>
export default {
  name: "InstallToHomeScreen",
  data() {
    return {
      showInstallPrompt: false,
      showIOSMessage: false,
      isAndroid: false,
      isIOS: false,
    };
  },
  mounted() {
    this.detectPlatform();
    if (localStorage.getItem("tractBeforeInstallPromptFired") === null) {
      console.log ("Adding event listener");
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
    detectPlatform() {
      const userAgent = window.navigator.userAgent.toLowerCase();
      this.isAndroid = userAgent.includes("android");
      this.isIOS = /iphone|ipad|ipod/.test(userAgent);
    },
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
    showIOSInstructions() {
      this.showIOSMessage = true;
    },
    hideIOSMessage() {
      this.showIOSMessage = false;
      this.showInstallPrompt = false;
    },
    skipInstallApp() {
      this.deferredPrompt = null;
      this.showInstallPrompt = false;
    },
  },
};
</script>

<style scoped>
.icon {
  width: 20px; /* Adjust width to desired size */
  height: auto; /* Maintain aspect ratio */
  vertical-align: middle; /* Align icon vertically with text */
}

.install-pwa {
  background-color: #ffc700;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  text-align: left;
}
.ios-message {
  background-color:#ffc700;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  text-align: center;
}
.row {
  display: flex;
  flex-direction: row;
}
.justify-between {
  justify-content: space-between;
}
</style>
