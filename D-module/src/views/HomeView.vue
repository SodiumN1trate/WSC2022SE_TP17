<template>
  <main id="main">
    <!--  Sort container  -->
    <div class="d-flex justify-content-between align-items-center mt-5 flex-wrap">
      <h3>{{ total }} Games available</h3>
      <div class="d-flex gap-2">
        <input type="radio" name="sortBy" value="popular" v-model="sortBy" @change="saveSort" class="btn-check" id="btn-check" autocomplete="off">
        <label class="btn btn-primary" for="btn-check">Popularity</label>

        <input type="radio" name="sortBy" value="uploaddate" v-model="sortBy" @change="saveSort" class="btn-check" id="btn-check-2" autocomplete="off">
        <label class="btn btn-primary" for="btn-check-2">Recently Updated</label>

        <input type="radio" name="sortBy" value="title" v-model="sortBy" @change="saveSort"  class="btn-check" id="btn-check-3" autocomplete="off">
        <label class="btn btn-primary" for="btn-check-3">Alphabetically</label>
      </div>
      <div class="d-flex gap-2">
        <input type="radio" name="sortDir" value="asc" v-model="sortDir" @change="saveSort" class="btn-check" id="btn-check-4" autocomplete="off">
        <label class="btn btn-primary" for="btn-check-4">ASC</label>

        <input type="radio" name="sortDir" value="desc" v-model="sortDir" @change="saveSort" class="btn-check" id="btn-check-5" autocomplete="off">
        <label class="btn btn-primary" for="btn-check-5">DESC</label>
      </div>
    </div>
    <!--  Games discover  -->
    <div class="cards mt-5">
      <!--   Game card   -->
      <GameCard v-for="(game, index) in games" :key="index" :game="game" :manage="false"></GameCard>
    </div>
  </main>
</template>

<script>
import { url, media } from "@/config/api.js";
import GameCard from "@/components/GameCard.vue";
export default {
  components: {GameCard},
  data () {
    return {
      page: 0,
      sortBy: 'title',
      sortDir: 'asc',
      total: 0,
      games: [],
    }
  },
  created () {
    window.addEventListener('scroll', (e) => {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        this.page += 1
        this.getData(this.page, this.sortBy, this.sortDir)
      }
    })
    this.sortBy = localStorage.getItem('sortBy') || 'title'
    this.sortDir = localStorage.getItem('sortDir') || 'asc'
    this.getData(this.page, this.sortBy, this.sortDir)
  },
  methods: {
    async getData(page, sortBy, sortDir) {
      await fetch(url + `/games?sortBy=${sortBy}&sortDir=${sortDir}&page=${page}`).then(async (response) => {
        const data = await response.json()
        if(response.ok) {
          this.total = data.totalElements
          this.games = [...this.games, ...data.content]
          return 0
        }
        alert('Server error')
      }).catch(() => {
        alert('Server error')
      })
    },
    saveSort() {
      localStorage.setItem('sortBy', this.sortBy)
      localStorage.setItem('sortDir', this.sortDir)
      this.page = 0
      this.games = []
      this.getData(0, this.sortBy, this.sortDir)
    }
  }
}
</script>

<style>
main {
  max-width: 1000px;
  margin-inline: auto;
}

a, a:link, a:visited {
  text-decoration: unset;
}
</style>