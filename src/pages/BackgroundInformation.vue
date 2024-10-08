<template>
  <q-page padding>
    <NavigationBackground />
    <h3 class="background">Adding this App to your Device</h3>
    <h4>Android Users</h4>
    <p>
      You should have seen a screen like the one below. If you did not press
      'INSTALL' the first time you saw this screen,
      <a href="#" @click="allowInstall">click here</a> and you will have another
      opportunity in a few minutes.
    </p>
    <p>
      <img src="/images/AndroidInstall.png" class="installImage" />
    </p>
    <h4>iOS Users</h4>
    <p>
      You should have seen a screen like the one below. You can install this app
      anytime by following these instructions
    </p>
    <p><img src="/images/iOSInstall.png" class="installImage" /></p>
    <h3 class="background">Quick Start</h3>
    <ul>
      <li class="background">
        Type the first few letters of the language you want in the search bar
        (on some phones you may need to press 'Enter' before you see any
        results)
      </li>
      <li class="background">Click on language name</li>
      <li class="background">
        English text will appear on the left. Your chosen language will appear
        on the right
      </li>
      <li class="background">
        <b>Turn your phone to the side for easier reading</b>
      </li>
      <li class="background">Ask your friend to stand on your right side</li>
      <li class="background">Take turns reading -- using both languages</li>
      <li class="background">Ask questions and listen</li>
      <li class="background">
        Give your friend the opportunity to ask Christ into his life
      </li>
      <li class="background">Find ways to keep in touch later.</li>
    </ul>
    <h3 class="background">Font Size</h3>
    <p>This feature does not work on all phones.</p>

    <h3 class="background">Background</h3>
    <p class="background">
      These culturally sensitive bi-lingual Gospel outlines are all based on the
      <i>Four Spiritual Laws</i> by Bill Bright.
    </p>
    <p class="background">
      Each outline was reviewed by a local ministry of Campus Crusade for Christ
      where the language is widely spoken. Many have modified the American
      outline to more clearly communicate the truth of the Gospel to their local
      culture. We have now back-translated their work into English, preserving
      the cultural adaptations that the outline has already gone through. This
      gives you the correct logic, relevant issues, and appropriate Bible verses
      for each language group.
    </p>
    <p class="background">
      Each outline now finishes with links to websites with further information
      about Jesus in their language. The link to mylanguage.net.au will bring
      them in touch with internet evangelists who are ready to answer their
      questions in their heart language.
    </p>
    <h3 class="background">Printed Copies</h3>
    <p class="background">
      You can make printed copies of this outline by visiting
      <a href="http://hereslife.com">hereslife.com</a>
    </p>
    <h3 class="background">Can't Find It</h3>
    <p class="background">
      Missing a language you need?
      <a href="mailto:bob@hereslife.com">Please let us know.</a>
    </p>
    <br />
    <button class="button" @click="goToDebugPage">Debug LocalStorage</button><br /><br />
    <p>
      © 1985 - 2024 <a href="http://hereslife.com">Here's Life</a> and
      <a href="http://powertochange.org.au">Power to Change</a> (formerly Campus
      Crusade for Christ Australia) A.C.N 002 310 796
    </p>
    <br /><br /><br />
  </q-page>
</template>

<script>
import NavigationBackground from "components/NavigationBackground.vue";
export default {
  name: "BackgroundInformation",
  components: { NavigationBackground },
  methods:{
      // show the debug page
    goToDebugPage() {
      this.$router.push({ name: 'DebugLocalStorage' });
    },
    // give person another opportunity to install
    allowInstall() {
      localStorage.clear();
      this.$router.push({
        name: "Index",
      });
    },
  },
};
</script>
<style scoped>
.installImage {
  width: 100%;
  max-width: 400px;
}
h3 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #005c86;
  line-height: 1.5rem;
}
h4 {
  font-size: 1rem;
  font-weight: bold;
  color: black;
  line-height: 1.5rem;
}
.q-page {
  margin-left: 10px;
}
.button {
  padding: 10px 20px;
  background-color: #dc3545;
  color: white;
  border: none;
  border-radius: 50px;
  font-size: 16px;
  font-weight: bold;
  text-transform: uppercase;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.button:hover {
  background-color: #c82333;
  transform: translateY(-2px);
}

.button:active {
  background-color: #bd2130;
  transform: translateY(0);
}

.button:focus {
  outline: none;
  box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.4);
}


</style>
