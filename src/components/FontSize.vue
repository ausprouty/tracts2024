<template>
  <div>
    <q-btn
     class="q-mr-md"
      flat
      dense
      round
      icon="text_increase"
      aria-label="Increase"
      v-on:click="increaseFontSize"
    />
    <q-btn
    class="q-mr-md"
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
   name: 'FontSize',
  setup() {
    return {};
  },
  data() {
    return {
      fontSize:10,
    };
  },
  methods:{
    increaseFontSize(){
      this.fontSize = this.getCurrentFontSize() + 1
      this.setFontSize(this.fontSize)
    },
    decreaseFontSize(){
      this.fontSize = this.getCurrentFontSize() - 1
      if (this.fontSize > 4){
        this.setFontSize(this.fontSize)
      }

    },
    getCurrentFontSize(){
      var currentFontString = getCssVar('theme-font-size')
      currentFontString.replace('px', '');
      return parseInt(currentFontString)

    },
    setFontSize(fontSize){
      var fontString = fontSize + 'px'
      localStorage.setItem('tractFontSize',fontString )
      setCssVar('theme-font-size', fontString )
    }

  }
};
</script>

