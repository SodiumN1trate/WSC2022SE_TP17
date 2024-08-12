<template>
  <RouterLink :to="`/game/${game.slug}`" class="card mb-3" v-if="game">
    <div class="row g-0">
      <div class="col-md-4">
        <!--  There is incorrect thumbnail url, there is "games/", but need to "game/" -->
        <img :src="media() + game.thumbnail" class="img-fluid rounded-start" :alt="game.slug">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <div class="card-title d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <p class="p-0 m-0 h5">{{ game.title }}</p>
              <span>by {{ game.author }}</span>
            </div>
            <p class="p-0 m-0"># scores submitted: {{ game.scoreCount }}</p>
          </div>
          <p class="card-text">{{ game.description }}</p>
          <RouterLink :to="`/game/${game.slug}/manage`">
            <button v-if="game.author === username" class="btn btn-sm btn-secondary">Manage</button>
          </RouterLink>
        </div>
      </div>
    </div>
  </RouterLink>
</template>
<script>
import { media } from "@/config/api.js";
export default {
  props: ['game'],
  data () {
    return {
      username: null
    }
  },
  methods: {
    media() {
      return media
    }
  },
  created() {
    this.username = localStorage.getItem('username') || null
  }
}
</script>