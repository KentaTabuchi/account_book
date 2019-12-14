var input_form = new Vue({
  el:'#input_form',
  data:{
    pay_day:'',
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
    code_balance:0,
    code_large:0,
    code_middle:0,
    code_small:0,
    param:""
  },
  methods: {
    fetch: function($category){ 
       axios.get('json_'+$category+this.param).then((res)=>{
        switch($category){
          case 'balance':
            this.json_balance = res.data;
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
    },
    get_code: function($category,$name){
        axios.get('get_'+$category+'_code?code='+$name).then((res)=>{
        switch($category){
          case 'balance':
            this.code_balance = res.data;
          break;
          case 'large':
            this.code_large = res.data;
          break;
          case 'middle':
            this.code_middle = res.data;
          break;
          case 'small':
              this.code_small = res.data;
          break;
        }
        $param = "?code_balance=" + this.code_balance +
        "&code_large=" + this.code_large +
        "&code_middle=" + this.code_middle +
        "&code_small=" + this.code_small;
        this.param = $param;  
        //コードを引数にリストを取得。
        switch($category){
          case 'balance':
            this.fetch('large');
          break;
          case 'large':
            this.code_large = res.data;
            this.fetch('middle');
          break;
          case 'middle':
            this.code_middle = res.data;
            this.fetch('small');
          break;
        }
      })
    },
    date_format: function(date,format){
      var format;
      format = format.replace(/YYYY/,date.getFullYear());
      format = format.replace(/MM/,date.getMonth()+1);
      format = format.replace(/DD/,date.getDate());
      return format;
    },
  },
  mounted:function(){
    today = new Date();
    this.pay_day = this.date_format(today,'YYYY-MM-DD');

    this.fetch('balance');

  },
  watch:{
    category_balance:{
      handler:function(newVal,oldVal){
        this.changed_form='category_balance';
        this.get_code('balance',this.category_balance);
      }
    },
    category_large:{
      handler:function(newVal,oldVal){
        this.changed_form='category_large';
        this.fetch('middle');
        this.get_code('large',this.category_large);
      }
    },
    category_middle:{
      handler:function(newVal,oldVal){
        this.changed_form='category_middle';
        this.fetch('small');
        this.get_code('middle',this.category_middle);
      }
    }, 
    category_small:{
      handler:function(newVal,oldVal){
        this.get_code('small',this.category_small);
        this.changed_form='category_small';
      }
    },
    payment:{
      handler:function(newVal,oldVal){
        this.payment = newVal.replace(/\D/g, '');
      }
    },
  }
})