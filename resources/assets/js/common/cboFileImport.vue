<template>
  <div class="md-file md-file-import layout layout-row layout-align-start-start layout-wrap">
    <md-menu md-size="1">
      <div class="md-button md-theme-default" md-menu-trigger><slot><md-button>导入</md-button></slot></div>
      <md-menu-content>
        <md-menu-item @selected="openPicker">导入文件</md-menu-item>
        <md-menu-item v-if="template" @selected="onDownTemplateFile">下载模板</md-menu-item>
      </md-menu-content>
    </md-menu>
    <input
      type="file"
      :id="id"
      :name="name"
      :disabled="disabled"
      :multiple="multiple"
      :accept="accept"
      @change="onFileSelected"
      ref="fileInput"/>
  </div>
</template>
<script>
  import common from '../../gmf-sys/core/utils/common';
  export default {
    name: 'md-file-import',
    props: {
      value: [String,Object,Array],
      id: String,
      name: String,
      disabled: Boolean,
      required: Boolean,
      placeholder: String,
      accept: {
        type:String,
        default:'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      },
      multiple: Boolean,
      maxSize: {
        type: Number,
        //100 * 1024表示100kb
        default: 100 * 1024
      },
      template:String
    },
    data() {
      return {
        files:[]
      };
    },
    watch: {
      value(v) {
        if (common.isArray(v)) {
          this.files=v;
        } else {
          this.files =[];
          v&&this.files.push(v);
        }
      }
    },
    computed: {
    },
    methods: {
      openPicker() {
        if (!this.disabled) {
          this.resetFile();
          this.$refs.fileInput.click();
        }
      },
      onDownTemplateFile(){
        window.open(this.template);
      },
      async onFileImport(file){
        this.$emit('import',file);
      },
      onFileToData(file){
        if(!file)return;
        const reader = new window.FileReader();
        reader.onload = (e)=> {
          file.base64= e.target.result;
          this.files.push(file);
          this.setInputValue();
          this.onFileImport(file);
        }
        reader.readAsDataURL(file.file);
      },
      resetFile() {
        this.$refs.fileInput.value = '';
      },
      setInputValue(){
        if(this.multiple){
          this.$emit('input',this.files);
        }else if(this.files.length>0){
          this.$emit('input',this.files[0]);
        }else{
          this.$emit('input',null);
        }
      },
      onFileSelected($event) {
        const files = $event.target.files || $event.dataTransfer.files;
        if (files) {
          for (var i = 0; i < files.length; i++) {
            let file=files[i];
            let fileInfo={file:file,name:file.name,size:file.size,type:file.type};            
            fileInfo.ext=file.name.substr(file.name.lastIndexOf(".")+1); 
            this.onFileToData(fileInfo);
          }
        }
      }
    },
    mounted() {
    },
    beforeDestroy() {
    }
  };
</script>