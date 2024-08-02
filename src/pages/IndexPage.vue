<template>
  <q-page class="flex flex-center">
    <NavigationIndex />
    <InstallToHomeScreen />
    <FindTract :languagesData="languages" />
    <LanguageList
      v-for="language in languages"
      :key="language.id"
      :language="language"
    />
    <DownloadAllTracts />
    <div v-if="downloaded ">
      <p class = "notice">(all tracts are available offline)</p>
    </div>
  </q-page>
</template>

<script>
import DownloadAllTracts from "components/DownloadAllTracts.vue";
import FindTract from "components/FindTract.vue";
import InstallToHomeScreen from "components/InstallToHomeScreen.vue";
import LanguageList from "components/LanguageList.vue";
import NavigationIndex from "components/NavigationIndex.vue";
import { setCssVar } from "quasar";

export default {
  name: "IndexPage",
  components: {
    DownloadAllTracts,
    FindTract,
    InstallToHomeScreen,
    LanguageList,
    NavigationIndex,
  },
  mounted() {
    // load languages
    this.loadLanguages();
    // deal with the font size
    var tractFontSize = localStorage.getItem("tractFontSize");
    if (tractFontSize == null) {
      tractFontSize = "20px";
      localStorage.setItem("tractFontSize", tractFontSize);
    }
    setCssVar("theme-font-size", tractFontSize);
    var lastPage = localStorage.getItem("tractLanguageFile");
    console.log(lastPage);
    if (lastPage != null) {
      this.$router.push({
        name: "ViewTract",
        params: {
          tract: lastPage,
        },
      });
    }
    // see if all tracts are downloaded
    downloaded = localStorage.getItem("downloaded");
    if (downloaded == null) {
      downloaded = false;
    } else {
      downloaded = true;
    }
  },
  data() {
    return {
      languages:[],
      downloaded: false,
    };
  },
  methods: {
    async loadLanguages() {
      try {
        const response = await fetch('/tracts/languages.json');
        this.languages = await response.json();
      } catch (error) {
        console.error('Failed to load languages:', error);
      }
    },
  },
};
</script>
