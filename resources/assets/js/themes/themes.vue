<style lang="scss">
@import "~gmf/components/MdLayout/mixins";
@import "./default";
@import "./dark";
body {
  height: 100%;
  min-height: 100%;
  max-height: 100%;
  position: relative;
}

html {
  
}

@include md-layout-small {
  body {
    moz-user-select: -moz-none;
    -moz-user-select: none;
    -o-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
}
</style>