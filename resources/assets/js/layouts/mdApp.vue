<template>
  <div class="md-app layout-fill layout-column">
    <app-menu ref="menu" :md-token="mdToken" :md-title="mdTitle"></app-menu>
    <app-toolbar ref="toolbar" @toggle="toggle" :md-token="mdToken" :md-title="mdTitle"></app-toolbar>
    <app-content :md-token="mdToken" :md-title="mdTitle"></app-content>
    <app-footer :md-token="mdToken" :md-title="mdTitle"></app-footer>
  </div>
</template>
<script>
  export default {
    props: {
      mdToken: String,
      mdTitle: String
    },
    computed: {
    },
    methods: {
      toggle() {
        this.$refs.menu.toggle();
      }
    },
    mounted(){
      
    }
  };
</script>
