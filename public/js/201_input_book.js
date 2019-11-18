var input_form = new Vue({
  el:'#input_form',
  data:{
    category_balance:'',
    category_large:'',
    category_middle:'',
    category_small:'',
    memo:'',
    payment:0,
    changed_form:'',
    json_balance:[],
    json_large:[],
    json_middle:[],
    json_small:[],
  },
  methods: {
    fetch: function($category){ 
      axios.get('json_'+$category).then((res)=>{
        switch($category){
          case 'balance':
            this.json_balance = res.data ;
          break;
          case 'large':
            this.json_large = res.data;
          break;
          case 'middle':
            this.json_middle = res.data;
          break;
          case 'small':
              this.json_small = res.data;
            break;
        }
      })
    }
  },
  mounted:function(){
    this.fetch('balance');
  },
  watch:{
    category_balance:{
      handler:function(newVal,oldVal){
        this.changed_form='category_balance';
        this.fetch('large');
      }
    },
    category_large:{
      handler:function(newVal,oldVal){
        this.changed_form='category_large';
        this.fetch('middle');
      }
    },
    category_middle:{
      handler:function(newVal,oldVal){
        this.changed_form='category_middle';
        this.fetch('small');
      }
    },    
  }
})