<template>
  <main class="mt-5" v-if="data">
    <h1>{{ data.username }}</h1>
    <div v-if="data?.authoredGames" class="mt-5">
      <h3 class="p-0 m-0">Authored Games</h3>
      <div class="d-flex flex-column gap-3">
        <GameCard v-for="(game, index) in data.authoredGames" :key="index" :game="game"></GameCard>
      </div>
    </div>
    <div class="mt-5">
      <h3 class="p-0 m-0">Highscores per Game</h3>
      <div class="d-flex flex-column mt-3">
        <div class="d-flex justify-content-between" style="width: 300px" v-for="(score, index) in data.highscores" :key="index">
          <h5>{{ score.game.title }}</h5>
          <span>{{ score.score }}</span>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import { url, headers } from "@/config/api.js";
import GameCard from "@/components/GameCard.vue";

export default {
  components: {GameCard},
  data () {
    return {
      data: null,
    }
  },
  mounted() {
    fetch(url + `/users/${this.$route.params.username}`, {
      headers: {
        ...headers,
        'Authorization': 'Bearer ' + localStorage.getItem('token'),
      }
    }).then(async (response) => {
      const data = await response.json();
      if(response.ok) {
        this.data = data
        return 0
      }
      this.$router.push('/sign-in')
    })
  }
}
</script>

<style scoped>
main {
  max-width: 600px;
  margin-inline: auto;
}
</style>