<template>
  <div class="custom-actions">
    <template v-if="!trashed">
      <router-link v-if="format.view" :to="{ path: String(rowData.id )}" append>
        <ElButton type="primary" icon="el-icon-view" circle size="mini" title="Xem chi tiết" />
      </router-link>
      <router-link v-if="format.edit" :to="{ path: String(rowData.id + '/edit')}" append>
        <ElButton type="primary" icon="el-icon-edit" circle size="mini" title="Chỉnh sửa" />
      </router-link>
      <ElButton v-if="$parent.$parent.deleteApi && format.delete" type="danger" icon="el-icon-delete" circle size="mini" title="Xóa" @click="handleDelete()" />
    </template>
    <template v-else>
      <ElButton type="primary" icon="el-icon-refresh" circle size="mini" title="Khôi phục lại" @click="handleDelete('restore')" />
      <ElButton v-if="$parent.$parent.deleteApi && format.delete" type="danger" icon="el-icon-close" circle size="mini" title="Xóa khỏi hệ thống" @click="handleDelete('force')" />
    </template>
  </div>
</template>

<script>
export default {
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number,
      default: 0
    },
    format: {
      type: Object,
      default: () => {
        return {
          view: true,
          edit: true,
          delete: true
        }
      }
    }
  },
  computed: {
    trashed() {
    	return this.$parent.$parent.params?.only_trashed
    }
  },
  methods: {
    handleDelete(action = 'delete') {
    	console.log(action)
      if (action === 'restore') {
        this.$parent.$parent.restoreConfirm = { id: this.rowData.id, action }
      } else {
        this.$parent.$parent.deleteConfirm = { id: this.rowData.id, action }
      }
    }
  }
}
</script>
