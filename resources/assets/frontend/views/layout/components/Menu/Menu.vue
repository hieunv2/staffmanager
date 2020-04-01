<template>
  <Sticky class="main-menu">
    <ElMenu :show-timeout="200" :default-active="activeLink" :router="true" mode="horizontal">
      <ElRow class="container">
        <ElCol id="logo" :span="6">
          <router-link id="home-button" to="/">
            <img id="bcon-logo" >
            <div>Home page</div>
          </router-link>
        </ElCol>
        <ElCol :span="18">
          <ElRow>
            <MenuItem
              v-for="menu in menus"
              :key="menu.path"
              :menu="menu"
            />
          </ElRow>
        </ElCol>
      </ElRow>
    </ElMenu>
  </Sticky>
</template>

<script>
import Sticky from '@/frontend/components/Sticky/index'
import MenuItem from './MenuItem'

export default {
  name: 'Menu',
  components: { MenuItem, Sticky },
  data() {
    return {
      menus: [
        { title: 'Who we partner with', path: '/partner/' },
        { title: 'What we achieve', path: '/achieve/', children: [
          { title: 'OUR ACHIEVEMENT', path: '/achieve#achieve' },
          { title: 'WHAT OUR CUSTOMERS SAY', path: '/achieve#customer-say' }
        ]
        },
        {
          title: 'What we do', path: '/what/', children: [
            { title: 'FOR INDIVIDUALS', path: '/what/individual', children: [
              { title: 'Life Orientations &reg;', path: '/what/individual/life' },
              { title: 'Innovative Thinking System &trade;', path: '/what/individual/thinking' },
              { title: 'The Human Element &reg;', path: '/what/individual/human' }
            ]
            },
            {
              title: 'FOR ORGANIZATIONS', path: '/what/organization', children: [
                { title: 'Our Process', path: '/what/organization#process' },
                { title: 'Our Solution', path: '/what/organization#solution' }
              ]
            }
          ]
        },
        { title: 'WHO WE ARE', path: '/who/', children: [
          { title: 'COMPANY TIMELINE', path: '/who/' },
          { title: 'GLOBAL REACH', path: '/who#global-reach' }
        ]
        }
      ],
      activeLink: null,
      search: '',
      selectLang: false
    }
  },
  computed: {
    lang() {
      return this.$store.getters.language
    }
  },
  mounted() {
    const match = window._.chain(this.$route.matched).sortBy(n => n.path.length).last().value()
    this.activeLink = match.path
  },
  methods: {
    handleSetLanguage(lang) {
      this.$i18n.locale = lang
      this.$store.dispatch('setLanguage', lang)
      this.selectLang = false
      // this.$message({
      //   message: 'Switch Language Success',
      //   type: 'success'
      // })
    }
  }
}
</script>

<style lang="scss">
  @import "@/frontend/styles/mixin.scss";
  @import "@/frontend/styles/variables.scss";

  .main-menu {
    .container {
      width: 1200px;
      >.el-col-18 {
        width: calc(100% - 200px);
      }
    }
    #logo {
      width: 200px;
      div {
        font-size: 12px;
        text-transform: initial;
        text-align: center;
        font-style: italic;
        color: #333;
      }
    }
    #bcon-logo {
      width: 120px;
      height: 50px;
      margin: 0 auto;
      display: block;
      object-fit: initial;
    }
    .main-menu .container {
      padding: 0 30px;
      font-size: 14px;
    }
    .el-menu {
      background: white;
      border-bottom: 1px solid $basicBlue;
      text-transform: uppercase;
      padding-top: 10px;
    }

    .container > .el-menu-item {
      float: right;
    }
    .el-menu--popup .el-submenu {
      float: left;
      font-size: 12px;
    }

    .el-menu--horizontal {
      .el-menu {
        background: #3b91b6 !important;
      }
    }
  }
  .el-menu--popup .el-submenu{
    float: none;
    i.el-submenu__icon-arrow {
      display: none;
    }
  }
  .el-menu-item{
    color: $basicBlue !important;
    &:hover {
      background: $basicBlue;
      &#home-button {
        background: transparent;
      }
    }
    &#home-button {
      float: left;
    }

    .el-submenu {
      float: left;
    }
  }

  .el-submenu__title {
    color: $basicBlue;
    i.el-submenu__icon-arrow {
      display: none;
    }
    &:hover {
      background: $basicBlue;
      color: #fff;
    }
  }
  .el-menu-item, .el-submenu, .el-submenu__title {
    &:hover {
      background: $basicBlue;
      color: #fff !important;
      > a, > span {
        @include underline($golden);
      }
    }
    &:focus, &:active {
      background: $basicBlue;
      color: #fff !important;
      > a, > span {
        @include underline($golden);
      }
    }
    >a, >span {
      &.router-link-active {
        @include underline($golden);
      }
    }
    .el-menu-item {
      &:hover {
        > a, > span {
          @include underline($basicBlue);
        }
      }
      &:focus, &:active {
        > a, > span {
          @include underline($basicBlue);
        }
      }
    }
  }
  .el-submenu{
    padding: 0;
  }
  .el-menu-item, .el-submenu__title{
    padding: 0 20px;
    height: 50px;
    line-height: 48px;
  }
  .el-menu--horizontal .el-menu .el-submenu__title {
    color: $basicBlue;
  }
  .el-menu--popup {
    padding: 0;
    .el-menu-item, .el-submenu__title{
      padding: 0 20px!important;
    }
    .el-menu-item, .el-submenu, .el-submenu__title {
      color: $basicBlue;
      background: $lightBlue !important;
      border-bottom: 1px solid $basicBlue;
      font-size: 12px;
      &:last-child {
        border-bottom: none;
      }
      &:hover {
        color: $basicBlue!important;
        >a {
          @include underline($basicBlue);
        }
      }
      &:hover {
        > a, > span {
          @include underline($basicBlue);
        }
      }
      &:focus, &:active {
        > a, > span {
          @include underline($basicBlue);
        }
      }
    }
    &:hover {
      >a {
        color: $basicBlue;
        @include underline($basicBlue);
      }
    }
  }
  #search-bar {
    float: right;
    margin-bottom: 5px;
    #select-lang {
      font-size: 12px;
      display: inline-block;
      span {
        cursor: pointer;
        text-decoration: underline;
        margin: 0 1px;
      }
      &:before {
        content: "\25c0";
        font-size: 10px;
        text-decoration: initial;
      }
      &.selecting{
        &:before {
          content: "\25BA";
        }
      }
    }
    .el-input {
      border-radius: 10px;
      width: 200px;
      input{
        background: #e6eef9;
        padding-left: 5px;
        color: $blue;
        height: 20px;
        font-size: 8px;
        &::placeholder {
          font-style: italic;
          color: $blue;
        }
      }
      .el-input__icon {
        line-height: 20px;
        color: $basicBlue;
      }
    }
  }
</style>
