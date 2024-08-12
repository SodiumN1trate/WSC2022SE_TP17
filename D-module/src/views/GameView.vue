<template>
  <main class="mt-5" v-if="game">
    <h1>{{ game.title }}</h1>
    <iframe
      id="inlineFrameExample"
      title="Inline Frame Example"
      width="100%"
      height="400"
      :src="media() + game.gamePath">
    </iframe>
    <div class="d-flex justify-content-between mt-3">
      <div class="d-flex flex-column" style="width: 40%">
        <h3>Top 10 Leaderboard</h3>
        <div v-for="(score, index) in leaderBoard" :key="index" class="d-flex justify-content-between">
          <span># {{ index + 1}} {{ score.username }}</span>
          <span>{{ score.score }}</span>
        </div>
      </div>
      <div class="w-50">
        <h3>Description</h3>
        <p>{{game.description}}</p>
      </div>
    </div>
  </main>
</template>

<script>
import {url, media} from "@/config/api.js";

export default {
  data () {
    return {
      game: null,
      leaderBoard: null,
    }
  },
  mounted() {
    fetch(url + `/games/${this.$route.params.slug}`).then(async (response) => {
      const data = await response.json()
      this.game = data
      if(response.ok) {
        this.getScoreBoard()
      }
    })
  },
  methods: {
    media() {
      return media
    },
    getScoreBoard () {
      fetch(url + `/games/${this.$route.params.slug}/scores`).then(async (response) => {
        const data = await response.json()
        if(response.ok) {
          this.leaderBoard = data.scores.slice(0, 10)
        }
      })
    }
  }
}
</script>

<style scoped>
main {
  max-width: 1000px;
  margin-inline: auto;
}
</style>
