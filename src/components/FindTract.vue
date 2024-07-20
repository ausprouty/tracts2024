<template>
  <div class="searchBar">
    <input
      type="text"
      class="searchBar"
      v-model="searchQuery"
      @keyup="searchLanguages"
      placeholder="Search for a language or scroll"
    />

    <ul  v-if="filteredLanguages.length">
      <li
        class="shadow-card -shadow"
        v-for="language in filteredLanguages"
        :key="language"
        v-on:click="navigateToPage(language.name, language.file)"
      >
        {{ language.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    languagesData: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      searchQuery: "",
      filteredLanguages: [],
    };
  },

  methods: {
    searchLanguages() {
      if (this.searchQuery === "") {
        this.filteredLanguages = [];
        return;
      }
      this.filteredLanguages = this.languagesData.filter((language) =>
        language.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },

    navigateToPage: function (languageName, languageFile) {
      localStorage.setItem("tractLanguageName", languageName);
      localStorage.setItem("tractLanguageFile", languageFile);
      this.$router.push({
        name: "ViewTract",
        params: {
          tract: languageFile,
        },
      });
    },
  },
};
</script>

<style scoped>
li.shadow-card {
  background-color: lightgrey;
  cursor: pointer;
  margin-top: 6px;
  padding: 5px;
  text-align: left;
  transition: all 0.2s linear;
  width: 100%;
}


input.searchBar {
  margin-top: 12px;
  margin-bottom: 12px;
}
.searchBar {
  width: 100%;
  margin-left:10px;
  font-size: 16px;
  background-color: #f9e398;

}
.searchBar::placeholder {
  /* Set the color of the placeholder text */
  color:#009da5;


}
ul {
  list-style-type: none;
  padding: 0;
}

li,
ul {
  padding: 5px;
  margin: 5px;
  background-color: lightyellow;
  border-radius: 5px;
  cursor: pointer;
}

li:hover {
  background-color: #e0e0e0;
}
</style>
