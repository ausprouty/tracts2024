import { defineStore } from 'pinia';

export const useTractStore = defineStore('tractStore', {
  state: () => ({
    tractFontSize: 14,
  }),
  getters: {
    getTractFontSizeInt: (state) => state.tractFontSize,
    getTractFontSizePx: (state) => state.tractFontSize + 'px',
  },
  actions: {
    updateTractFontSize(newValue) {
      // Extract only the integer component
      const intValue = parseInt(newValue);
      this.tractFontSize = intValue;
    },
  },
});
