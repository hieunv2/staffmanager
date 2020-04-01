<template>
  <div class="list-component">
    <FilterBar :search-fields="searchFields" :has-button="hasButton" :default-params="defaultParams" :is-select="isSelect" @filter="appendParams" @handleExport="handleExport">
      <template v-slot:extraButton>
        <slot name="extraButton" />
      </template>
    </FilterBar>
    <div style="clear: both;" />
    <div class="loading-icon">
      <i class="el-icon-loading" />
    </div>
    <div v-show="!loading" style="width: 100%; overflow: auto">
      <Vuetable
        ref="vuetable"
        :per-page="perPage"
        :http-fetch="listApi"
        :data="data"
        :api-mode="!data.length"
        :fields="fields"
        :css="css.table"
        :append-params="params"
        pagination-path=""
        :multi-sort="true"
        @vuetable:pagination-data="onPaginationData"
        @vuetable:loading="loading = true"
        @vuetable:loaded="loaded"
      />

      <div class="vuetable-pagination">
        <Pagination v-if="pagination" :total="total" :page.sync="page" :per-page.sync="perPage" @pagination="onChangePagination" />
      </div>
    </div>
    <ElDialog
      :title="$t('table.warning')"
      :visible.sync="deleteConfirm"
      width="300"
    >
      <span>{{ $t('table.confirmDelete') }}</span>
      <span slot="footer" class="dialog-footer">
        <ElButton @click="deleteConfirm = false">{{ $t('table.cancel') }}</ElButton>
        <ElButton type="primary" @click="deleteRecord">{{ $t('table.confirm') }}</ElButton>
      </span>
    </ElDialog>

    <ElDialog
      :title="$t('table.warning')"
      :visible.sync="restoreConfirm"
      width="300"
    >
      <span>{{ $t('table.confirmRestore') }}</span>
      <span slot="footer" class="dialog-footer">
        <ElButton @click="restoreConfirm = false">{{ $t('table.cancel') }}</ElButton>
        <ElButton type="primary" @click="deleteRecord">{{ $t('table.confirm') }}</ElButton>
      </span>
    </ElDialog>
  </div>
</template>

<script>
import Vue from 'vue'
import Vuetable from '../Vuetable/Vuetable'
import FilterBar from './FilterBar'
import ActionColumn from '../Vuetable/ActionColumn'
import SelectColumn from '@/common/components/Vuetable/SelectColumn'
Vue.component('SelectColumn', SelectColumn)
Vue.component('action-column', ActionColumn)
import Pagination from '../Vuetable/Pagination' // secondary package based on el-pagination

export default {
  name: 'ListComponent',
  components: { Vuetable, FilterBar, Pagination },
  props: {
    listApi: {
      type: Function,
      required: false,
      default: null
    },
    data: {
      type: Array,
      required: false,
      default: () => []
    },
    deleteApi: {
      type: Function,
      default: null
    },
    fields: {
      type: Array,
      required: true
    },
    searchFields: {
      type: Array,
      default: null
    },
    hasButton: {
      type: Object,
      default: {
        create: true,
        export: true,
        recycleBin: true
      }
    },
    defaultParams: {
      type: Object,
      default: () => {}
    },
    isSelect: {
      type: Boolean,
      default: false
    },
    pagination: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      deleteConfirm: false,
      restoreConfirm: false,
      listLoading: true,
      params: this.defaultParams,
      listQuery: {},
      page: 1,
      perPage: 20,
      loading: false,
      css: {
        table: {
          tableClass: 'el-table el-table--fit el-table--border el-table--scrollable-x el-table--enable-row-hover el-table--enable-row-transition el-table--striped el-table--medium',
          ascendingIcon: 'el-icon-caret-top',
          descendingIcon: 'el-icon-caret-bottom'
        },
        pagination: {
          wrapperClass: 'pagination',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'page',
          linkClass: 'el-button_primary'
        },
        icons: {
          first: 'glyphicon glyphicon-step-backward',
          prev: 'glyphicon glyphicon-chevron-left',
          next: 'glyphicon glyphicon-chevron-right',
          last: 'glyphicon glyphicon-step-forward'
        }
      },
      listData: {},
      listHeader: {},
      filename: '',
      autoWidth: true,
      bookType: 'xlsx'
    }
  },
  created() {
    this.filename = this.generateTitle(this.$route.matched[1].meta.title)
  },
  methods: {
    onChangePage(page) {
      this.$refs.vuetable.changePage(page)
    },
    onChangePagination(params) {
      this.appendParams({ ...this.params, ...params })
    },
    onPaginationData(paginationData) {
      this.page = parseInt(paginationData.current_page || 0)
      this.perPage = parseInt(paginationData.per_page || 0)
      this.total = parseInt(paginationData.total || 0)
    },
    appendParams(params) {
      if (!params.page) {
        this.onChangePage(1)
      }
      this.params = params
      Vue.nextTick(this.$refs.vuetable.reload)
    },
    deleteRecord() {
      const { id, action } = this.deleteConfirm ? this.deleteConfirm : this.restoreConfirm
      this.deleteConfirm = false
      this.restoreConfirm = false
      if (this.deleteApi) {
        this.deleteApi({ id, action }).then((res) => {
          Vue.nextTick(this.$refs.vuetable.reload)
        })
      }
    },
    loaded() {
      this.loading = false

      var fieldExport = this.deepClone(this.fields)

      fieldExport.pop()
      var data = this.$refs.vuetable.tableData

      this.listHeader = fieldExport.map(i => {
        return i.title
      })

      this.listData = data.map(item => fieldExport.map(field => {
        if (this.$refs.vuetable.hasCallback(field)) {
          return this.$refs.vuetable.callCallback(field, item)
        }
        return this.$refs.vuetable.getObjectValue(item, field.name)
      }))
    },
    handleExport(value) {
			import('@/common/vendor/Export2Excel').then(excel => {
			  var data = this.listData
			  excel.export_json_to_excel({
			    header: this.listHeader,
			    data,
			    filename: this.filename + '-' + this.$refs.vuetable.currentPage,
			    autoWidth: this.autoWidth,
			    bookType: this.bookType
			  })
			  this.downloadLoading = false
			})
    },
    generateTitle(title) {
      const hasKey = this.$te('route.' + title)
      const translatedTitle = this.$t('route.' + title) // $t :this method from vue-i18n, inject in @/lang/index.js

      if (hasKey) {
        return translatedTitle
      }
      return title
    }

  }
}
</script>

<style scoped>
  .pagination {
    margin: 5px auto;
    text-align: center;
  }
	.el-icon-loading {
		font-size: 40px;
	}

  .pagination a.page {
    border: 1px solid lightgray;
    border-radius: 3px;
    padding: 5px 10px;
    margin-right: 2px;
  }

  .pagination a.page.active {
    color: white;
    background-color: #337ab7;
    border: 1px solid lightgray;
    border-radius: 3px;
    padding: 5px 10px;
    margin-right: 2px;
  }

  .pagination a.btn-nav {
    border: 1px solid lightgray;
    border-radius: 3px;
    padding: 5px 7px;
    margin-right: 2px;
  }

  .pagination a.btn-nav.disabled {
    color: lightgray;
    border: 1px solid lightgray;
    border-radius: 3px;
    padding: 5px 7px;
    margin-right: 2px;
    cursor: not-allowed;
  }

  .pagination-info {
    float: left;
  }
	.vuetable-pagination {
		margin-top: 10px;
		margin-bottom: 20px;
	}

	.list-component {
		overflow-x: auto;
		padding: 5px;
		min-height: 50vh;
		margin-bottom: 20px;
	}

	.loading-icon {
		position: absolute;
		left: 0;
		right: 0;
		margin-left: auto;
		margin-right: auto;
		width: 100px;
	}
</style>
