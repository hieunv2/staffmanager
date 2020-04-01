<template>
  <div id="app">
    <transition :duration="300" name="fade-transform" mode="out-in">
      <router-view/>
    </transition>
  </div>
</template>

<script>
export default{
  name: 'App'
}
</script>
