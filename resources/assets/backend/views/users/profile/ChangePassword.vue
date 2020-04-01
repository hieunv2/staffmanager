<template>
  <div class="createPost-container">
    <ElForm ref="postForm" :model="model" class="form-container" autocomplete="off">
      <input autocomplete="off" name="hidden-pass" type="password" style="position:absolute; top:-100px">
      <input autocomplete="off" name="hidden-name" type="text" style="position:absolute; top:-100px">
      <ElFormItem prop="current_password" :error="errors.current_password">
        <label>{{ $t('users.current_password') }}</label>
        <ElInput v-model="model.current_password" />
      </ElFormItem>
      <ElFormItem prop="password" :error="errors.password">
        <label>{{ $t('users.new_password') }}</label>
        <ElInput v-model="model.password" type="password" />
      </ElFormItem>
      <ElFormItem prop="password_confirmation" :error="errors.password_confirmation">
        <label>{{ $t('users.password_confirmation') }}</label>
        <ElInput v-model="model.password_confirmation" type="password" />
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
      updateApi: Function,
      errors: {},
      roles: []
    }
  },
  created() {
    this.updateApi = api.edit
  },
  methods: {
    updateUser() {
      this.loading = true
			api.changePassword(this.model).then(response => {
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
