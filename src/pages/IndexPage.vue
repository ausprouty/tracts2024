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
  </q-page>
</template>

<script>
import LanguageList from "components/LanguageList.vue";
import NavigationIndex from "components/NavigationIndex.vue";
import FindTract from "components/FindTract.vue";
import InstallToHomeScreen from "components/InstallToHomeScreen.vue";
import { setCssVar } from "quasar";

export default {
  name: "IndexPage",
  components: { LanguageList, NavigationIndex, FindTract, InstallToHomeScreen },
  mounted() {
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
  },
  data() {
    return {
      languages: [
        { name: "Acholi", file: "AcoEng4" },
        { name: "Afrikaans", file: "AfkEng4" },
        { name: "Akuapwim Twi", file: "TwsEng4" },
        { name: "Albanian", file: "AlnEng4" },
        { name: "Arabic", file: "AraEngM" },
        { name: "Aymara", file: "AymEng4" },
        { name: "Bambara", file: "BamEng4" },
        { name: "Bicolano", file: "BclEng4" },
        { name: "Brazilian Portuguese", file: "Por2Eng4" },
        { name: "Bukusu", file: "BxkEng4" },
        { name: "Bulgarian", file: "BulEng4" },
        { name: "Cebuano", file: "CebEng4" },
        { name: "Changane", file: "ChaEng4" },
        { name: "Chibemba", file: "BemEng4" },
        { name: "Chinese (Simplified)", file: "ChnEng4" },
        { name: "Chinese (Traditional)", file: "Chn1Eng4" },
        { name: "Croatian", file: "SrcEng4" },
        { name: "Czech", file: "CzcEng4" },
        { name: "Danish", file: "DnsEng4" },
        { name: "Dinka Bor", file: "DibEng4" },
        { name: "Dinka", file: "DinEng4" },
        { name: "Dutch", file: "DutEng4" },
        { name: "Ekegussii", file: "GuzEng4" },
        { name: "English", file: "Eng4" },
        { name: "Estonian", file: "EstEng4" },
        { name: "Farsi", file: "PesEngM" },
        { name: "Fijian", file: "FjiEng4" },
        { name: "Finnish", file: "FinEng4" },
        { name: "French (special)", file: "FrnEngM" },
        { name: "French", file: "FrnEngK" },
        { name: "German", file: "GerEngK" },
        { name: "Greek", file: "GrkEngK" },
        { name: "Haitian", file: "HatEng4" },
        { name: "Hausa", file: "HuaEng4" },
        { name: "Hebrew", file: "HebEngJ" },
        { name: "Hindi", file: "HndEng4" },
        { name: "Hmong[blue]", file: "HmbEngV0" },
        { name: "Hungarian", file: "HngEng4" },
        { name: "Ibo", file: "IgrEng4" },
        { name: "Ilocano", file: "IloEng4" },
        { name: "Indonesan (special)", file: "IndEngM" },
        { name: "Indonesian", file: "IndEng4" },
        { name: "Italian", file: "ItaEng4" },
        { name: "Japanese", file: "JpnEng4" },
        { name: "Kalenjin", file: "KalEng4" },
        { name: "Kamba", file: "KikEng4" },
        { name: "Kazakh", file: "KazEng4" },
        { name: "Kinyarawandan", file: "RuaEng4" },
        { name: "Konkani", file: "GomEng4" },
        { name: "Korean", file: "KknEng4" },
        { name: "Latvian", file: "LatEng4" },
        { name: "Luba Kaonde", file: "KqnEng4" },
        { name: "Malagasy", file: "MexEng4" },
        { name: "Mongolian", file: "KhkEng4" },
        { name: "Norwegian", file: "NorEng4" },
        { name: "Nuer", file: "NusEng4" },
        { name: "Oromo (central)", file: "Oro1Eng4" },
        { name: "Pedi", file: "SrtEng4" },
        { name: "Polish", file: "PolEng4" },
        { name: "Romanian", file: "RumEng4" },
        { name: "Runyoro", file: "NyoEng4" },
        { name: "Russian (Central Asia)", file: "RusEngM" },
        { name: "Russian", file: "RusEng4" },
        { name: "Serbian", file: "SerEng4" },
        { name: "Setswana", file: "SetEng4" },
        { name: "Shona", file: "ShdEng4" },
        { name: "Sinhala", file: "SinEng4" },
        { name: "Siswati", file: "SwzEng4" },
        { name: "Somali", file: "SomEng4" },
        { name: "Sotho", file: "SsoEng4" },
        { name: "Spanish", file: "Spn2Eng4" },
        { name: "Swahili", file: "SwaEng4" },
        { name: "Swedish", file: "SweEng4" },
        { name: "Tagalog", file: "TagEng4" },
        { name: "Thai", file: "ThjEng4" },
        { name: "Tibetan", file: "TibEng4" },
        { name: "Tongan", file: "TovEng4" },
        { name: "Tsonga", file: "TsoEng4" },
        { name: "Tswana", file: "TswEng4" },
        { name: "Turkish", file: "TrkEngM" },
        { name: "Tyap", file: "TyaEng4" },
        { name: "Ukrainian", file: "UkrEng4" },
        { name: "Urdu", file: "UrdEng4" },
        { name: "Vietnamese (university)", file: "VieEng4" },
        { name: "Xhosa", file: "XosEng4" },
        { name: "Yiddish", file: "YidEngJ" },
        { name: "Zaire Swahili", file: "Swa2Eng4" },
        { name: "Zulu", file: "ZuuEng4" },
      ],
    };
  },
};
</script>
