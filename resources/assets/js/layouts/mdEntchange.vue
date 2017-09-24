<template>
  <div></div>
</template>
<script>
export default {
  props: {},
  methods: {
    goForce() {
      this.$router.push({ name: 'module', params: { module: 'dashboard' } });
    }
  },
  created() {

  },
  mounted() {
    this.goForce();
  },
};
</script>