<template>
  <ElMenuItem v-if="!menu.children" :key="menu.path" :index="menu.path">
    <span v-html="menu.title" />
  </ElMenuItem>
  <ElSubmenu v-else ref="submenu" :key="menu.path" :index="menu.path">
    <template slot="title">
      <router-link :to="menu.path" v-html="menu.title" />
    </template>
    <MenuItem
      v-for="child in menu.children"
      :key="child.path"
      :menu="child"
    />
  </ElSubmenu>
</template>

<script>
export default {
  name: 'MenuItem',
  props: {
    // route object
    menu: {
      type: Object,
      required: true
    }
  }
}
</script>
<style scoped lang="scss">
  @import "@/frontend/styles/mixin.scss";
  @import "@/frontend/styles/variables.scss";
  #bcon-logo {
    width: auto;
    height: 100%;
    object-fit: contain;
    padding: 5px;
  }
  .el-menu {
    background: transparent;
    border: none;
  }
  .el-menu-item, .el-submenu {
    float:right;
    color: #fff;
    .el-submenu {
      &:hover {
        background: #409EFF;
        color: #fff!important;
      }
    }
  }
  .main-menu .container {
    padding: 0 30px;
    font-size: 14px;
  }
</style>
