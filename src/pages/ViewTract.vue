<template>
  <NavigationTract />
  <q-page padding>
    <div v-html="tractContent"></div>
  </q-page>
  <DownloadAllTracts />
    <div v-if="downloaded">
      <p class="notice">(All tracts are available offline)</p>
    </div>
</template>

<script>
import DownloadAllTracts from "components/DownloadAllTracts.vue";
import { useTractStore } from "stores/TractStore";
import NavigationTract from "components/NavigationTract.vue";
import { getCssVar, setCssVar } from "quasar";

function setCssVars(screenWidth) {
  console.log("I am setting font size");
  document.documentElement.style.setProperty(
    `--FontSize08`,
    fontSizeString(0.8)
  );
  document.documentElement.style.setProperty(
    `--FontSize09`,
    fontSizeString(0.9)
  );
  document.documentElement.style.setProperty(`--FontSize10`, fontSizeString(1));
  document.documentElement.style.setProperty(
    `--FontSize11`,
    fontSizeString(1.1)
  );
  document.documentElement.style.setProperty(
    `--FontSize12`,
    fontSizeString(1.2)
  );
  document.documentElement.style.setProperty(
    `--FontSize13`,
    fontSizeString(1.3)
  );
  document.documentElement.style.setProperty(
    `--FontSize14`,
    fontSizeString(1.4)
  );
  document.documentElement.style.setProperty(`--FontSize20`, fontSizeString(2));
  document.documentElement.style.setProperty(`--FontSize30`, fontSizeString(3));
  var padding = "0px";
  if (screenWidth > 600) {
    padding = "30px";
  }
  document.documentElement.style.setProperty(`--SideRightPadding`, padding);
  var fontSize = getLocalStorageTractFontSize();
  padding = "20px";
  if (fontSize > 17) {
    padding = "30px";
  }
  document.documentElement.style.setProperty(`--LawNumberWidth`, padding);
}

function fontSizeString(sizing) {
  var currentFontString = getCssVar("theme-font-size");
  currentFontString.replace("px", "");
  var currentFontInt = parseInt(parseInt(currentFontString) * sizing);
  return currentFontInt + "px";
}
function getLocalStorageTractFontSize() {
  var baseFontSize = 14;
  if (
    localStorage.getItem("tractFontSize") &&
    localStorage.getItem("tractFontSize") !== "null"
  ) {
    console.log(
      "Getting from local storage of " + localStorage.getItem("tractFontSize")
    );
    baseFontSize = localStorage.getItem("tractFontSize");
  } else {
    localStorage.setItem("tractFontSize", baseFontSize);
  }
  return baseFontSize;
}

export default {
  name: "ViewTract",
  components: { NavigationTract, DownloadAllTracts, },
  data() {
    return {
      tractContent: "",
      screenWidth: this.$q.screen.width,
      tractFontSizeWatcher: null,
    };
  },
  created() {
    // see if all tracts are downloaded
    this.downloaded = localStorage.getItem("DownloadTimestamp");
    if (this.downloaded == null) {
      this.downloaded = false;
    } else {
      this.downloaded = true;
    }
    const tractStore = useTractStore();
    // Watch the value in the store
    this.tractFontSizeWatcher = this.$watch(
      () => tractStore.tractFontSize,
      (newValue, oldValue) => {
        console.log(`Value is changed from ${oldValue} to  ${newValue}`);
        localStorage.setItem("tractFontSize", newValue);
        setCssVar("theme-font-size", newValue + "px");
        this.updateScreenWidth();
        this.fetchExternalContent();
      }
    );
  },
  mounted() {
    this.tractFontSize = getLocalStorageTractFontSize();
    const { updateTractFontSize } = useTractStore();
    updateTractFontSize(this.tractFontSize);
    var baseFontString = this.tractFontSize + "px";
    setCssVar("theme-font-size", baseFontString);
    this.updateScreenWidth();
    this.fetchExternalContent();
  },

  methods: {
    updateScreenWidth() {
      this.screenWidth = this.$q.screen.width;
      setCssVars(this.$q.screen.width);
    },
    async fetchExternalContent() {
      try {
        var page = "/tracts/" + this.$route.params.tract + ".html";
        const response = await fetch(page);
        if (response.ok) {
          this.tractContent = await response.text();
        } else {
          this.tractContent =
            "Please access this content while online. The app will then save it for offline use.";
        }
      } catch (error) {
        this.tractContent = "There was an error fetching this content.  Sorry.";
      }
    },
  },
};
</script>
<style>
/* Global Variables */
:root {
  --primary-color: #009da5;
  --secondary-color: #ffc700;
  --accent-color: #50c878;
  --background-color: #f8f9fa;
  --text-color: #000;
  --muted-color: #aaa;
  --font-size-base: 1em;
  --font-size-small: 0.8em;
  --font-size-large: 1.2em;
  --line-height: 1.3;
  --padding-small: 5px;
  --padding-medium: 15px;
  --padding-large: 30px;
}

/* Layout & Containers */
.container {
  display: flex;
  justify-content: space-between; /* Space out elements evenly */
}

.background {
  margin-left: var(--padding-medium);
  margin-right: var(--padding-medium);
}

div.content {
  padding: var(--padding-small);
}

/* Typography */
p, h3 {
  margin: 10px;
  line-height: var(--line-height);
  color: var(--text-color);
}

h3 {
  margin-top: 1em;
}

p.notice {
  margin-top: 10px;
  font-size: var(--font-size-small);
  color: var(--primary-color);
  text-align: center;
}

.tract-prayer,
.tract-address,
.bold {
  font-weight: bold;
}

/* Text Alignments */
p.center {
  text-align: center;
}

p.rtl,
li.rtl {
  text-align: right;
  direction: rtl;
}

/* Images */
img {
  max-width: 100%;
  height: auto;
}

img.village-image {
  width: 100%;
}

img.village-icon {
  width: 100px;
}

img.tract-circle-image {
  width: 80%;
  max-width: 200px;
}

img.tract-image {
  width: 70%;
  max-width: 300px;
}

/* Section Styles */
.section-title {
  font-size: var(--font-size-large);
  color: var(--accent-color);
  text-align: left;
  background-color: #fff;
}

.section-intro,
.section-law1,
.section-law2,
.section-law3,
.section-law4,
.section-prayer {
  background-color: #fff;
  border: none;
}

.section-copyright {
  padding-top: 40px;
  padding-left: var(--padding-medium);
  padding-right: var(--padding-medium);
}

/* Tables */
table {
  table-layout: fixed;
  width: 100%;
  border-collapse: collapse;
}

td, th {
  padding: var(--padding-small);
  vertical-align: top;
}

td.side-left {
  width: 50%;
  padding-right: var(--padding-large);
}

td.side-right {
  width: 50%;
  padding-left: var(--padding-large);
}

/* Links */
a {
  color: #aa0040;
}

a.tract-link {
  color: var(--accent-color);
}

/* Specific Classes */
.tract-lawheading {
  font-size: var(--font-size-large);
  font-weight: bold;
  color: var(--accent-color);
}

.tract-text {
  font-size: var(--font-size-base);
  color: var(--text-color);
}

.tract-verse {
  font-size: var(--font-size-base);
  font-style: italic;
}

p.tract-circle-heading-ltr {
  text-align: center;
  font-size: var(--font-size-large);
  color: var(--primary-color);
  font-weight: bold;
}

/* Notice */
p.notice {
  font-size: var(--font-size-small);
  color: var(--primary-color);
}
</style>
