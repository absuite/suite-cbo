<style lang="scss">
  @import "~gmf/components/MdLayout/mixins";
  @import "./default";
  @import "./green";
  @import "./light-teal";
  body {
    height: 100%;
    min-height: 100%;
    max-height: 100%;
    position: relative;
    background-color: #f0f0f0!important;
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
