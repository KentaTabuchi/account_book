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
            console.log('Select Component mounted.');
          var currentURL = location.href;
          var param_year = (currentURL.substr(-4));
          var today = new Date();
          if((param_year.match('[0-9]+')==null)){
             this.year = today.getFullYear();
          }
        },
        data(){
          var currentURL = location.href;
          var param_year = (currentURL.substr(-4));
          return{
          year:param_year
          }
        },
        watch:{
          year:function(newVal,oldVal){
            var currentURL = location.href;
            if(currentURL.substr(-10,5)=='&year'){
              currentURL = currentURL.slice(0,-10);
            }
            var newURL = currentURL + '&year=' + this.year; 
            location.href = newURL;
          }
        }
    }
</script>
