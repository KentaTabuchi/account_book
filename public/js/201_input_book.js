var input_form = new Vue({
  el:'#input_form',
  data:{
    category_balance:'',
    category_large:'',
    category_middle:'',
    category_small:'',
    memo:'',
    payment:0,
    changed_form:''
  },
  watch:{
    category_balance:{
      handler:function(newVal,oldVal){
        this.changed_form='category_balance';
        setTimeout(function () {
          $(form).submit()
      },10);
      }
    },
    category_large:{
      handler:function(newVal,oldVal){
        this.changed_form='category_large';
        setTimeout(function () {
          $(form).submit()
      },10);
      }
    },
    category_middle:{
      handler:function(newVal,oldVal){
        this.changed_form='category_middle';
        setTimeout(function () {
          $(form).submit();
      },10)
      }
    },    
  }
})