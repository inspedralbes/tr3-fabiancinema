// store.js
import { defineStore } from 'pinia'

export const useStore = defineStore('store', {
  state: () => ({
    selectedMovie: null,
  }),
  getters: {
    getSelectedMovie() {
      return this.selectedMovie;
    },
  },
  actions: {
    setSelectedMovie(movie) {
      this.selectedMovie = movie;
    },
  },
})
