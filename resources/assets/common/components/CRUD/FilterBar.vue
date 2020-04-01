<template>
  <div>
    <div v-if="searchFields.length" class="filter-box">
      <ElForm ref="dataForm" :inline="true" :model="params" @submit.native.prevent>
        <template v-for="field in searchFields">
          <br v-if="field.newline">
          <Component :is="field.component ? 'span': 'ElFormItem'" :key="field.field" :md="12" :label="field.title||$t(field.field)" :class="field.class">
            <div v-if="field.select">
              <ElSelect v-model="params[field.field]" class="filter-item" placeholder="Chọn" v-bind="{...field.props}" filterable>
                <ElOption v-for="item in field.select" :key="item.key" :label="item.value" :value="item.key" />
              </ElSelect>
            </div>
            <div v-else-if="field.radio">
              <ElRadioGroup v-model="params[field.field]" :name="field.field" :placeholder="field.placeholder">
                <ElRadio v-for="item in field.radio" :key="item.key" :name="field.field" :label="item.value" :style="{width: (99/field.radio.length)+'%', margin: 0}">
                  {{ item.key }}
                </ElRadio>
              </ElRadioGroup>
            </div>
            <Component
              :is="field.component"
              v-else-if="field.component"
              :field="field"
              @change="handleChange"
            />
            <div v-else>
              <ElInput v-model="params[field.field]" :name="field.field" :placeholder="field.placeholder" v-bind="{...field.props}"/>
            </div>
          </Component>
        </template>
      </ElForm>
      <ElButton v-if="searchFields && searchFields.length" icon="el-icon-search" type="primary" @click="handleFilter">
        Tìm kiếm
      </ElButton>
    </div>
		<div v-if="!isSelect" slot="footer" class="filter-submit">
			<router-link v-if="buttons.import && showbutton" :to="{ path: 'import'}" append>
				<ElButton icon="el-icon-upload2" type="primary">
					Nhập dữ liệu
				</ElButton>
			</router-link>
			<ElButton v-if="buttons.export && showbutton" icon="el-icon-download" type="primary" @click="handleExport">
				Xuất dữ liệu
			</ElButton>
			<router-link v-if="buttons.create && showbutton" :to="{ path: 'create'}" append>
				<ElButton icon="el-icon-plus" type="primary">
					Tạo mới
				</ElButton>
			</router-link>
			<ElButton v-if="buttons.recycleBin && role &&role.level==10" :type="params.only_trashed ? 'warning':'info'" :icon="params.only_trashed ? 'el-icon-back': 'el-icon-delete'" @click="handleBin">
				{{ params.only_trashed ? 'Thoát khỏi thùng rác' : 'Thùng rác' }}
			</ElButton>
			<slot name="extraButton" />
		</div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'FilterBar',
  props: {
    searchFields: {
      type: Array,
      default: null
    },
    defaultButton: {
      type: Object,
      default: () => ({
        create: true,
        export: true,
        recycleBin: true
      })
    },
    hasButton: {
      type: Object,
      default: ()=>({})
    },
    defaultParams: {
      type: Object,
      default: ()=>({})
    },
    isSelect: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      params: this.deepClone(this.defaultParams),
      filterText: '',
      filterTimeout: null,
      show: false,
      buttons: this.defaultButton,
			showbutton: true
    }
  },
  created() {
    this.buttons = { ...this.defaultButton, ...this.hasButton }
  },
  computed: {
    ...mapGetters([
      'role'
    ])
  },
  methods: {
    handleChange(field, value) {
      this.params[field] = value
    },
      handleFilter() {
          Object.keys(this.params).map((key) => {
              if (this.params[key] === '') delete this.params[key]
          })
          this.$emit('filter', this.params)
      },
			//Hàm này là code gà của Trung
      // addSearchNull() {
      //     Object.values(this.searchFields).forEach((element) => {
      //         if (this.params[element.field] == '') {
      //             this.params[element.field] = null
      //         }
      //     })
      // },
    handleExport() {
      this.$emit('handleExport', true)
    },
    handleBin() {
          const trashed = this.params.only_trashed
          this.params = JSON.parse(JSON.stringify(this.defaultParams))
          this.params.only_trashed = trashed ? undefined : true
          this.$emit('filter', this.params)
          if (this.showbutton) {
              this.showbutton = false
          } else {
              this.showbutton = true
          }
    }
  }
}
</script>

<style lang="scss" scoped>
  @import "~@/backend/styles/mixin";
  .filter-submit {
		text-align: right;
		button {
			margin-bottom: 10px;
		}
  }
	/deep/ {
		.el-form-item {
			position: relative;
      width: calc(50% - 20px);
      margin-bottom: 20px;
      margin-top: 10px;
      @include mobile {
        width: 100%;
      }
      .el-form-item__content,.el-autocomplete,.el-select {
        width: 100%;
      }
      .el-radio-group {
        padding: 5px;
        border: 1px solid #606266;
        border-radius: 5px;
        width: 100%;
        &:hover, :focus {
          border-color: #DCDFE6;
        }
        .el-radio-button--medium .el-radio-button__inner {
          padding: 5px 10px;
          min-width: 100px;
          width: 100%;
          @include mobile {
            font-size: 12px;
          }
        }
      }
		}
		.el-form-item__label {
			position: absolute;
			top: -10px;
			background: #fff;
			left: 10px;
			z-index: 1;
			padding: 0 2px;
			line-height: 1rem;
      font-weight: bold;
      color: #0145b3;
    }
		.split-label .el-form-item__label {
			min-width: 100px;
			text-align: right;
			position: initial;
			top: initial;
			background: #fff;
			left: initial;
			padding: 0 20px 0 0;
			line-height: 36px;
      font-weight: bold;

      @media (max-width: 767px){
				text-align: left;
			}
		}
    .full-input {
      width: auto;
      min-width: calc(50% - 20px);
      @include mobile {
        width: 100%;
      }
    }
		.el-select .el-input .el-input__inner {
			width: 100%;
		}
	}

	.filter-box {
		padding: 10px;
		border: 1px solid #EBEEF5;
		margin-bottom: 20px;
		h3 {
			margin: 20px;
		}
	}
</style>
<style lang="scss">
	.mini-field {
    width: auto!important;
    input{
			max-width: 100px;
			padding: 0 5px;
		}
	}
</style>
