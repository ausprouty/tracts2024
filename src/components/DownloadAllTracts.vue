<template>
  <div class="button-container" v-if="showDownload">
    <button @click="getFilesIndex" class="red-button">
      Download All Tracts
    </button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      showDownload: true
    };
  },
  created() {
    this.checkLocalStorage();
  },
  methods: {
    checkLocalStorage() {
      if (localStorage.getItem('DownloadTimestamp')) {
        this.showDownload = false;
      }
    },
    async getFilesIndex() {
      try {
        const response = await axios.get(
          "https://tracts.mylanguage.net.au/php/tractFileList.php"
        );
        if (response.data) {
          await this.downloadFilesToCache(response.data);
          // Create and store the current datestamp in localStorage
          const currentDate = new Date();
          const currentDatestamp = currentDate.toISOString(); // Format the date as ISO string
          localStorage.setItem("DownloadTimestamp", currentDatestamp);
          this.showDownload = false;
        }
      } catch (error) {
        console.error("Error fetching files:", error);
      }
    },
    async downloadFilesToCache(files) {
      const cacheName = "tracts-cache";
      // Open the cache
      const cache = await caches.open(cacheName);
      for (const file of files) {
        try {
          const response = await axios.get(
            "https://tracts.mylanguage.net.au/" + file,
            {
              responseType: "blob", // Ensure you get the data as a blob
            }
          );
          // Create a Response object to store in Cache Storage
          const blob = new Blob([response.data]);
          const cachedResponse = new Response(blob);

          // Add the response to the cache with the appropriate URL
          await cache.put(
            new Request("https://tracts.mylanguage.net.au/" + file),
            cachedResponse
          );
          console.log(`Successfully cached file ${file}`);
        } catch (error) {
          console.error(`Failed to download and cache file ${file}:`, error);
        }
      }
    },
  },
};
</script>
<style scoped>
.button-container {
  margin: 20px 0; /* Adds space above and below the div */
  display: flex; /* Use flexbox */
  justify-content: flex-start; /* Aligns the button to the left */
}

.red-button {
  background-color: #ff4d4d;
  border: none;
  border-radius: 5px;
  color: white;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
}

.red-button:hover {
  background-color: #ff3333;
  transform: scale(1.05);
}

.red-button:active {
  background-color: #e60000;
  transform: scale(0.95);
}
</style>
