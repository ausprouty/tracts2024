<template>
  <q-page padding>
   <p>{{tract}}</p>
    <!-- content -->
  </q-page>
</template>

<script>
export default {
  name: 'ViewTract',
  props: {
    tract: String,
  },
  created(){
    console.log (this.tract)
  }
}
</script>
