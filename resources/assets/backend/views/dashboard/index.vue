<template>
  <div class="dashboard-container">
		<h1>Home page</h1>
	</div>
</template>

<script>
import { mapGetters } from 'vuex'
// import editorDashboard from './editor'

export default {
  name: 'Dashboard',
  data() {
    return {
      currentRole: 'adminDashboard'
    }
  },
  computed: {
    ...mapGetters([
      'roles'
    ])
  },
  created() {
    if (!this.roles.includes('admin')) {
      this.currentRole = 'editorDashboard'
    }
  }
}
</script>
