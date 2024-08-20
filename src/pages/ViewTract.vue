<template>
  <NavigationTract />
  <InstallToHomeScreen />
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
import InstallToHomeScreen from "src/components/InstallToHomeScreen.vue";
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
  components: { NavigationTract, InstallToHomeScreen, DownloadAllTracts, },
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
:root {
  --primary-color: #009da5;
  --secondary-color: #ffc700;

  --accent-color: #6c5ce7;
  --accent-color: #dc143c;
  --accent-color: #50c878;
  --accent-color: #f4c430;
  --accent-color: #e0115f;
  --accent-color: #4b0082;

  --background-color: #f8f9fa;
}
.container {
  display: flex;
  justify-content: space-between; /* This will space the elements equally across the container */
}


img.village-image {
  width: 100%;
}
img.tract-circle-image {
  width: 80%;
  max-width: 200px;
}
hr.village-page {
  border: none;
  border-top: 5px solid var(--accent-color);
  margin: 10px 0; /* Adjust the padding (top and bottom) as needed */
}

p.village-text {
  margin: 0px;
}
p.center {
  text-align: center;
}
p.notice {
  margin-top:10px;
  font-size: 0.8em;
  color: #009da5;
  text-align: center;
}
.tract-lawheading {
  font-size: var(--FontSize11, 1.1em);
  font-weight: bold;
  color: var(--accent-color);
}
.tract-law,
.mylanguage {
  font-size: var(--FontSize11, 1.1em);
  line-height: 1.3em;
  font-weight: bold;
  color: var(--accent-color);
}
.tract-law-number {
  font-size: var(--FontSize30, 3em);
  color: var(--accent-color);
  width: var(--LawNumberWidth, 20px);
}

.mylanguage {
  padding-left: 15px;
  padding-right: 15px;
}
.tract-countryname,
.tract-heading {
  font-size: var(--FontSize11, 1.1em);
  line-height: 1.3em;
  color: var(--primary-color);
  font-weight: bold;
}

.tractTitle {
  text-align: right;
}

.section-intro,
.section-law1,
.section-law2,
.section-law3,
.section-law4,
.section-circles,
.div-circles,
.section-prayer,
.section-know,
.section-nowthat,
.section-grow,
.section-feel,
.section-church,
.section-contact {
  background-color: #fff;
  border: none;
}
.section-title {
  background-color: #fff;
  font-size: var(--FontSize12, 1.2em);
  line-height: 1.3em;
  color: var(--accent-color);
  white-space: normal;
  text-align: left;
  position: relative;
  display: table-cell;
}
.section-copyright {
  padding-top: 40px;
  padding-left: 15px;
  padding-right: 15px;
}
table {
  table-layout: fixed;
}
#tract-table {
  border: none;
  background-color: #fff;
}
tbody tr {
  border-top: none;
}
.tract-header {
  background-color: #fff;
  border: none;
}
tr.tract-row {
  vertical-align: top;
}
td {
  vertical-align: top;
  padding-bottom: 1em;
}
td.side-left,
th.side-left {
  border-bottom: 0;
  padding-left: 5px;
  width: 50%;
  padding-right: 30px;
}
td.side-right,
th.side-right {
  border-bottom: 0;
  width: 50%;
  padding-left: var(--SideRightPadding, 30px);
  padding-right: 5px;
}
td.side-whole,
th.side-whole {
  border-bottom: 0;
  padding-left: 5px;
  padding-right: 5px;
}
td.tract-image,
td.tract-circle1,
td.tract-circle2 {
  text-align: center;
}
td.rtl {
  text-align: right;
}
a {
  color: #aa0040;
}
img.tract-image {
  width: 70%;
  max-width: 300px;
}
.tract-image-image {
  max-width: 90%;
  height: auto;
  width: auto\9; /* ie8 */
}
.tract-image-circle-image {
  max-width: 90%;
  height: auto;
  width: auto\9; /* ie8 */
}

a.tract-link {
  color: var(--accent-color);
}
.tract-verse {
  font-size: var(--FontSize10, 1em);
  line-height: 1.3em;
  font-style: italic;
  color: black;
}
.tract-text {
  font-size: var(--FontSize10, 1em);
  color: #000;
}
.tract-explanation {
  font-size: var(--FontSize08, 0.8em);
  color: #000;
}
.tract-circle-image {
  text-align: center;
}
p {
  margin: 10px;
}
p.tract-circle-heading-ltr,
p.tract-circle-heading-rtl,
.tract-circle-heading {
  font-size: var(--FontSize11, 1.1em);
  color: var(--primary-color);
  line-height: 1.3em;
  text-align: center;
  font-weight: bold;
}
p.tract-circle-subhead,
.tract-circle-image {
  font-size: var(--FontSize10, 1em);
  color: #000;
  text-align: center;
  font-weight: bold;
}
p.tract-circle-point-ltr,
.tract-circle-text {
  font-size: var(--FontSize10, 1em);
  color: #000;
  text-align: left;
}
p.tract-circle-point-rtl {
  font-size: var(--FontSize10, 1em);
  color: #000;
  text-align: right;
  direction: rtl;
}
p.rtl {
  text-align: right;
}
.tract-circle-footer-ltr {
  font-size: var(--FontSize10, 1em);
  color: #000;
  text-align: center;
  font-weight: normal;
}
.tract-circle-footer-rtl {
  font-size: var(--FontSize10, 1em);
  color: #000;
  text-align: center;
  font-weight: normal;
  direction: rtl;
}
.tract-circle-explanation,
.tract-circle-explanation-ltr,
.tract-circle-explanation-rtl {
  font-size: var(--FontSize08, 0.8em);
  color: #000;
  text-align: center;
}
.tract-heading.translation,
.tract-verse.translation,
.translation {
  color: #aaa;
}
.tract-prayer,
.tract-address,
.bold {
  font-weight: bold;
}

p.tract-circle-point-ltr,
p.tract-circle-point-rtl {
  text-indent: -1.3em;
  padding-left: 1.3em;
}
.background {
  margin-left: 15px;
  margin-right: 15px;
}
li.background {
  margin-left: 15px;
}
li.rtl {
  direction: rtl;
}
h3 {
  margin-top: 1em;
}
p.background {
  font-size: var(--FontSize10, 1em);
}
div.content {
  padding-left: 7px;
  padding-right: 7px;
}
p.burmese,
.burmese{
  line-height:1.7em;
}
img.village-icon{
  width:100px;
}
</style>
