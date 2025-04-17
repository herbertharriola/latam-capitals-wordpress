import Vue from 'vue';
import './styles.scss';

new Vue({
  el: '#app',
  data() {
    return {
      countries: [],
      sortBy: 'country',
      direction: 'asc',
      loading: false,
      error: null
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      this.loading = true;
      this.error = null;
      try {
        const res = await fetch(`/wp-json/capitals/v1/list?sort_by=${this.sortBy}&direction=${this.direction}`);
        if (!res.ok) throw new Error('API request failed');
        this.countries = await res.json();
      } catch (err) {
        this.error = 'Failed to load data';
        console.error(err);
      } finally {
        this.loading = false;
      }
    },
    changeSort(field) {
      this.sortBy = field;
      this.fetchData();
    },
    toggleDirection() {
      this.direction = this.direction === 'asc' ? 'desc' : 'asc';
      this.fetchData();
    }
  },
  template: `
    <div class="vue-app">
      <div class="controls">
        <select v-model="sortBy" @change="fetchData">
          <option disabled value="">Sort by:</option>
          <option value="country">Sort by: Country</option>
          <option value="capital">Sort by: Capital</option>
        </select>

        <select v-model="direction" @change="fetchData">
          <option disabled value="">Direction:</option>
          <option value="asc">Direction: Ascending</option>
          <option value="desc">Direction: Descending</option>
        </select>
      </div>

      <div v-if="loading">Loading...</div>
      <div v-else-if="error" class="error">{{ error }}</div>
      <ul v-else>
        <li v-for="(item, index) in countries" :key="index">
          {{ item.country }}, {{ item.capital }}
        </li>
      </ul>
    </div>
  `
});
