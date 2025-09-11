<script setup>
import {
  CircularGaugeComponent, AxesDirective, AxisDirective,
  PointersDirective, PointerDirective, RangesDirective, RangeDirective
} from '@syncfusion/ej2-vue-circulargauge'

const title = 'Gauge Component'
</script>

<template>
  <circular-gauge-component :title="title" orientation="Horizontal">
    <axes-directive>
      <axis-directive :minimum="320" :maximum="320">
        <pointers-directive>
          <pointer-directive :value="140"></pointer-directive>
        </pointers-directive>
        <ranges-directive>
          <range-directive :start="0" :end="80" :start-width="15" :end-width="15"></range-directive>
          <range-directive :start="80" :end="120" :start-width="15" :end-width="15"></range-directive>
          <range-directive :start="120" :end="140" :start-width="15" :end-width="15"></range-directive>
          <range-directive :start="140" :end="200" :start-width="15" :end-width="15"></range-directive>
        </ranges-directive>
      </axis-directive>
    </axes-directive>
  </circular-gauge-component>
</template>

<style scoped>
.gauge {
  width: 100%;
  height: 100%;
}
</style>
