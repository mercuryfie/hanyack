
<template>
  <div class="navWrap">
    <div class="navBox flexType3">
      <div class="navEach flexCol2">
        <i class="fa-solid fa-house"></i>
        <p class="navCategory">홈</p>
      </div>
      <div class="navEach flexCol2">
        <i class="fa-solid fa-user-group"></i>
        <p class="navCategory">파파모임</p>
      </div>
      <div class="navEach flexCol2">
        <i class="fa-solid fa-map"></i>
        <p class="navCategory">파파지도</p>
      </div>
      <div class="navEach flexCol2">
        <i class="fa-solid fa-comments"></i>
        <p class="navCategory">커뮤니티</p>
      </div>
      <div class="navEach flexCol2">
        <i class="fa-solid fa-user"></i>
        <p class="navCategory">내정보</p>
      </div>
    </div>
  </div>
</template>


<script >

</script>

<style scoped>
.navWrap {
  border:1px solid red;
  height: 60px;
  background-color: #fff;
  box-shadow: rgba(245,245,245,0.51);
}


.navBox {
  width: 90vw;
  height: 80px;
  position: fixed;
  bottom:52px;
  left:16px;
}

.navBox .navEach {
  border-radius: 10px;
  padding:10px;
  width: 60px;
  height: 60px;
  color:#6c6c6c;
}


.navBox .navEach:first-child {
  color:#000;
  background-color: var(--third-color);

}

.navBox .navEach.active {
  border-radius: 10px;
  padding:10px;
  background-color: var(--third-color);
  width: 60px;
  height: 60px;
}

.navBox .navEach i  {
  color:var(--color1);
  margin-bottom: 10px;
}

.navBox .navEach .navCategory  {
  font-size: 12px;
}
</style>
