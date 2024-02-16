import { defineStore } from 'pinia';

export const useTractStore = defineStore('tractStore', {
  state: () => ({
    tractFontSize: 14,
  }),
  getters: {
    getTractFontSize: (state) => state.tractFontSize,
  },
  actions: {
    updateTractFontSize(newValue) {
      // Extract only the integer component
      const intValue = parseInt(newValue);
      this.tractFontSize = intValue;
    },
  },
});
