<template>
  <div class="app-wrapper">
    <Menu />
    <AppMain />
    <Footer />
  </div>
</template>

<script>
import { AppMain, Menu, Footer } from './components'
import ResizeMixin from './mixin/ResizeHandler'

export default {
  name: 'Layout',
  components: {
    Menu,
    AppMain,
    Footer
  },
  mixins: [ResizeMixin]
}
</script>

<style rel="stylesheet/scss" lang="scss">
  @import "@/frontend/styles/mixin.scss";
  @import "@/frontend/styles/variables.scss";
  .app-wrapper {
    @include clearfix;
    position: relative;
    width: 100%;
    background-color: #fff;
    overflow: auto;
    &.mobile.openSidebar{
      position: fixed;
      top: 0;
    }
  }
  .drawer-bg {
    background: #000;
    opacity: 0.3;
    width: 100%;
    top: 0;
    height: 100%;
    position: absolute;
    z-index: 999;
  }

</style>
