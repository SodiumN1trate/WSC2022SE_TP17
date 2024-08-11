<template>
  <main class="mt-5">
    <h2>Sign Up</h2>
    <form class="border p-5" @submit.prevent="submit">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" v-model="form.username" aria-describedby="usernameError">
        <div v-if="errors?.username" id="usernameError" class="form-text red">{{errors.username.message}}</div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" v-model="form.password" aria-describedby="passwordError">
        <div v-if="errors?.password" id="passwordError" class="form-text red">{{errors.password.message}}</div>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <RouterLink to="/">Cancel</RouterLink>
      </div>
    </form>
  </main>
</template>

<script>
import {url, headers} from "@/config/api.js";
export default {
  data () {
    return {
      form: {
        username: null,
        password: null
      },
      errors: null
    }
  },
  methods: {
    submit() {
      fetch(url + `/auth/signup`, {
        method: 'POST',
        body: JSON.stringify(this.form),
        headers: {
          ...headers
        }
      }).then(async (response) => {
        const data = await response.json()
        if(response.ok) {
          localStorage.setItem('username', this.form.username)
          localStorage.setItem('token', data.token)
          this.$emit('authenticate', data.token)
          this.$router.push('/')
          return 0
        }
        this.errors = data.violations
      })
    }
  }
}
</script>

<style scoped>
main {
  max-width: 600px;
  margin-inline: auto;
}

.red {
  color: red;
}
</style>
