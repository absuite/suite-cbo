<template>
  <md-svg-loader class="cbo-logo" :class="{ blending }" md-src="/assets/vendor/suite-cbo/svg/logo.svg" @md-loaded="svgLoaded" />
</template>
<script>
import MdSvgLoader from 'gmf/components/MdSvgLoader/MdSvgLoader'

export default {
  name: 'cboLogo',
  components: {
    MdSvgLoader
  },
  props: {
    animated: Boolean,
    blending: {
      type: Boolean,
      default: true
    }
  },
  methods: {
    svgLoaded() {
      if (this.animated) {
        const firstSquare = this.$el.querySelector('.first-square')
        const lastSquare = this.$el.querySelector('.last-square')

        firstSquare.setAttribute('transform', 'translate(48 0)')
        lastSquare.setAttribute('transform', 'translate(-48 0)')

        window.setTimeout(() => {
          firstSquare.setAttribute('transform', 'translate(0 0)')
          lastSquare.setAttribute('transform', 'translate(0 0)')
        }, 10)
      }
    }
  }
}
</script>
<style lang="scss">
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/theme/engine";

.cbo-logo {
  $hue1: red, blue, pink, indigo, amber;
  $hue2: lightgreen, yellow, cyan, purple, teal;
  $length: length($hue1);
  $factor: 100 / $length;
  $counter: 0;

  svg{
    height: 60px;
    width: 140px;
  }
  @keyframes first-cycle {
    @each $color,
    $item in $hue1 {
      #{$counter}% {
        fill: md-get-palette-color($color, A200);
      }

      $counter: $counter+$factor;
    }

    100% {
      fill: md-get-palette-color(orange, A200);
    }

    $counter: 0;
  }

  @keyframes last-cycle {
    @each $color,
    $item in $hue2 {
      #{$counter}% {
        fill: md-get-palette-color($color, A200);
      }

      $counter: $counter+$factor;
    }

    100% {
      fill: md-get-palette-color(lime, A200);
    }
  }

  &:hover {
    path {
      animation-play-state: running !important;
    }
  }

  $timer: $length * 1s;

  &.blending {
    svg {
      mix-blend-mode: overlay;
    }

    .last-square {
      mix-blend-mode: overlay;
    }

    .middle-square {
      display: none;
    }
  }

  $transition-square: .6s .5s $md-transition-stand-timing;

  .first-square {
    animation: $timer first-cycle linear infinite paused;
    transition: $transition-square;
  }

  .last-square {
    animation: $timer last-cycle linear infinite paused;
    transition: $transition-square;
  }
}
</style>