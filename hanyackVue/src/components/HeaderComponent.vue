
<template>
  <div class="header flexType3">
    <img src="@/assets/src/logo_default.png" alt="">
    <div class="right flexType5-3">
      <div class="iconBox iconBox1 flexType1">
        <i class="fa-solid fa-bell"></i>
      </div>
      <div class="iconBox iconBox2 flexType1">
        <i class="fa-solid fa-user"></i>
      </div>
    </div>
  </div>
</template>


<script >
</script>

<style scoped>
.header {
  height: 60px;
  //background-color: var(--second-color);
}

.header img{
  width: 22vw;
}

.header .iconBox {
  border-radius: 50%;
  width: 32px;
  height: 32px;
}

.header .iconBox1 {
  background-color: var(--third-color);
  margin-right: 10px;

}

.header .iconBox2 {
  background-color: var(--second-color);

}

.header .iconBox i {
  color:#fff;
  //color:var(--second-color);
}
</style>
