<template>
  <div>
    <h2>Files in Public Directory</h2>
    <ul>
      <li v-for="file in files" :key="file">{{ file }}</li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      files: [],
    };
  },
  created() {
    this.getFilesIndex();
  },
  methods: {
    async getFilesIndex() {
      try {
        const response = await axios.get(
          "https://tracts.mylanguage.net.au/php/tractFileList.php"
        );
        if (response.data) {
          this.files = response.data
          //this.downloadFilesToCache(response.data)
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
