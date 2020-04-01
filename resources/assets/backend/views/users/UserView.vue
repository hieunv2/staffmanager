<template>
  <div class="view-container">
    <DetailTable :id="id" :api="api.show" table="users" :fields="fields" />
    <h1>{{ $t('users.actionHistory') }}</h1>
    <ListComponent :fields="actionHistoryfields" :list-api="actionHistory.index" :default-params="defaultParams" :has-button="{create: false, export: false}" />
  </div>
</template>

<script>
import ResourceApi from '../../api/resourceApi'
import DetailTable from '@/common/components/CRUD/DetailTable'
import ListComponent from '@/common/components/CRUD/ListComponent'
const api = new ResourceApi('users')
const actionHistory = new ResourceApi('action-history')

const defaultForm = {
  id: undefined,
  code: '',
  martyr_id: '',
  file_id: '',
  description: '',
  status: '',
  user_type_id: ''
}

export default {
  name: 'UserView',
  components: { ListComponent, DetailTable },
  data() {
  	const id = this.$route.params && parseInt(this.$route.params.id)
    return {
      model: Object.assign({}, defaultForm),
      id: id,
      loading: false,
      updateApi: Function,
      errors: {},
      api,
      actionHistory,
      defaultParams: {
      	user_id_equal: id
      },
      fields: [
        {
          field: 'username'
        },
        {
          field: 'full_name'
        },
        {
          field: 'email'
        },
        {
          field: 'phone'
        },
        {
          field: 'address'
        },
        {
          name: 'role',
          field: 'role.display_name'
        },
        {
          name: 'dna_center_id',
          field: 'dna_center.full_name',
					showIf: (row) => !!row
        },
        {
          field: 'created_at'
        },
        {
          field: 'updated_at'
        }
      ],
      actionHistoryfields: [
        {
          name: 'id',
          sortField: 'id',
          title: this.$t('action_history.id')
        },
        {
          name: 'message',
          field: 'message',
          title: this.$t('action_history.message')
        },
        {
          name: 'created_at',
          field: 'created_at',
          title: this.$t('action_history.created_at')
        }
      ]
    }
  },
  created() {
    this.id = this.$route.params && parseInt(this.$route.params.id)
  },
  methods: {
    fetchData(id) {
      api.show({ id }).then(response => {
        this.model = response.data
      }).catch(err => {
        console.log(err)
      })
    },
    showForm() {
      this.showSenduser = true
    }
  }
}
</script>
<style>
  .view-container {
    margin: 0 10px;
  }

</style>
