<template>
  <ListComponent :fields="fields" :search-fields="searchFields" :list-api="api.index" :delete-api="api.delete" :has-button="{create: hasCreate, export: true}" />
</template>

<script>
import ResourceApi from '../../api/resourceApi'
import ListComponent from '@/common/components/CRUD/ListComponent'
import { mapGetters } from 'vuex'

const api_roles = new ResourceApi('roles')

export default {
  name: 'UserList',
  components: { ListComponent },
  props: {
    selectRoles: {
      type: Array
    }
  },
  data() {
    const api = new ResourceApi('users')

    return {
		api,
		load_success: false,
		hasButton: {
			create: true,
			export: true
		},
		fields: [
			{
				name: 'id',
				sortField: 'id',
				title: this.$t('users.id')
			},
			{
				name: 'username',
				sortField: 'username',
				title: this.$t('users.username')
			},
			{
				name: 'full_name',
				sortField: 'full_name',
				title: this.$t('users.full_name')
			},
			{
				name: 'email',
				sortField: 'email',
				title: this.$t('users.email')
			},
			{
				name: 'phone',
				sortField: 'phone',
				title: this.$t('users.phone')
			},
			{
				name: 'address',
				sortField: 'address',
				title: this.$t('users.address')
			},
			{
				name: 'role.display_name',
				field: 'role.display_name',
				sort: false,
				title: this.$t('users.role')
			},
			{
				name: '__component:action-column',
				width: '100px',
				title: ''
			}
		],
		searchFields: [
			{
				field: 'username_like',
				title: this.$t('users.username'),
				placeholder: this.$t('users.placeholder_username')
			},
			{
				field: 'full_name_like',
				title: this.$t('users.full_name'),
				placeholder: this.$t('users.placeholder_name')
			},
			{
				field: 'email_like',
				title: this.$t('users.email'),
				placeholder: this.$t('users.placeholder_email')
			}
		]
	}
},
computed: {
...mapGetters([
		'role'
	]),
		hasCreate() {
		return true
	}
},
created() {
	this.selectRoles = []
	this.getAllRole()
},
methods: {
	getAllRole() {
		api_roles.index().then(response => {
			for (var i = 0; i < response.data.length; i++) {
				this.selectRoles.push({
					key: response.data[i].name,
					value: response.data[i].display_name
				})
			}
			this.searchFields.push(
				{
					field: 'role_filter',
					title: this.$t('users.role'),
					select: this.selectRoles
				}
			)
		}).catch(err => {
			console.log(err)
		})
	}
}
}
</script>

