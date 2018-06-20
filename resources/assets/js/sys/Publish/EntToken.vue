<template>
  <form novalidate @submit.prevent="validateForm">
    <md-card>
      <md-card-header>
        <div class="md-title">企业密钥</div>
      </md-card-header>
      <md-card-content>
        <span>企业密钥，是移动应用，外部服务访问企业数据的授权口令!</span>
        <span>重新生成建议重新发布企业!</span>
      </md-card-content>
      <md-card-content>
        <md-field>
          <label>企业密钥</label>
          <md-input v-model="mainData.token" type="password"></md-input>
        </md-field>
      </md-card-content>
      <md-card-actions>
        <md-button type="submit" class="md-accent md-raised">重新生成企业密钥</md-button>
      </md-card-actions>
    </md-card>
  </form>
</template>
<script>
export default {
  name: "SysPublishEntToken",
  data() {
    return {
      mainData: {
        token: ""
      }
    };
  },
  methods: {
    getToken() {
      this.$http.get("sys/ents/token").then(
        res => {
          this.mainData.token = res.data.data;
        },
        err => {
          this.$toast(err);
        }
      );
    },
    postFormData() {
      this.$tip.waiting("正在生成口令...");
      this.$http.post("sys/ents/token").then(
        res => {
          this.mainData.token = res.data.data;
          this.$tip.clear();
          this.$toast("发布成功");
        },
        err => {
          this.$toast(err);
        }
      );
    },
    validateForm() {
      this.postFormData();
    }
  },
  mounted() {
    this.getToken();
  }
};
</script>
<style scoped>
form {
  max-width: 600px;
  margin: 10px auto;
}
</style>