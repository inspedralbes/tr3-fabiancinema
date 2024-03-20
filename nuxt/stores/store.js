import { defineStore } from 'pinia'

export const useStore = defineStore('store', {
  state: () => ({
    selectedMovieId: null,
  }),
  getters: {
    getSelectedMovieId() {
      return this.selectedMovieId
    },
  },
  actions: {
    setSelectedMovieId(movieId) {
      this.selectedMovieId = movieId
    },
  },
})
