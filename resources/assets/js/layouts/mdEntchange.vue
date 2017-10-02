<template>
  <div></div>
</template>
<script>
export default {
  props: {},
  methods: {
    goForce() {
      this.$router.replace({ name: 'module', params: { module: 'dashboard',refresh:true,standalone:true } });
    }
  },
  created() {

  },
  mounted() {
    this.goForce();
  },
};
</script>