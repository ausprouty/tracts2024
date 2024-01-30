<template>
<meta property="og:title" content="Bi-lingual 4SL+">
<meta property="og:description" content="These bi-lingual outlines will facilitate conversations about God in over 80 languages.">
<meta property="og:image" content="https://tracts.mylanguage.net.au/images/phone.png">
<meta property="og:url" content="https://tracts.mylanguage.net.au">
<meta property="og:type" content="website">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@PtCAus">
<meta name="twitter:title" content="Bi-lingual 4SL+">
<meta name="twitter:description" content="These bi-lingual outlines will facilitate conversations about God in over 80 languages.">
<meta name="twitter:image" content="https://tracts.mylanguage.net.au/images/phone.png">


<q-btn class="shareLink"
flat
dense
round

@click="shareUrl"
icon="share"></q-btn>
</template>

<script>

export default {
  name: 'ShareLink',
  methods:{
    shareUrl() {
      var subject = 'Here is the link to the outline'
      var message = 'Here is the link to the outline we were looking at today.  Let\'s talk more!'
      let url = window.location.href
      if ('share' in navigator) {
        navigator.share({
          title: subject,
          text: message,
          url: url,
        })
      } else {
        var body = message + ': ' + url
        // Here we use the WhatsApp API as fallback; remember to encode your text for URI
        //location.href = 'mailto:?body=' + encodeURIComponent(text + ' - ') + location.href + ';subject=' + encodeURIComponent(title);
        location.href = getMailtoUrl('', subject, body)
      }

    },
  }
}
</script>
<style scoped>
.shareLink{
  padding-right: 40px;
}

</style>
