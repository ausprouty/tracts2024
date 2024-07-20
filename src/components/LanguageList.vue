<template>
    <div class="tract-link" v-on:click="navigateToPage">
      <div class="shadow-card -shadow">
        <div class="tract">
          <span class="title">{{ language.name }}</span>
        </div>
      </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
  name: 'LanguageList',
  props: {
    language: Object,
  },
  data() {
    return {
      tract:{}
    }
  },
  methods: {

    navigateToPage: function () {
      localStorage.setItem('tractLanguageName', this.language.name)
      localStorage.setItem('tractLanguageFile', this.language.file)
      this.$router.push({
        name: 'ViewTract',
        params: {
          tract: this.language.file,
        },
      })

    },
  },
})
</script>
<style scoped>

.title{
  font-size: 1em;
  margin-left:10px;
}
div.tract-link{
  display:block;
  width:100%;
  margin-left:10px;
}
.shadow-card {
  background-color: #f9e398;
  background-color: lightgrey;
  cursor: pointer;
  margin-top: 6px;
  padding: 5px;
  text-align: left;
  transition: all 0.2s linear;
  width: 100%;
}
.app-card:hover {
  transform: scale(1.05);
  box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.2), 0 1px 15px 0 rgba(0, 0, 0, 0.19);
}

.app-link {
  color: black;
  text-decoration: none;
  font-weight: 100;
}
div.book {
  vertical-align: top;
  width: 70%;
  font-size: 12px;
  float: right;
}
.book {
  text-align: left;
}
</style>
