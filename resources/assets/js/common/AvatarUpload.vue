<template>
  <div class="avatar-box">
    <div class="avatar-item" @click="openAvatarPicker" :disabled="disabled">
      <md-image :md-src="playUrl" />
      <md-progress-spinner v-if="loading" class="md-accent" :md-stroke="3" md-mode="indeterminate"></md-progress-spinner>
    </div>
    <div class="avatar-upload">
      <md-button class="md-primary" :disabled="disabled||loading" @click="openAvatarPicker">用户头像</md-button>
      <input type="file" accept="image/*" @change="onAvatarSelected" ref="avatarInput" style="display:none;">
    </div>
  </div>
</template>
<script>
  import compressImage from "gmf/core/utils/MdCompressImage";
  export default {
    name: "CboAvatarUpload",
    props: {
      value: {
        type: [String]
      },
      userId: String,
      disabled: Boolean
    },
    data() {
      return {
        loading: false,
        playUrl: this.setPlayUrl(this.value)
      };
    },
    watch: {
      value() {
        this.setPlayUrl(this.value);
      }
    },
    methods: {
      setPlayUrl(id) {
        this.playUrl = "/api/sys/images/" + (id ? id : 0) + "?c=ddd";
      },
      openAvatarPicker() {
        if (this.disabled) return;
        this.$refs.avatarInput.value = "";
        this.$refs.avatarInput.click();
      },
      onAvatarSelected($event) {
        if (this.disabled) return;
        const files = $event.target.files || $event.dataTransfer.files;
        if (!files || files.length == 0) {
          return;
        }
        const formData = new FormData();
        formData.append("files", files[0], files[0].name);
        if (this.userId) {
          formData.append("path", "avatar/" + this.userId);
        } else {
          formData.append("path", "avatar");
        }
        let config = {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        };
        this.loading = true;
        this.$http
          .post("sys/files", formData, config)
          .then(res => {
            if (res.data.data) {
              this.setPlayUrl(res.data.data[0].id);
              this.$emit("input", res.data.data[0].id);
            }
            this.loading = false;
          })
          .catch(err => {
            this.$toast(err);
            this.loading = false;
          });
      }
    }
  };
</script>
<style lang="scss" scoped>
  .md-progress-spinner {
    position: absolute;
    top: 0px;
    left: 0px;
  }

  .avatar-box {
    padding: 0px;
  }

  .avatar-item {
    width: 84px;
    height: 84px;
    background: #ddd;
    border-radius: 5px;
    overflow: hidden;
    cursor: pointer;
    position: relative;

    &[disabled] {
      cursor: not-allowed;
      pointer-events: none;
    }
  }

  .avatar-upload {
    .md-button {
      min-width: auto;
      margin: 0px;
      width: 100%;
    }
  }
</style>