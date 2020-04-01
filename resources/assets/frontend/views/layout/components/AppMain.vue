<template>
  <div style="position: relative">
    <section class="app-main">
      <transition name="fade-transform" mode="out-in">
        <keep-alive :include="cachedViews">
          <router-view v-if="!noContainer" :key="key" class="container"/>
          <router-view v-if="noContainer" :key="key"/>
        </keep-alive>
      </transition>
    </section>
  </div>
</template>

<script>

export default {
  name: 'AppMain',
  computed: {
    cachedViews() {
      return this.$store.state.tagsView.cachedViews
    },
    key() {
      return this.$route.fullPath
    },
    noContainer() {
      return (this.$route.meta && this.$route.meta.noContainer)
    }
  }
}
</script>

<style scoped>
.app-main {
  overflow: auto;
  width: 100%;
  position: relative;
  z-index: 2;
  min-height: calc(100vh - 215px);
}
.fill-dimensions {
  top: 0;
  left: 0;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  display: block;
  backface-visibility: hidden;
}
.bg-pos-left {
  background-position: top left;
  background-repeat: no-repeat;
}
.bg-pos-right {
  background-position: top right;
  background-repeat: no-repeat;
}
.about-section-left-img {
  height: 560px;
  width: calc((100% - 735px)/2);
  top: 0;
  left: 0;
  opacity: .2;
  position: absolute;
}
.about-section-right-img {
  height: 560px;
  width: calc((100% - 735px)/4);
  opacity: .2;
  right: 0;
  bottom: 0;
  position: absolute;

}
</style>

