<script setup>
import Gauge from './components/Gauge.vue'
</script>

<script>
import { ref } from "vue";
// import { GaugeMeter, GaugeMeterOptions } from ".";  <-- 타입스크립트 관련, JS에서는 제거

const options = {
  areaWidth: 600,
  hasNeedle: true,
  needleColor: "black",
  arcColors: ["rgb(255, 84, 84)", "rgb(239, 214, 19)", "rgb(61, 204, 91)"],
  arcDelimiters: [40, 60],
  rangeLabel: ["50", "300"],
  needleStartValue: 100,
  centralLabel: "Bar",
  needleValue: 100,
};
</script>

<template>
  <div>
    <h1>hello</h1>
    <GaugeMeter :options="options"/>
  </div>
</template>

<style>
.inner-text {
  text-align: center;
}
</style>
