<template>
  <NavigationBackground/>
  <div class="storage-container">
    <h2>LocalStorage Contents</h2>
    <div v-if="Object.keys(storageItems).length">
      <div v-for="(value, key) in storageItems" :key="key" class="storage-item">
        <strong>{{ key }}:</strong> {{ value }}
      </div>
    </div>
    <div v-else>
      <p>No items in LocalStorage.</p>
    </div>
  </div>
</template>

<script>
import NavigationBackground from "components/NavigationBackground.vue";
export default {
  name: "DebugLocalStorage",
  components: { NavigationBackground },
  data() {
    return {
      storageItems: {}
    };
  },
  created() {
    this.loadStorage();
  },
  methods: {
    loadStorage() {
      let items = {};
      for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        items[key] = localStorage.getItem(key);
      }
      this.storageItems = items;
    }
  }
};
</script>

<style scoped>
.storage-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  background-color: #f9f9f9;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.storage-item {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.storage-item:last-child {
  border-bottom: none;
}

strong {
  color: #333;
}
</style>
