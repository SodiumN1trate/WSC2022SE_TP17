<template>
  <main class="mt-5">
    <h1>Manage game</h1>
    <!-- Base info -->
    <form v-if="form?.title" @submit.prevent="update">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" v-model="form.title" id="title" aria-describedby="titleError">
        <div id="titleError" class="form-text"></div>
      </div>
      <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" v-model="form.description" placeholder="Leave a description here" id="description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <!-- Upload new version  -->
    <div class="d-flex gap-3">
      <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Upload new version
      </button>
      <button type="button" class="btn btn-danger mt-5" @click="deleteGame()">
        Delete
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="uploadNewVersion()">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">New version zip file</label>
                <input @change="fileUpload" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <button type="submit" class="btn btn-primary">Upload</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script>
import {url, headers} from "@/config/api.js";

export default {
  data () {
    return {
      username: null,
      form: null,
      file: null
    }
  },
  mounted() {
    this.username = localStorage.getItem('username')
    fetch(url + `/games/${this.$route.params.slug}`).then(async (response) => {
      const data = await response.json()
      if(data.author !== this.username) {
        this.$router.push('/game/' + this.$route.params.slug)
      }
      this.form = data
    })
  },
  methods: {
    update() {
      fetch(url + `/games/${this.$route.params.slug}`, {
        method: 'PUT',
        body: JSON.stringify(this.form),
        headers: {
          ...headers
        }
      }).then(async (response) => {
        const data = await response.json()
        if(response.ok) {
          alert('Success')
          return 0
        } else {
          alert('Failure')
        }
      })
    },
    fileUpload (e) {
      this.file = e.target.files[0]
    },
    uploadNewVersion () {
      const fd = new FormData();
      fd.append('file', this.file)
      fetch(url + `/games/${this.$route.params.slug}/upload`,{
        method: 'POST',
        body: fd,
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'multipart/form-data',
          'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
      }).then((response) => {
        console.log(response)
      })
    },
    deleteGame () {
      if(confirm('Do you want to delete this game?')) {
        fetch(url + `/games/${this.$route.params.slug}`, {
          method: 'DELETE',
          headers: {
            ...headers,
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
          }
        }).then(async  (response) => {
          const data = await response.json()
          if(response.ok) {
            alert('Success')
            this.$router.go('/')
          }else {
            alert('There is an error')
          }
        })
      }
    }
  }
}
</script>


<style scoped>
main {
  max-width: 600px;
  margin-inline: auto;
}
</style>