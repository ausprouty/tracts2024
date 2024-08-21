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
          v-if="!isIOS"
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

        <q-btn color="grey" @click="skipInstallApp" label="Do NOT Install" />
      </div>
    </div>
  </div>
  <div v-if="showIOSMessage" class="install-pwa">
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
      deferredPrompt: null,
    };
  },
  mounted() {
    this.checkServiceWorkerSupport();
    this.detectPlatform();
    if (this.isIOS) {
      this.considerShowingIOSMessage();
    }
    if (this.isAndroid) {
      this.considerShowingAndroidMessage();
    }
    if (!this.isIOS && !this.isAndroid) {
      this.considerShowingWebMessage = true;
    }
  },
  unmounted() {
    console.log ("InstallToHomeScreen unmounted");
    window.removeEventListener(
      "beforeinstallprompt",
      this.handleBeforeInstallPrompt
    );
  },
  methods: {
    checkServiceWorkerSupport() {
      if ('serviceWorker' in navigator) {
          console.log('Service workers are supported.');
          navigator.serviceWorker.register('/sw.js')
          .then(function(registration) {
              console.log('Service Worker registered with scope:', registration.scope);
              // Check if the service worker is active and controlling the page
              if (navigator.serviceWorker.controller) {
                  console.log('Service worker is active and controlling the page.');
              } else {
                  console.log('Service worker is registered but not yet controlling the page.');
              }
          })
          .catch(function(error) {
              console.error('Service Worker registration failed:', error);
          });
      } else {
          console.log('Service workers are not supported in this browser.');
      }
    },
    detectPlatform() {
      const userAgent = window.navigator.userAgent.toLowerCase();
      this.isAndroid = userAgent.includes("android");
      this.isIOS = /iphone|ipad|ipod/.test(userAgent);
      this.isIOS = true; // For testing
      console.log("isAndroid", this.isAndroid);
      console.log("isIOS", this.isIOS);
    },
    considerShowingIOSMessage() {
      const dismissed = localStorage.getItem("tractIOSMessageDismissed") === "true";
      if (!dismissed) {
        this.showIOSMessage = true;
      }
    },
    considerShowingAndroidMessage() {
      const dismissed = localStorage.getItem("tractAndroidMessageDismissed") === "true";
      if (!dismissed) {
        console.log("considerShowingAndroidMessage");
        window.addEventListener(
          "beforeinstallprompt",
          this.handleBeforeAndroidInstallPrompt
        );
      }
    },

    handleBeforeInstallPrompt(event) {
      event.preventDefault();
      this.deferredPrompt = event;
      this.showInstallPrompt = true;
      localStorage.setItem("tractBeforeInstallPromptFired", true);
      console.log("beforeinstallprompt event was fired.");
    },
    installApp() {
      if (this.deferredPrompt) {
        this.deferredPrompt.prompt();
        this.deferredPrompt.userChoice.then((choiceResult) => {
          if (choiceResult.outcome === "accepted") {
            console.log("User accepted the A2HS prompt");
            this.showInstallPrompt = false;
            this.deferredPrompt = null;
          } else {
            console.log("User dismissed the A2HS prompt");
            localStorage.setItem("tractInstallPromptDismissed", "true");
            localStorage.setItem("tractInstallPromptDismissedTime", Date.now());
            this.deferredPrompt = null;
          }
        });
      } else {
        console.log("deferredPrompt is not available.");
        this.showManualInstallInstructions();
      }
    },
    showManualInstallInstructions() {
      alert("Unfortunately, the install prompt cannot be triggered automatically at this time. You can manually add this app to your home screen by using your browser's menu.");
    },
    skipInstallApp() {
      this.deferredPrompt = null;
      this.showInstallPrompt = false;
      localStorage.setItem("tractInstallPromptDismissed", "true");
      localStorage.setItem("tractInstallPromptDismissedTime", Date.now());
    },
    resetInstallPrompt() {
      localStorage.removeItem("tractInstallPromptDismissed");
      localStorage.removeItem("tractInstallPromptDismissedTime");
      this.showInstallPrompt = true;
      console.log("Install prompt reset. User can be prompted again.");
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
  width: 100%
}

.row {
  display: flex;
  flex-direction: row;
}
.justify-between {
  justify-content: space-between;
}
</style>
