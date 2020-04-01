<template>
  <div class="createPost-container">
    <ElForm ref="postForm" :model="model" class="form-container" autocomplete="off">
      <input autocomplete="off" name="hidden-pass" type="password" style="position:absolute; top:-100px">
      <input autocomplete="off" name="hidden-name" type="text" style="position:absolute; top:-100px">
      <ElFormItem prop="username" :error="errors.username">
        <label>{{ $t('users.username') }}</label>
        <ElInput v-model="model.username" />
      </ElFormItem>
      <ElFormItem prop="full_name" :error="errors.full_name">
        <label>{{ $t('users.full_name') }}</label>
        <ElInput v-model="model.full_name" />
      </ElFormItem>
      <ElFormItem prop="email" :error="errors.email">
        <label>{{ $t('users.email') }}</label>
        <ElInput v-model="model.email" />
      </ElFormItem>
      <ElFormItem prop="phone" :error="errors.phone" :label="$t('users.phone')">
        <ElInput v-model="model.phone" />
      </ElFormItem>
      <ElFormItem prop="address" :error="errors.address" :label="$t('users.address')">
        <ElInput v-model="model.address" />
      </ElFormItem>
      <ElButton type="primary" @click="updateUser">
        {{ $t('users.update') }}
      </ElButton>
    </ElForm>
  </div>
</template>

<script>

import api from '../../../api/userApi'

const defaultForm = {
  id: undefined,
  name: '',
  full_name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: {}
}

export default {
  name: 'ProfileEdit',
  data() {
    return {
      model: Object.assign({}, defaultForm),
      loading: false,
      errors: {},
      roles: []
    }
  },
  created() {
    this.fetchData()
  },
  methods: {
    fetchData() {
      api.profile().then(response => {
        this.model = response.data
        this.model.role = this.model.role || {}
      }).catch(err => {
        console.log(err)
      })
    },
    updateUser() {
      this.loading = true
      api.editProfile(this.model).then(response => {
        this.$router.push('/')
      }).catch(err => {
        if (err.response && err.response.data) {
          this.errors = err.response.data.errors
        }
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    @import "~@/backend/styles/mixin.scss";

    .createPost-container {
        position: relative;
        .postInfo-container {
            position: relative;
            @include clearfix;
            margin-bottom: 10px;

            .postInfo-container-item {
                float: left;
            }
        }
        .word-counter {
            width: 40px;
            position: absolute;
            right: -10px;
            top: 0;
        }
    }
</style>
