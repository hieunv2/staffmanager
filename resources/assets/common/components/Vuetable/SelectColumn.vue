<template>
  <div class="custom-actions">
    <ElButton type="success" icon="el-icon-check" circle size="mini" @click="handleSelect" />
  </div>
</template>

<script>
export default {
  name: 'SelectColumn',
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number,
      default: 0
    }
  },
  // created() {
  //   console.log(this.$props.format)
  // },
  methods: {
    handleSelect() {
      this.$parent.$parent.$emit('select', this.rowData)
    }

  }
}
</script>
