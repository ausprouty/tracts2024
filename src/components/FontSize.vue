<template>
  <div>
    <q-btn
      flat
      dense
      round
      icon="text_increase"
      aria-label="Increase"
      v-on:click="increaseFontSize"
    />
    <q-btn
      flat
      dense
      round
      icon="text_decrease"
      aria-label="Decrease"
      v-on:click="decreaseFontSize"
    />
  </div>
</template>

<script>
import { getCssVar, setCssVar } from 'quasar'
export default {
  // name: 'ComponentName',
  setup() {
    return {};
  },
  methods:{
    increaseFontSize(){
      var fontSize = this.getCurrentFontSize() + 1
      this.setFontSize(fontSize)
    },
    decreaseFontSize(){
      var fontSize = this.getCurrentFontSize() - 1
      this.setFontSize(fontSize)
    },
    getCurrentFontSize(){
      var currentFontString = getCssVar('theme-font-size')
      currentFontString.replace('px', '');
      return parseInt(currentFontString)

    },
    setFontSize(fontSize){
      console.log (fontSize)
      setCssVar('theme-font-size', fontSize + 'px')
    }

  }
};
</script>
