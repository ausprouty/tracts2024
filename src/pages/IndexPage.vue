<template>
  <q-page class="flex flex-center">
    <LanguageList
      v-for="language in languages"
      :key="language.id"
      :language="language"
    />
  </q-page>
</template>

<script>
import LanguageList from "components/LanguageList.vue";

export default {
  name: "IndexPage",
  components: { LanguageList },
  data() {
    return {
      languages: [
        { id: 45, name: "Thai", file: "ThjEng4", local: "Y" },
        { id: 46, name: "Finnish", file: "FinEng4", local: "Y" },
        { id: 47, name: "Turkish", file: "TrkEngM", local: "Y" },
        { id: 48, name: "Urdu", file: "UrdEng4", local: "Y" },
        { id: 49, name: "Norwegian", file: "NorEng4", local: "Y" },
        { id: 50, name: "Bulgarian", file: "BulEng4", local: "Y" },
        { id: 51, name: "Kazakh", file: "KazEng4", local: "Y" },
        { id: 52, name: "Bambara", file: "BamEng4", local: "Y" },
        { id: 53, name: "Changane", file: "ChaEng4", local: "Y" },
        { id: 54, name: "Czech", file: "CzcEng4", local: "Y" },
        { id: 55, name: "Dinka Bor", file: "DibEng4", local: "Y" },
        { id: 56, name: "Ekegussii", file: "GuzEng4", local: "Y" },
        { id: 57, name: "Hebrew", file: "HebEngJ", local: "Y" },
        { id: 58, name: "Yiddish", file: "YidEngJ", local: "Y" },
        { id: 59, name: "Hausa", file: "HuaEng4", local: "Y" },
        { id: 60, name: "Ibo", file: "IgrEng4", local: "Y" },
        { id: 61, name: "Kalenjin", file: "KalEng4", local: "Y" },
        { id: 62, name: "Kamba", file: "KikEng4", local: "Y" },
        { id: 63, name: "Kinyarawandan", file: "RuaEng4", local: "Y" },
        { id: 64, name: "Luba Kaonde", file: "KqnEng4", local: "Y" },
        { id: 65, name: "Shona", file: "ShdEng4", local: "Y" },
        { id: 66, name: "Sotho", file: "SsoEng4", local: "Y" },
        { id: 67, name: "Zaire Swahili", file: "Swa2Eng4", local: "Y" },
        { id: 68, name: "Swedish", file: "SweEng4", local: "Y" },
        { id: 69, name: "Tongan", file: "TovEng4", local: "Y" },
        { id: 70, name: "Siswati", file: "SwzEng4", local: "Y" },
        { id: 71, name: "Tsonga", file: "TsoEng4", local: "Y" },
        { id: 72, name: "Tswana", file: "TswEng4", local: "Y" },
        { id: 73, name: "Akuapwim Twi", file: "TwsEng4", local: "Y" },
        { id: 74, name: "Tyap", file: "TyaEng4", local: "Y" },
        { id: 75, name: "Xhosa", file: "XosEng4", local: "Y" },
        { id: 76, name: "Zulu", file: "ZuuEng4", local: "Y" },
        { id: 77, name: "Tibetan", file: "TibEng4", local: "Y" },
        { id: 78, name: "Ukrainian", file: "UkrEng4", local: "Y" },
        {
          id: 79,
          name: "Vietnamese (university)",
          file: "VieEng4",
          local: "Y",
        },
        { id: 80, name: "English", file: "Eng4.htm", local: "Y" },
        { id: 81, name: "Konkani", file: "GomEng4", local: "Y" },
        { id: 82, name: "Aymara", file: "AymEng4", local: "Y" },
        { id: 83, name: "Bicolano", file: "BclEng4", local: "Y" },
        { id: 84, name: "Chibemba", file: "BemEng4", local: "Y" },
        { id: 85, name: "Bukusu", file: "BxkEng4", local: "Y" },
        { id: 86, name: "Runyoro", file: "NyoEng4", local: "Y" },
        { id: 0, name: "Albanian", file: "AlnEng4", local: "Y" },
        { id: 1, name: "Acholi", file: "AcoEng4", local: "Y" },
        { id: 2, name: "Cebuano", file: "CebEng4", local: "Y" },
        { id: 3, name: "Chinese (Traditional)", file: "Chn1Eng4", local: "Y" },
        { id: 4, name: "Chinese (Simplified)", file: "ChnEng4", local: "Y" },
        { id: 5, name: "Arabic", file: "AraEngM", local: "Y" },
        { id: 6, name: "Dinka", file: "DinEng4", local: "Y" },
        { id: 7, name: "Danish", file: "DnsEng4", local: "Y" },
        { id: 8, name: "Dutch", file: "DutEng4", local: "Y" },
        { id: 9, name: "Fijian", file: "FjiEng4", local: "Y" },
        { id: 10, name: "Estonian", file: "EstEng4", local: "Y" },
        { id: 11, name: "Greek", file: "GrkEngK", local: "Y" },
        { id: 12, name: "French", file: "FrnEngK", local: "Y" },
        { id: 13, name: "French (special)", file: "FrnEngM", local: "Y" },
        { id: 14, name: "German", file: "GerEngK", local: "Y" },
        { id: 15, name: "Haitian", file: "HatEng4", local: "Y" },
        { id: 16, name: "Hungarian", file: "HngEng4", local: "Y" },
        { id: 17, name: "Ilocano", file: "IloEng4", local: "Y" },
        { id: 18, name: "Indonesian", file: "IndEng4", local: "Y" },
        { id: 19, name: "Indonesan (special)", file: "IndEngM", local: "Y" },
        { id: 20, name: "Italian", file: "ItaEng4", local: "Y" },
        { id: 21, name: "Mongolian", file: "KhkEng4", local: "Y" },
        { id: 22, name: "Hindi", file: "HndEng4", local: "Y" },
        { id: 23, name: "Japanese", file: "JpnEng4", local: "Y" },
        { id: 24, name: "Latvian", file: "LatEng4", local: "Y" },
        { id: 25, name: "Korean", file: "KknEng4", local: "Y" },
        { id: 26, name: "Malagasy", file: "MexEng4", local: "Y" },
        { id: 27, name: "Nuer", file: "NusEng4", local: "Y" },
        { id: 28, name: "Oromo (central)", file: "Oro1Eng4", local: "Y" },
        { id: 29, name: "Farsi", file: "PesEngM", local: "Y" },
        { id: 30, name: "Polish", file: "PolEng4", local: "Y" },
        { id: 31, name: "Afrikaans", file: "AfkEng4", local: "Y" },
        { id: 32, name: "Pedi", file: "SrtEng4", local: "Y" },
        { id: 33, name: "Brazilian Portuguese", file: "Por2Eng4", local: "Y" },
        { id: 34, name: "Romanian", file: "RumEng4", local: "Y" },
        { id: 35, name: "Russian", file: "RusEng4", local: "Y" },
        { id: 36, name: "Russian (Central Asia)", file: "RusEngM", local: "Y" },
        { id: 37, name: "Setswana", file: "SetEng4", local: "Y" },
        { id: 38, name: "Serbian", file: "SerEng4", local: "Y" },
        { id: 39, name: "Somali", file: "SomEng4", local: "Y" },
        { id: 40, name: "Spanish", file: "Spn2Eng4", local: "Y" },
        { id: 41, name: "Croatian", file: "SrcEng4", local: "Y" },
        { id: 42, name: "Swahili", file: "SwaEng4", local: "Y" },
        { id: 43, name: "Tagalog", file: "TagEng4", local: "Y" },
        { id: 44, name: "Sinhala", file: "SinEng4", local: "Y" },
      ],
    };
  },
  created() {
    //console.log (this.languages)
  },
};
</script>
