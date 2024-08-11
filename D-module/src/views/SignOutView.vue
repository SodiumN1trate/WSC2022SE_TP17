<template>
  <main class="mt-5">
    <h2>Sign In</h2>
    <form class="border p-5 d-flex justify-content-center align-items-center">
      <b>You have been successfully signed out.</b>
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
  mounted() {
    fetch(url + `/auth/signout`, {
      method: 'POST',
      body: JSON.stringify(this.form),
      headers: {
        ...headers
      }
    }).then(() => {
      localStorage.removeItem('username')

      localStorage.removeItem('token')
      this.$emit('authenticate', null)
    })
  },
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
