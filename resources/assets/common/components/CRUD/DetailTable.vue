<template>
  <div v-cloak class="content">
    <div v-if="data" class="el-table el-table--fit el-table--border el-table--striped el-table--enable-row-hover el-table--enable-row-transition">
      <table class="el-table detail-table">
        <tbody class="el-table__body">
          <tr v-for="(row, key) in rows" v-if="!row.showIf || row.showIf(data[row.field])" :key="row" class="el-table__row" :class="{'el-table__row--striped': key%2}">
            <td style="width: 200px;">
              <label>{{ getLabel(row) }}</label>
            </td>
            <td><p>{{ getValue(data, row) }}</p></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else class="loading-icon">
      <i class="el-icon-loading" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailTable',
  props: {
    api: {
      type: Function,
      default: null
    },
    id: {
      type: Number,
      default: 0
    },
    table: {
      type: String,
      required: true
    },
    fields: {
    	type: Array,
      default: null
    },
    inputData: {
      type: Object,
      default: null
    },
    modelName: {
    	type: String,
      default: 'model'
    }
  },
  data() {
  	return {
  		data: null
    }
  },
  computed: {
    rows() {
    	return this.fields || Object.entries(this.data).map(([key]) => ({ field: key }))
    }
  },
  watch: {
    inputData: function(newInputData) {
      this.data = this.inputData
      this.$parent[this.modelName] = this.inputData
    }
  },
  created() {
    if (this.inputData) {
      this.data = this.inputData
      this.$parent[this.modelName] = this.inputData
    } else {
      const id = this.id || (this.$route.params && this.$route.params.id)
      this.fetchData(id)
    }
  },
  methods: {
    fetchData(id) {
      this.api({ id }).then(response => {
        this.$parent[this.modelName] = this.data = response.data
      }).catch(err => {
        console.log(err)
      })
    },
		 getValue(obj, row) {
      const value = this.getObjectValue(obj, row.field)
			 if (row.format) {
				 if (typeof (row.format) === 'function') {
					 return row.format(value)
				 }

				 const args = row.format.split('|')
				 const func = args.shift()

				 if (typeof this.$parent[func] === 'function') {
					 return (args.length > 0)
						 ? this.$parent[func].apply(this.$parent, [value].concat(args))
						 : this.$parent[func].call(this.$parent, value)
				 }
			 }
			 return value
    },
    getObjectValue(object, path, defaultValue, replace) {
      defaultValue = (typeof defaultValue === 'undefined') ? null : defaultValue
      let obj = object
      if (path && path.trim() !== '') {
        const keys = path.split('.')
        keys.forEach(function(key) {
          if (obj !== null && typeof obj[key] !== 'undefined' && obj[key] !== null) {
            const temp = obj[key]
            if (replace !== undefined && typeof replace[temp] !== 'undefined' && replace[temp] !== null) {
              obj = replace[temp]
            } else {
              obj = temp
              return
            }
          } else {
            obj = defaultValue
            return
          }
        })
      }
      return obj
    },
    getLabel(row) {
    	return row.title || this.$t(this.table + '.' + (row.name || row.field))
    }
  }
}
</script>
<style lang="scss">
  .detail-table {
    p {
      word-wrap: break-word;
      max-width: 1000px;
      margin: 0;
    }
  }
  .content {
    margin: 20px 0;
  }
	.loading-icon {
		margin-left: auto;
		margin-right: auto;
		margin-bottom: 30px;
		width: 100px;
		.el-icon-loading {
			font-size: 40px;
		}
	}

</style>
