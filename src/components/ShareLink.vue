<template>
<meta property="og:title" content="Finding a Guru worth Following">
<meta property="og:description" content="In order to make any real progress in our spiritual life we know we need a guru.">
<meta property="og:image" content="https://myfriends.network/sites/myfriends/images/standard/MyFriends-App-Facebook.jpg">
<meta property="og:url" content="https://guru.mmylanguage.net.au">
<meta property="og:type" content="website">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@PtCAus">
<meta name="twitter:title" content="Finding a Guru worth Following">
<meta name="twitter:description" content="In order to make any real progress in our spiritual life we know we need a guru">
<meta name="twitter:image" content="https://myfriends.network/sites/myfriends/images/standard/MyFriends-App-Twitter.jpg">


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
      var subject = 'Bi-lingual 4SL+'
      var message = 'Here is the link'
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
