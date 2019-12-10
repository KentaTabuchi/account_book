<template>
  <div>
    <select v-model="year" class="form-control offset-md-2">
      <option value="2015">2015</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
      <option value="2023">2023</option>
      <option value="2024">2024</option>
      <option value="2025">2025</option>
      <option value="2026">2026</option>
      <option value="2027">2027</option>
      <option value="2028">2028</option>
      <option value="2029">2029</option>
      <option value="2030">2030</option>
    </select>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Select Component mounted.')
        },
        data(){
          return{
          year:0
          }
        },
        watch:{
          year:function(newVal,oldVal){
            var currentURL = location.href;
            console.log(this.year);
            var newURL = currentURL + '&year=' + this.year; 
            location.href = newURL;
          }
        }
    }
</script>
