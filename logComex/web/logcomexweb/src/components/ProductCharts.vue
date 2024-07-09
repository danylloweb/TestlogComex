<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <canvas id="productsChart"></canvas>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { Chart } from 'chart.js';

export default {
  props: {
    products: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    this.renderChart();
  },
  watch: {
    products: {
      handler() {
        this.renderChart();
      },
      deep: true,
    },
  },
  methods: {
    renderChart() {
      const ctx = document.getElementById('productsChart').getContext('2d');

      if (this.chart) {
        this.chart.destroy();
      }

      this.chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: this.products.map(product => product.name),
          datasets: [
            {
              label: 'Preços dos Produtos',
              data: this.products.map(product => product.price),
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    },
  },
};
</script>

<style scoped>
#productsChart {
  max-width: 100%;
  max-height: 400px;
}
</style>
