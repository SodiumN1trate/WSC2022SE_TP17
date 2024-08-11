<template>
  <header>
    <div class="wrapper">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <!--       This title was in page structure section   -->
          <RouterLink class="navbar-brand" to="/">WorldSkills - Games</RouterLink>
          <div v-if="!token">
            <ul class="navbar-nav">
              <li class="nav-item">
                <RouterLink class="nav-link" to="/sign-up">Sign Up</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/sign-in">Sign In</RouterLink>
              </li>
            </ul>
          </div>
          <div v-else>
            <ul class="navbar-nav d-flex align-items-center gap-3">
              <li class="nav-item">
                <RouterLink class="nav-link" style="font-weight: bold" :to="`/user/${username}`">{{ username }}</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/sign-out">Sign Out</RouterLink>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <RouterView @authenticate="setToken"/>
</template>


<script>
export default {
  data () {
    return {
      token: null,
      username: null
    }
  },
  mounted() {
    this.token = localStorage.getItem('token')
    this.username = localStorage.getItem('username')
  },
  methods: {
    setToken (token) {
      this.token = token
      this.username = localStorage.getItem('username')
    }
  }
}
</script>