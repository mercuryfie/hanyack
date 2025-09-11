<template>
  <div class="mainWrap">
    <!-- 전역 레이아웃: 모든 페이지 공통 -->
    <HeaderComponent />
    <MenuBarComponent />

    <!-- 라우트가 바뀔 때 뷰가 여기서 바뀜 -->
    <router-view />
  </div>
</template>

<!--<script setup>-->
<!--</script>-->

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import HeaderComponent from '@/components/HeaderComponent.vue'
import MenuBarComponent from '@/components/MenuBarComponent.vue'

const count = ref(0)
const increment = () => count.value++

</script>


<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Noto Sans KR", sans-serif;
}

.mainWrap {
  border:1px solid teal;
}

ul {
  list-style-type: none;
}

a {
  text-decoration: none;
  color: inherit;
}

@media print {
  body {
    margin: 0 !important;
  }
}

:root {
  --main-color: #4b6957;
  --sub-color: #edf1ef;
  --second-color: #5e9b76;
  --third-color: #b0ddc2;
  --forth-color: #8bffb9;
  --fifth-color: #1d3627;
  --sixth-color: #fc88ad;
  --orange: #fb932b;
  --eigth-color: #c975ed;
  --ninth-color: #6eec9a;
  --mint-color: #79f8d8;
  --bg-color1: #f1f1f16f;
  --bg-color2: #ececec;
  --bg-color3: #ccc;
  --bg-color4: #dedede;
  --cartbg: #f2f5f8;
  --gray-cart001: #848f9a;
  --grayColor1: #848f9a;
  --yellow: #f3df14;
  --ck-z-default: 100;
  --ck-z-panel: calc( var(--ck-z-default) + 999 );
}

::selection {
  background-color: #b0ddc2;
  color: #000;
}

input[type="checkbox"] {
  accent-color: #5e9b76;
}

input[type="search"] {
  outline: none;
}

input[type="radio"] {
  accent-color: #4b6957;
  margin-right: 5px;
}


.noto-sans-kr {
  font-family: "Noto Sans KR", sans-serif;
  font-optical-sizing: auto;
  font-weight: 200;
  font-style: normal;
}

.btnType1 {
  border: 1px solid #ccc;
  background-color: #fff;
  border-radius: 5px;
  width: auto;
  height: 24px;
  line-height: 24px;
  padding: 0px 10px;
  font-size: 12px;
  text-align: center;

}

.btnType1-1 {

  border: 1px solid var(--second-color);
  color:var(--second-color);
  background-color: transparent;
  border-radius: 5px;
  width: auto;
  height: 24px;
  line-height: 24px;
  padding: 0px 10px;
  font-size: 12px;
  text-align: center;

}


.btnType2 {
  border: 1px solid var(--second-color);
  background-color: var(--second-color);
  color:#fff;
  border-radius: 5px;
  width: auto;
  height: 24px;
  line-height: 24px;
  padding: 0px 10px;
  font-size: 12px;
  text-align: center;

}


.btnType32 {
  border: 1px solid #ccc;
  background-color: #fff;
  border-radius: 5px;
  width: auto;
  height: 32px;
  line-height: 32px;
  padding: 0px 10px;
  font-size: 14px;
  text-align: center;
  margin-left: 10px;
  color: #2c2c2c;

}


.btnType3 {
  border: 1px solid #ccc;
  background-color: #fff;
  border-radius: 5px;
  width: 120px;
  height: 32px;
  line-height: 32px;
  /*padding: 0px 10px;*/
  font-size: 14px;
  text-align: center;
  margin-left: 10px;
  color: #2c2c2c;

}

.btnType4 {
  border: 1px solid var(--main-color);
  background-color: var(--main-color);
  color:#fff;
  margin-left: 10px;
  border-radius: 5px;
  width: 120px;
  height: 32px;
  line-height: 32px;
  /*padding: 0px 10px;*/
  font-size: 14px;
  text-align: center;
}


.btntype5 {
  border: 1px solid #ccc;
  background-color: #fff;
  /* color:#fff; */
  border-radius: 5px;
  width: 220px;
  height: 55px;
  line-height: 55px;
  padding: 0px 10px;
  font-size: 22px;
  text-align: center;
  margin-right: 10px;

}
.btntype6 {
  border: 1px solid #ccc;
  background-color: var(--main-color);
  color:#fff;
  border-radius: 5px;
  width: 220px;
  height: 55px;
  line-height: 55px;
  padding: 0px 10px;
  font-size: 22px;
  text-align: center;
  margin-right: 10px;

}


.btntype7 {
  border: 1px solid #ccc;
  background-color: #fff;
  /* color:#fff; */
  border-radius: 5px;
  width: 140px;
  height: 38px;
  line-height: 38px;
  padding: 0px 10px;
  font-size: 16px;
  text-align: center;

}
.btntype8 {
  border: 1px solid #ccc;
  background-color: var(--main-color);
  color:#fff;
  border-radius: 5px;
  width: 140px;
  height: 38px;
  line-height: 38px;
  padding: 0px 10px;
  font-size: 16px;
  text-align: center;
  margin-right: 10px;
}


.btnType9 {
  border: 1px solid var(--second-color);
  background-color: var(--second-color);
  color:#fff;
  border-radius: 5px;
  width: 80px;
  height: 24px;
  line-height: 24px;
  padding: 0px 10px;
  font-size: 12px;
  text-align: center;

}

.btnType99 {
  border: 1px solid #ececec81;
  background-color: #ececec81;
  color:#000;
  border-radius: 5px;
  width: 80px;
  height: 24px;
  line-height: 24px;
  padding: 0px 10px;
  font-size: 12px;
  text-align: center;

}


.btnType10 {
  border: 1px solid transparent;
  background-color: #fb932b;
  /*background-color: red;*/
  color:#fff;
  border-radius: 5px;
  width: auto;
  height: 24px;
  line-height: 24px;
  padding: 0px 10px;
  font-size: 12px;
  text-align: center;

}


.btnType11 {
  border: 1px solid #ccc;
  background-color: #fff;
  width: 32px;
  height: 32px;
  color:#5c5c5c;
  font-size: 12px;
  text-align: center;
}


.btnType100 {
  border: none;
  background-color: var(--second-color);
  width: 220px;
  height: 32px;
  color:#fff;
  font-size: 14px;
  text-align: center;
}

.btnTypeTItle {
  border: none;
  border-left: 2px solid #000;
  /*border-radius: 5px;*/
  width: auto;
  height: 24px;
  font-size: 16px;
  /*text-decoration: underline;*/
  font-weight: 500;
  background-color: transparent;
  /*color:#fff;*/
  margin: 20px 0;
  margin-left: 30px;
  padding: 0 10px;

}


.btnTypeTItle {
  border: none;
  border-left: 2px solid #000;
  width: auto;
  height: 24px;
  font-size: 16px;
  font-weight: 500;
  background-color: transparent;
  /*color:#fff;*/
  margin: 20px 0;
  margin-left: 30px;
  padding: 0 10px;

}


.btntype21 {
  width: 48%;
  border:1px solid #ececec;
  border-radius: 3px;
  padding: 10px 0;
  margin-right: 10px;
}
.btntype22 {
  width: 48%;
  border-radius: 3px;
  border:1px solid var(--second-color);
  background-color: var(--second-color);
  color:#fff;
  padding: 10px 0;
}

.flexType1 {
  display: flex;
  justify-content: center;
  align-items: center;
}

.flexType2 {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.flexType3 {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.flexType4 {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
}

.flexType5-1 {
  display: flex;
  justify-content: flex-end;
  align-items: flex-start;
}

.flexType5-2 {
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
}

.flexType5-3 {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.flexCol {
  display: flex;
  flex-flow: column;
  justify-content: flex-start;
  align-items: flex-start;
}

.flexCol2 {
  display: flex;
  flex-flow: column;
  justify-content: center;
  align-items: center;
}




.inputType240 {
  border: 1px solid #ccc;
  width: 240px;
  height: 30px;
}

.inputType160 {
  border: 1px solid #ccc;
  width: 160px;
  height: 30px;
}

.inputType140 {
  border: 1px solid #ccc;
  width: 140px;
  height: 24px;
  line-height: 24px;
  font-size: 14px;
}

.periodSelected {
  border: 1px solid var(--second-color) !important;
  color: var(--second-color);
}

.modiLastBox {
  margin-right: 60px;
}
.mb40 {
  margin-bottom: 40px;
}
.mb10 {
  margin-bottom: 10px;
}

.p40 {
  padding: 40px 0;
}


.mr10 {
  margin-right: 10px;
}

.ml10 {
  margin-left: 10px;
}

.ml20 {
  margin-left: 20px;
}
.ml40 {
  margin-left: 40px;
}
</style>
